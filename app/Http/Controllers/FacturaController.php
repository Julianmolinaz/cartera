<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\PagoRepository;
use App\Traits\FacturaTrait;
use App\Traits\Payments\AbonoTrait;
use App\Http\Requests;
use App\FechaCobro;
use Carbon\Carbon;
use App\Variable;
use App\Factura;
use App\Credito;
use App\Sancion;
use App\Punto;
use App\Extra;
use App\Pago;
use App as _;
use Auth;
use PDF;
use DB;

class FacturaController extends Controller
{
    use FacturaTrait, AbonoTrait;
    protected $repo;

    public function __construct(PagoRepository $repo)
    {
        $this->repo = $repo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $facturas   = Factura::orderBy('created_at','desc')->paginate(100);
      $variables  = Variable::find(1);

      return view('start.facturas.index')
      ->with('facturas',$facturas)
      ->with('variables',$variables);
    }

    //retorna la vista de todos pagos en el sistema
    public function pagos ()
    {
      $pagos = Pago::cursor();
      
      return view('start.pagos.index')
            ->with('pagos',$pagos);
    }

    public function invoice_to_print($factura_id)
    {
      return $this->generate_content_to_print($factura_id);
    }

    public function abonos(Request $request)
    {
        try {
            $abono = new \App\Classes\Abono( $request->credito_id, intval($request->monto) );
            
            return res(false, $abono->make(), '');

        } catch (\Exception $e) {
            return res(true, '', $e->getMessage());
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $hoy        = Carbon::today();
        $credito    = Credito::find($id);
        $updated_at = new Carbon($credito->updated_at);
        $punto      = Punto::find(Auth::user()->punto_id);
        $bancos     = getEnumValues('facturas', 'banco');

        $sum_sanciones = DB::table('sanciones')
                            ->where([['credito_id','=',$id],['estado','Debe']])
                            ->sum('valor');

        if ($sum_sanciones == 'null') { 
            $sum_sanciones = 0; 
        }

        $ultimo_pago = DB::table('pagos')
                          ->where([['credito_id','=',$credito->id],['concepto','=','Cuota']])
                          ->orWhere([['credito_id','=',$credito->id],['concepto','=','Cuota Parcial']])
                          ->orderBy('pago_hasta','desc')
                          ->first();


        $cuota_parcial = DB::table('pagos') 
                          ->where([['credito_id','=',$id],['concepto','=','Cuota Parcial']])
                          ->orderBy('pago_hasta','desc')
                          ->get();

        /******************** JURIDICO **************************/      
        /* se valida la existencia de sanciones Juridicas en la tabla extras, si existen se valida que haya abonos en 
        la tabla pagos en los casos de que no existan se generan los respectivos valores */


        $juridico = Extra::where('credito_id',$id)
                        ->where('concepto','Juridico')
                        ->where('estado','Debe')
                        ->get();   

        if (count($juridico) > 0) { 

            $pago_juridico = DB::table('pagos')
                          ->where([['credito_id','=',$id], ['concepto','=','Juridico'], ['estado','=','Debe']])
                          ->get();

            if (count($pago_juridico) > 0) {                    
                $pago_juridico = array(
                    'juridico' => $pago_juridico[0]->debe, 
                    'valor'    => $juridico[0]->valor);               
            }  else {
                $pago_juridico = array('juridico' => null, 'valor' => $juridico[0]->valor);
            }                        
        } else {
            $pago_juridico = array('juridico' => 0, 'valor' => null);
        }

        /******************** END JURIDICO **************************/  

        /******************** PREJURIDICO  **************************/      
        /* se valida la existencia de sanciones Prejuridicas en la tabla extras, si existen se valida que haya abonos en 
        la tabla pagos en los casos de que no existan se generan los respectivos valores */


        $prejuridico = Extra::where('credito_id',$id)
                        ->where('concepto','Prejuridico')
                        ->where('estado','Debe')
                        ->get();   

        if (count($prejuridico) > 0) {

            $pago_prejuridico = DB::table('pagos')
                                    ->where([['credito_id','=',$id],['concepto','=','Prejuridico'],['estado','=','Debe']])
                                    ->get();
        
            if (count($pago_prejuridico) > 0) {                     
                $pago_prejuridico = array('prejuridico' => $pago_prejuridico[0]->debe, 'valor' => $prejuridico[0]->valor);               
            } else{
                $pago_prejuridico = array('prejuridico' => null, 'valor' => $prejuridico[0]->valor);
            }                        
        } else{
            $pago_prejuridico = array('prejuridico' => 0, 'valor' => null);
        }

        /******************** END PREJURIDICO **************************/  

        /******************** PAGOS PARCIALES **************************/  
        $total_parciales = DB::table('pagos')
                            ->where([['credito_id','=',$id],['concepto','=','Cuota Parcial'],['estado','=','Debe']])
                            ->sum('Debe');

        /******************** PAGOS PARCIALES **************************/  

        $pagos = Pago::where('credito_id',$id)->orderBy('id','desc')->get();
        $variables = Variable::all();
        $tipo_pago  = getEnumValues('facturas','tipo');
        $total_pagos = sum_pagos($credito);

        return view('start.facturas.create')
            ->with('pago_prejuridico',$pago_prejuridico)
            ->with('total_parciales',$total_parciales)
            ->with('pago_juridico',$pago_juridico)
            ->with('sum_sanciones',$sum_sanciones)
            ->with('ultimo_pago',$ultimo_pago)
            ->with('total_pagos',$total_pagos)
            ->with('variables',$variables[0])
            ->with('tipo_pago',$tipo_pago)
            ->with('user',Auth::user())
            ->with('credito',$credito)
            ->with('bancos',$bancos)
            ->with('punto',$punto)
            ->with('pagos',$pagos);
    }

    public function generate_auto()
    {
        $punto        = Punto::find(Auth::user()->punto_id); 
        $prefijo      = $punto->prefijo;
        $consecutivo  = $punto->increment + 1;
        $punto->increment = $consecutivo; 
        $punto->save();

        return $prefijo .''. $consecutivo;
    }

    /*
    |--------------------------------------------------------------------------
    | store
    |--------------------------------------------------------------------------
    |
    | Crea una factura
    | Recibe request toda la informacion de la factura
    | Retorna : recarga la vista
    | 
    */      

    public function store(Request $request)
    {
        try {

            $pago_credito = new _\Classes\PagosCredito (
                $request->num_fact,
                $request->fecha,
                $request->monto,
                $request->tipo_pago,
                $request->auto,
                $request->pagos,
                $request->banco,
                $request->credito_id,
                $request->num_cosignacion,
                Auth::user()->id
            );
    
            $pago_credito->make();

            return response()->json([
                "error"   => false,
                "mensaje" => "Se generaron los pagos Éxitosamente !!!"
            ]);

        } catch (\Exception $e) {

            return response()->json([
                "error"   => true,
                "mensaje" => $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
      $factura = Factura::find($id);
      return view('start.facturas.show')
      ->with('factura',$factura);
    } 

    public function edit($id){}
    public function update(Request $request, $id){}
    public function destroy($id){}

    public function fecha_pago(Request $request)
    {
      $fecha_inicial = $request->fecha;

      $periodo = calcularFecha($request->date,$request->periodo, 
                               $request->num_cuotas, $request->p_fecha, 
                               $request->s_fecha, 
                               $request->primera_cuota);

      $fecha_ini = $periodo["fecha_ini"];
      $fecha_fin = $periodo["fecha_fin"];

      if ($request->ajax()){ return response()->json($periodo);  } 
    }

    //Consulta si el numero de factura existe


    /*
    |--------------------------------------------------------------------------
    | consutar_factura
    |--------------------------------------------------------------------------
    |
    | Consulta si el numero de factura existe
    | Recibe el numero de factura
    | Retorna true si la factura existe, false si no
    | El array contenedor de la respuesta tiene un atributo 'marcado' para señalar 
    | que la cuota parcial se le puede mover o no la fecha
    | 
    */

    public function consultar_factura($num_fact)
    {
      $n = 
      DB::table('facturas')
        ->where([['num_fact','=',$num_fact]])
        ->count();

      if ($n > 0) { $hay_factura = true;  }
      else        { $hay_factura = false; }

      return response()->json($hay_factura);
    }

    public function get_pdf($factura_id){
        return view('start.facturas.pdf')
            ->with( 'factura', Factura::find($factura_id));
    }

}
