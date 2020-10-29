<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\MyService\PagosSolicitudService;
use App\Http\Controllers\FacturaController;
use App\Repositories\PagoRepository;
use App\PagoMasivo; 
use Carbon\Carbon;
use Datatables;
use Validator;
use Excel;
use File;
use Auth;
use App as _;
use DB;


class PagoMasivoController extends Controller
{
    public $report;
    public $data;
    public $arr_error = [];
    public $bancos;
    public $index = 0;
    public $filename = '';
    public $load = '';
    public $factura;

    public function __construct()
    {
        $this->bancos = DB::table('bancos')->get();
    }

    public function index() 
    {
        return view('admin.masivos.index');
    }

    public function list()
    {
        $loads = \DB::table('loads')
            ->join('users', 'loads.created_by', '=', 'users.id')
            ->select('loads.*', 'users.name as user');
        
         return Datatables::of($loads)
            ->addColumn('btn', function($load) {

                $route = route('admin.pagos_masivos.list_masivos',$load->id);

                return '<a href="'.$route.'" class="btn btn-default btn-xs ver">
                              <span class="glyphicon glyphicon-eye-open"></span></a>';
            })
            ->make(true);
    }

    public function listMasivos($load_id)
    {
        $load = _\Load::find($load_id);

        return view('admin.masivos.cargue.masivos')
            ->with('load',$load);
    }

    public function cargarMasivos() 
    {
        return view('admin.masivos.cargue.index')
            ->with('err', [])
            ->with('load','');
    }

    /**
     * Permite cargar los pagos dentro del sistema
     * @param $request = archivo xlsx || xls || csv (ver plantilla)
     * @return 1- log de errores, 2- Mensaje de carga
     * maurciogonzalezsalazar@gmail.com 15092020
     */

    public function store(Request $request) 
    {
        $this->validate($request, ['archivo'=>'required']);

        if ($request->hasFile('archivo'))
        {
            $this->filename = $request->archivo->getClientOriginalName();

            $extension = File::extension($request->archivo->getClientOriginalName());

            $exist_log = \DB::table('loads')->where('filename', $this->filename)->count();

            // Validacion del formato y nombre del archivo único

            if ( ($extension == "xlsx" || $extension == "xls" || $extension == "csv") &&
                  ! $exist_log  )
            {
                $path = $request->archivo->getRealPath();

                $this->data = collect(Excel::load($path, function($reader){})->get());

                // ****** Validaciones de encabezado *******

                $this->validate_heading(); 
                if ($this->arr_error) return view('admin.masivos.cargue.index')->with('err', $this->arr_error);
                
                
                // ****** Validaciones de formato *******
                
                $this->validation();
                if ($this->arr_error) return view('admin.masivos.cargue.index')->with('err', $this->arr_error);
                
                // ****** Valida si existen el cliente, credito o solicitud *******
                
                $this->rulesBeforePay(); 
                if ($this->arr_error) return view('admin.masivos.cargue.index')->with('err', $this->arr_error);
                
                // ****** Realizar Pagos *******

                $this->makePayments();

                if ($this->arr_error) {
                    return view('admin.masivos.cargue.index')->with('err', $this->arr_error);
                } else {

                    return view('admin.masivos.cargue.index')
                        ->with('err',null)
                        ->with('load', _\Load::find($this->load->id));
                }
 
            } 
            else {
                
                $this->arr_error[] = [
                    'line' => '',
                    'message' => 'Formato o nombre no soportado'
                ];
            }

            return view('admin.masivos.cargue.index')
                ->with('err', $this->arr_error);
        }
    }


    /**
     * BUSCA QUE EXISTA EL CLIENTE
     * QUE EXISTA UN CREDITO O UNA SOLICITUD PARA HACER 
     * EL PAGO
     * 
     * PG 17102020
     */

