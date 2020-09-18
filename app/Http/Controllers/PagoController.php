<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\OtrosIngresosRequest;
use App\Cliente;
use Carbon\Carbon;
use App\Cartera;
use DB;

use App\Factura;
use App\OtrosPagos;
use Auth;


class PagoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_otros_ingresos()
    {
        $otros_pagos = OtrosPagos::where('id','>','0')->orderBy('created_at','desc')->get();

        return view('start.pagos.index_otros_pagos')
            ->with('otros_pagos',$otros_pagos);
    }


    public function inicio()
    {
        return view('start.pagos.pago_index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $tipos_pago = getEnumValues('facturas', 'tipo');
        $tipos      = $tipos_pago + ['Unificacion' => 'Unificacion'];
        $carteras   = Cartera::where('estado','Activo')->get();
        $now        = Carbon::today();
        $now        = formatoFecha(ano($now),mes($now),dia($now));


        $otros_pagos=
        DB::table('otros_pagos')
            ->join('facturas','otros_pagos.factura_id','=','facturas.id')
            ->join('users','facturas.user_create_id','=','users.id')
            ->select('otros_pagos.id as id')
            ->where([['users.id','=',Auth::user()->id],['facturas.created_at','like',$now.'%']])
            ->orderBY('otros_pagos.created_at','desc')
            ->get();

        $otros_pagos = OtrosPagos::find(array_ids($otros_pagos))->sortByDesc('created_at');

        return view('start.pagos.create_venta')
            ->with('tipos_pago',$tipos)
            ->with('carteras',$carteras)
            ->with('otros_pagos',$otros_pagos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        DB::beginTransaction();

        try{
          
          $cadena           = $request->info;
          $num_factura      = $request->num_factura;  
          $fecha_factura    = $request->fecha_factura;
          $tipo_pago        = $request->tipo_pago;
          $cartera          = $request->cartera;
          $len_cadena       = strlen($cadena);
          $vector           = array();
          $contenedor       = "";
          $now              = Carbon::today();
          $bandera          = 0;
 
          for( $i = 0; $i < $len_cadena ; $i++ ){
            if( $cadena[$i] == ','){ array_push($vector,$contenedor);  $contenedor = "";  }
            else{  $contenedor = $contenedor.$cadena[$i];  }        
          }
          array_push($vector,$contenedor);

         $factura = new Factura();
          $factura->num_fact        = $num_factura;
          $factura->fecha           = $fecha_factura;
          $factura->credito_id      = null;
          $factura->total           = 0 ;
          $factura->tipo            = $tipo_pago;
          $factura->user_create_id  = Auth::user()->id;
          $factura->user_update_id  = Auth::user()->id;
          $factura->save();


        for ($k=0; $k < count($vector); $k=$k+4) {  
            if($vector[$k] == " "){
                $factura->total= $vector[$k+3];
                $factura->save();
            }else{
                $pago = new OtrosPagos();
                $pago->factura_id       = $factura->id;
                $pago->cartera_id       = $cartera;
                $pago->fecha_factura    = $factura->fecha;
                $pago->cantidad         = $vector[$k];
                $pago->concepto         = $vector[$k+1];
                $pago->valor_unitario   = $vector[$k+2];
                $pago->subtotal         = $vector[$k+3];
                $pago->save();
            }
        }

        DB::commit();

        return response()->json(["mensaje" => "Se generaron los pagos Éxitosamente !!!", 'factura' => $factura ]);

    } catch(\Exception $e){
        DB::rollback();
    }

    }

    public function show($id){}
    public function edit($id){}
    public function update(Request $request, $id){}
    public function destroy($id){}

    public function hay_creditos($doc){
        $query = 
        DB::table('clientes')
            ->join('precreditos','clientes.id','=','precreditos.cliente_id')
            ->join('creditos','precreditos.id','=','creditos.precredito_id')
            ->where([['creditos.estado','<>','Cancelado'],['num_doc','=',$doc]])
            ->orWhere([['creditos.estado','<>','Refinanciado'],['num_doc','=',$doc]])
            ->select('clientes.nombre as nombre','creditos.id as id')
            ->get();

        if(count($query)>0){

            return response()->json(['res' => true, 'nombre' => $query[0]->nombre,'credito_id' => $query[0]->id]);
        }
        else{
            return response()->json(['res' => false]);
        }  
        

    }

    public function insertar_pago(Request $request){
        $concepto   =   $request->concepto;
        $valor      =   $request->valor;
        $cantidad   =   $request->cantidad;

        $fila = 
          "<tr class='otras_filas'>
          <td>".$cantidad."</td>
          <td><a href='#' onclick='Eliminar(this.parentNode.parentNode.rowIndex)'>".$concepto."</a></td>
          <td>".$valor."</td>
          <td class='vlr'>".$valor * $cantidad."</td>
        </tr>"; 

        return response()->json($fila);

    }
}