    public function makePayments()
    {
        DB::beginTransaction();

        try {

            $this->load = new _\Load();
            $this->load->filename = $this->filename;
            $this->load->created_by = Auth::user()->id;
            $this->load->save();

            for ($this->index = 0; $this->index < count($this->data); $this->index ++) {
       
                if ($this->data[$this->index]['credito_id'] != null ) {
                    
                    $this->pagoCredito();
    
                } else if ($this->data[$this->index]['solicitud_id'] != null) {
                    
                    $this->pagoSolicitud();
                }
            }

            DB::commit();

        } catch ( \Exception $e) {
            DB::rollback();
            dd($e);
        }

    }

    /**
     * Revisa la existencia de cliente, solicitud o crédito
     */

    
    public function rulesBeforePay() 
    {
        for ($this->index = 0; $this->index < count($this->data); $this->index ++) {

            $this->data[$this->index]['cliente_id'] = null;
            $this->data[$this->index]['credito_id'] = null;
            $this->data[$this->index]['solicitud_id'] = null;

            $this->ruleCliente();
            $this->ruleObligacion();
        }
    }

    /**
     * VALIDACIÓN EXISTENCIA DEL CLIENTE
     */

    public function ruleCliente() 
    {
        $cliente = DB::table('clientes')
            ->where('num_doc', $this->data[$this->index]['documento'])
            ->first();

        if (isset($cliente)) {
           $this->data[$this->index]['cliente_id'] = $cliente->id;
        } else {
            $this->arr_error[] = [
                'line' => $this->index + 2,
                'message' => 'El documento '.$this->data[$this->index]['documento'].' no existe'
            ];
            $this->data[$this->index]['cliente_id'] = null;
        }
    }

    /**
     * VALIDACIÓN EXISTENCIA DE OBLIGACIÓN
     * CRÉDITO O SOLICITUD
     */

    public function ruleObligacion()
    {
        $credito = $this->getCreditosActivo($this->data[$this->index]['cliente_id']);

        
        // Si tiene crédito activo
        
        if (isset($credito)) {

            $acuerdos = \DB::table('acuerdos')->where('credito_id',$credito->id)->where('estado','Abierto')->count();

            $this->data[$this->index]['credito_id'] = $credito->id;

            // VALIDACIÓN DE ACUERDO DE PAGO

            if ($acuerdos) {
                $this->arr_error[] = [
                    'line' => $this->index + 2,
                    'message' => "El credito $credito->id, tiene acuerdo de pago, recomendamos hacer el pago manual"
                ];
            }
        } 
        
        // Si no tiene credito activo pero si una solicitud pendiente

        else {
            $solicitud = $this->lastSolicitud($this->data[$this->index]['cliente_id']);
            $this->data[$this->index]['solicitud_id'] = ($solicitud) ? $solicitud->id : null;            
        }

        // si no tiene ni credito ni solicitud

        if ($this->data[$this->index]['credito_id'] === null
            && 
            $this->data[$this->index]['solicitud_id'] === null) 
        {
            $this->arr_error[] = [
                'line' => $this->index + 2,
                'message' => "No se encuentra una solicitud o un crédito activo para el documento ".$this->data[$this->index]['documento']
            ];
        }
    }
    

    /**
     * REALIZAR PAGOS A SOLICITUD SI ESTA EXISTE
     */

    public function pagoSolicitud()
    {
        $solicitud = DB::table('precreditos')->where('id',$this->data[$this->index]['solicitud_id'])->first();

        // Si existe una solicitud

        if (isset($solicitud->id)) {

            $pagos = $this->getPagosSolicitud($solicitud->id);

            // Validar si requiere pagos por estudio

            if ( $solicitud->estudio === 'Tipico' && !$pagos->where('concepto_id',1)->all() ){

                $estudio= DB::table('fact_precred_conceptos')->where('id', 1)->first();
                
                // validar que el valor del pago sea igual al del concepto
    
                if ($this->data[$this->index]['monto'] ==  $estudio->valor) {
            
                    // realizar pago por estudio
                    $recibo = new _\FactPrecredito();
                    $recibo->num_fact = $this->auto();
                    $recibo->fecha = $this->data[$this->index]['fecha'];
                    $recibo->tipo = 'Consignación';
                    $recibo->ref = $this->data[$this->index]['referencia'];
                    $recibo->precredito_id = $solicitud->id;
                    $recibo->total =  $this->data[$this->index]['monto'];
                    $recibo->user_create_id = Auth::user()->id;
                    $recibo->save();
            
                    $pago = new _\PrecreditoPago();
                    $pago->fact_precredito_id = $recibo->id;
                    $pago->concepto_id = 1;
                    $pago->precredito_id = $solicitud->id;
                    $pago->subtotal = $this->data[$this->index]['monto'];
                    $pago->user_create_id = Auth::user()->id;
                    $pago->save();

                    // Guardar soporte del cargue a masivos

                    $masivo = DB::table('masivos')->insert([
                        'fecha' => $this->data[$this->index]['fecha'],
                        'documento' => $this->data[$this->index]['documento'],
                        'referencia' => $this->data[$this->index]['referencia'],
                        'monto' => $this->data[$this->index]['monto'],
                        'entidad' => $this->data[$this->index]['entidad'],
                        'efectivo' => true,
                        'ref_type' => 'App\\Precredito',
                        'ref_id' => $this->data[$this->index]['solicitud_id'],
                        'ref_recibo_id' => $recibo->id,
                        'load_id' => $this->load->id
                    ]);
        
                } else {
        
                    $this->arr_error[] = [
                        'line' => $this->index + 2,
                        'message' => "No se pudo registrar el pago, no se encuentran coincidencias en los valores (soicitud $solicitu->id)"
                    ];
                }
	        }
            // verificar si requiere pago por cuota inicial
            else if ( $solicitud->cuota_inicial > 0 && !$pagos->where('concepto_id',2)->all() ) {

                $inicial = DB::table('fact_precred_conceptos')->where('id',2)->get();

                // para que cargue la inicial el valor ingresado debe ser igual al reg en la solicitud

                if ($this->data[$this->index]['monto'] == $inicial->valor) {
            
                    $recibo = new _\FactPrecredito();
                    $recibo->num_fact = $this->auto();
                    $recibo->fecha = $this->data[$this->index]['fecha'];
                    $recibo->tipo = 'Consignación';
                    $recibo->ref = $this->data[$this->index]['referencia'];
                    $recibo->precredito_id = $solicitud->id;
                    $recibo->total =  $this->data[$this->index]['monto'];
                    $recibo->user_create_id = Auth::user()->id;
                    $recibo->save();

                    $pago = new _\PrecreditoPago();
                    $pago->fact_precredito_id = $recibo->id;
                    $pago->concepto_id = 2;
                    $pago->precredito_id = $solicitud->id;
                    $pago->subtotal = $this->data[$this->index]['monto'];
                    $pago->user_create_id = Auth::user()->id;
                    $pago->save();

                    // Guardar soporte del cargue a masivos

                    $masivo = DB::table('masivos')->insert([
                        'fecha' => $this->data[$this->index]['fecha'],
                        'documento' => $this->data[$this->index]['documento'],
                        'referencia' => $this->data[$this->index]['referencia'],
                        'monto' => $this->data[$this->index]['monto'],
                        'entidad' => $this->data[$this->index]['entidad'],
                        'efectivo' => true,
                        'ref_type' => 'App\\Precredito',
                        'ref_id' => $this->data[$this->index]['solicitud_id'],
                        'ref_recibo_id' => $recibo->id,
                        'load_id' => $this->load->id    
                    ]);
                
                } else {
                
                    $this->arr_error[] = [
                        'line' => $this->index + 2,
                        'message' => "No se pudo registrar el pago, no se encuentran coincidencias en los valores (soicitud $solicitu->id)"
                    ];	
                }
            } else {
                $this->arr_error[] = [
                    'line' => $this->index + 2,
                    'message' => "No se pudo registrar el pago, no se encuentran coincidencias en los valores (soicitud $solicitu->id)"
                ];
            }
        }
    }

    /**
     * Realizar pagos  a crédito si este existe
     */

    public function pagoCredito()
    {
        $repo = new PagoRepository();
        $factura = new FacturaController($repo);
        $factura->create($this->data[$this->index]['credito_id'], 'interno');

        $request_prepago = new \Illuminate\Http\Request();

        $request_prepago->replace([
            'monto' => $this->data[$this->index]['monto'],
            'credito_id' => $this->data[$this->index]['credito_id'],
            'interno' => true
        ]);

        $prepago = $factura->abonos($request_prepago);

        $general = [
            'interno' => true,
            'auto' => false,
            'tipo_pago' => 'Consignación',
            'banco' => $this->data[$this->index]['entidad'],
            'credito_id' => $this->data[$this->index]['credito_id'],
            'monto' => $this->data[$this->index]['monto'],
            'num_consignacion' => $this->data[$this->index]['referencia'],
            'num_fact' => $this->auto(),
            'pagos' => $prepago['data']
        ];

        $request_pago = new \Illuminate\Http\Request();

        $request_pago->replace($general);

        $factura_id = $factura->store($request_pago);

        $dat = [
            'fecha' => $this->data[$this->index]['fecha'],
            'documento' => $this->data[$this->index]['documento'],
            'referencia' => $this->data[$this->index]['referencia'],
            'monto' => $this->data[$this->index]['monto'],
            'entidad' => $this->data[$this->index]['entidad'],
            'efectivo' => true,
            'ref_type' => 'App\\Credito',
            'ref_id' => $this->data[$this->index]['credito_id'],
            'ref_recibo_id' => $factura_id,
            'load_id' => $this->load->id
        ];

        $masivo = DB::table('masivos')->insert($dat);
        
    }

    public function getPagosSolicitud($solicitud_id)
    {
        return collect(DB::table('precred_pagos')
            ->join('fact_precred_conceptos','precred_pagos.concepto_id','=','fact_precred_conceptos.id')
            ->select('precred_pagos.*', 'fact_precred_conceptos.nombre as concepto')
            ->where('precredito_id',$solicitud_id)
            ->get());
    }



    public function getCreditosActivo($cliente_id) 
    {
        return DB::table('creditos')
            ->join('precreditos','creditos.precredito_id','=','precreditos.id')
            ->join('clientes','precreditos.cliente_id','=','clientes.id')
            ->select('creditos.*')
            ->whereNotIn('creditos.estado',['Cancelados','Cancelado por refinanciacion'])
            ->where('clientes.id',$cliente_id)
            ->first();
    }

    public function lastSolicitud($cliente_id)
    {
        return DB::table('precreditos')
            ->join('clientes','precreditos.cliente_id','=','clientes.id')
            ->select('precreditos.*')
            ->where('clientes.id',$cliente_id)
            ->orderBy('precreditos.id','DESC')
            ->first();
    }

    /**
     * GENERACIÓN AUTOMATICA DEL CONSECUTIVO DEL PAGO
     */

     public function auto()
     {
       $punto = _\Punto::find(Auth::user()->punto_id);
       $punto->increment = $punto->increment + 1;
       $punto->save();
       return $punto->prefijo.$punto->increment;
     }

    /**
     * VALIDACION DE ACUERDOS DE PAGO
     */

    public function validAcuerdo()
    {
        $credito_id = $this->data[$this->index];

        $acuerdo = DB::table('acuerdos')
            ->where('credito_id',$credito_id)
            ->where('estado','Abierto')
            ->get();

        if ($acuerdo) {
            $this->err[] = [
                'line' => $this->index + 2,
                'message' => "El crédito $credito_id tiene un acuerdo de pago"
            ];
        }
    }
  

      
    public function validate_sanciones()
    {
           
    }

    /**
     * VALIDACION ENCABEZADO  DE TABLA
     */

    public function validate_heading() 
    {
        $keys = $this->data[0]->keys();

        if ($keys->all()[0] != 'fecha' ) {
            $this->arr_error[] =  [
                'line'      => 1,
                'message'   => 'La primera columna debe llamarse fecha'
            ];
        }
        if ($keys->all()[1] != 'documento') {
            $this->arr_error[] =  [
                'line'      => 1,
                'message'   => 'La segunda columna debe llamarse documento'
            ];
        }
        if ($keys->all()[2] != 'referencia') {
            $this->arr_error[] = [
                'line'      => 1,
                'message'   => 'La tercer columna debe llamarse referencia'
            ]; 
        }
        if ($keys->all()[3] != 'monto') {
            $this->arr_error[] = [
                'line'      => 1,
                'message'   =>  'La cuarta columna debe llamarse monto'
            ]; 
        }
        if ($keys->all()[4] != 'entidad') {
            $this->arr_error[] = [
                'line'      => 1,
                'message'   => 'La quinta columna debe llamarse entidad'
            ]; 
        }
    }

    /**
     * VALIDACION DE INTEGRIDAD DE DATOS
     */


    public function validation()
    {

        $this->index = 1;

        foreach ($this->data as $item) 
        {
            $this->index ++;

            $validation = Validator::make($item->toArray(), [
                'documento'     => 'required|integer|min:1',
                'referencia'    => 'required|alpha_num',
                'monto'         => 'required|integer|min:1',
                'entidad'       => 'required'
            ],[
                'documento.required'    => 'El campo documento es requerido',
                'documento.integer'     => 'El campo documento debe ser un entero',
                'documento.min'         => 'El campo documento debe ser mayor 0',
                'referencia.required'   => 'El campo referencia es requerido',     
                'referencia.alpha_num'  => 'El campo referencia debe contener números y/o letras',
                'monto.required'        => 'El campo monto es requerido',
                'monto.integer'         => 'El campo monto debe ser un entero',
                'monto.min'             => 'El campo monto debe ser mayor 0',
                'entidad.required'      => 'El campo entidad es requerido'
            ]);

            if ($validation->fails()) {

                foreach ($validation->errors()->toArray() as $err) {
                    $this->arr_error[] = [
                        'line'   => $this->index,
                        'message' => $err[0]
                    ];
                }
            }   

            $this->validate_banco($item);
        }    
    }

    /**
     * VALIDACION DE LA EXISTENCIA DEL BANCO O 
     * PUNTO DE RECAUDO
     */

    public function validate_banco($item)
    {
        $flag = false;

        foreach ($this->bancos as $banco)
        {
            if (strtolower($banco->nombre) == strtolower($item->entidad)) $flag = true; 
        }

        if (!$flag) {
            $this->arr_error[] = [
                'line' => $this->index,
                'message' => 'EL nombre de la entidad no coincide con nuestros registros'
            ];
        }
   

    }

    public function getPlantilla() 
    {
        $arr = [];

        $header = [
            'fecha',
            'documento',
            'referencia',
            'monto',
            'entidad'
        ];
        // dd($header);

        $datos_prueba = [
            '2020-09-15',
            '9860668',
            '425689',
            '45000',
            'apostar'
        ];
       
        $arr[] = $header;
        $arr[] = $datos_prueba; 

        Excel::create('pagos_masivos_'.strtotime(Carbon::now()),function($excel) use ($arr){
            
            $excel->sheet('Sheetname',function($sheet) use ($arr){       
                
            $sheet->fromArray($arr,null,'A1',false,false);
            });
        })->download('xls');
    }


}


