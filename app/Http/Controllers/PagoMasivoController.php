<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\MyService\PagosSolicitudService;
use App\Http\Controllers\FacturaController;
use App\Repositories\PagoRepository;
use App\MyService\FormatDate;
use App\PagoMasivo; 
use Carbon\Carbon;
use Datatables;
use Validator;
use Exception;
use Excel;
use File;
use Auth;
use App as _;
use DB;


class PagoMasivoController extends Controller
{
    public $report;         // array contenedor de los registros
    public $data;           
    public $arr_error = []; // array contenedor de errores
    public $bancos;         // listado de bancos
    public $index = 0;      // iniciación del indice para recorrer los registros importados
    public $filename = '';  // nombre del archivo inportado
    public $load = '';      
    public $factura;        
    public $now;            // fecha actual
    protected $vlr_dia_sancion; 
    const LIMIT_SANCIONES = 10; // Máximo número de sanciones que el sistema puede eliminar

    public function __construct()
    {
        $this->bancos = DB::table('bancos')->get();
        $this->now = Carbon::now();
        $this->vlr_dia_sancion = _\Variable::find(1)->vlr_dia_sancion;

    }

    public function index() 
    {
        return view('admin.masivos.index');
    }

    /**
     * List files upload (loads)
     * PG
     */

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

    /**
     * list masivos from load id file
     * PG
     */

    public function listMasivos($load_id)
    {
        $load = _\Load::find($load_id);

        return view('admin.masivos.cargue.masivos')
            ->with('load', $load);
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

            // Unique file name and format validation

            if ($exist_log) {

                $this->arr_error[] = [
                    'line' => '',
                    'message' => 'Un archivo con este mismo nombre ya fué cargado.'
                ];
            }

            //  Valid format file

            else if ($extension != "xlsx" && $extension != "xls" && $extension != "csv") {

                $this->arr_error[] = [
                    'line' => '',
                    'message' => 'El formato del archivo no corresponde a las permitidas.'
                ];
            }

            if ($this->arr_error) return view('admin.masivos.cargue.index')->with('err', $this->arr_error);


            $path = $request->archivo->getRealPath();

            $this->data = collect(Excel::load($path, function($reader){})->get());

            // valida data to process

            if (! $this->processData() ) return view('admin.masivos.cargue.index')->with('err', $this->arr_error); 


            // if no exixst errors return view
                
            return view('admin.masivos.index')
                ->with('err',null)
                ->with('load', _\Load::find($this->load->id));

        }
    }

    /**
     * Execute validations and payments
     */

    public function processData()
    {
        DB::beginTransaction();

        try {

            // ****** Validaciones de encabezado *******    
    
            $this->validate_heading(); 
            if ($this->arr_error) return false;
    
            // ****** Validaciones de formato *******
            
            $this->validation();
            if ($this->arr_error) return false;
            
            // ****** Valida si existen el cliente, credito o solicitud *******
            $this->rulesBeforePay(); 
            if ($this->arr_error) return false;

            // ****** Valida que no existan pagos cercanos ************
            $this->pagosRecientes();
            if ($this->arr_error) return false;

            // ****** Realizar Pagos *******
            $this->makePayments();
            if ($this->arr_error) return false;

            DB::commit();
            return true;

        } catch (Excetpion $e) {
            \Log::info($e);

            DB::rollback();
            return false;
        }

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
                'fecha'         => 'required|date',
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
     * Revisa la existencia de cliente, solicitud o crédito
     */

    
    public function rulesBeforePay() 
    {
        try  {

            for ($this->index = 0; $this->index < count($this->data); $this->index ++) {
    
                $this->data[$this->index]['cliente_id'] = null;
                $this->data[$this->index]['credito_id'] = null;
                $this->data[$this->index]['solicitud_id'] = null;

                
                $this->ruleCliente();
                $this->ruleObligacion();
            }
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
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
        try {

            $this->saveFileLoad();

            
            for ($this->index = 0; $this->index < count($this->data); $this->index ++) {
                
                $exist_masivo = DB::table('masivos')
                    ->join('loads','masivos.load_id','=','loads.id')
                    ->select('masivos.*','loads.filename')
                    ->where('referencia',$this->data[$this->index]['referencia'])
                    ->first();
                
                // **********************************************************************
                // if exist masivo reference 

                if ($exist_masivo) {

                    $type = ($exist_masivo->ref_type == 'App\\Precredito' ) ? 'Solicitud' : 'Crédito';

                    if ($type == 'Solicitud') $recibo = \DB::table('fact_precreditos')->where('id',$exist_masivo->ref_recibo_id)->first();
                    else $recibo = \DB::table('facturas')->where('id', $exist_masivo->ref_recibo_id)->first();

                    $num_fact = (isset($recibo->num_fact)) ? $recibo->num_fact : '@=(PAGO NO ENCONTRADO)=@';

                    $this->arr_error[] = [
                        'line' => $this->index + 2,
                        'message' => "Ya existe un cargue con esta referencia. Ver $type $exist_masivo->ref_id - Archivo: $exist_masivo->filename"
                    ];

                }
                
                // **********************************************************************
                // if exist credito

                else if ( $this->data[$this->index]['credito_id'] != null ) {
                    try {
                        $this->pagoCredito();
                    } catch (Exception $e) {
                        throw new Exception($e, 1);
                        
                    }
                } 
                
                // if exist solicitud
                else if ($this->data[$this->index]['solicitud_id'] != null) {
                    $this->pagoSolicitud();
                }
            }

            if ( !DB::table('masivos')->where('load_id', $this->load->id)->count() ) {
                array_unshift($this->arr_error, ['line' => null, 'message' => 'Ningun pago registrado']);
            } 

        } catch ( \Exception $e) {
            throw new Exception($e, 1);   
        }

    }

    /**
     * Save file upload
     * PG
     */

    public function saveFileLoad()
    {
        $this->load = new _\Load();
        $this->load->filename = $this->filename;
        $this->load->created_by = Auth::user()->id;
        $this->load->save();
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

        if ($this->data[$this->index]['credito_id'] === null && 
            $this->data[$this->index]['solicitud_id'] === null) {

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
        $solicitud = DB::table('precreditos')
            ->where('id',$this->data[$this->index]['solicitud_id'])
            ->first();

        // Si existe una solicitud

        if (isset($solicitud->id)) {

            $pagos = $this->getPagosSolicitud($solicitud->id);

            // Validar si requiere pagos por estudio

            if ( $solicitud->estudio === 'Tipico' && !$pagos->where('concepto_id',1)->all() ) {

                $estudio= DB::table('fact_precred_conceptos')->where('id', 1)->first();
                
                // validar que el valor del pago sea igual al del concepto
    
                if ($this->data[$this->index]['monto'] ==  $estudio->valor) {
            
                    // realizar pago por estudio
                    $recibo                 = new _\Factprecredito();
                    $recibo->num_fact       = $this->auto();
                    $recibo->fecha          = $this->data[$this->index]['fecha'];
                    $recibo->tipo           = 'Consignación';
                    $recibo->precredito_id  = $solicitud->id;
                    $recibo->total          =  $this->data[$this->index]['monto'];
                    $recibo->user_create_id = Auth::user()->id;
                    $recibo->save();
            
                    $pago                     = new _\PrecreditoPago();
                    $pago->fact_precredito_id = $recibo->id;
                    $pago->concepto_id        = 1;
                    $pago->precredito_id      = $solicitud->id;
                    $pago->subtotal           = $this->data[$this->index]['monto'];
                    $pago->user_create_id     = Auth::user()->id;
                    $pago->save();

                    // Guardar soporte del cargue a masivos

                    $masivo = DB::table('masivos')->insert([
                        'fecha'         => $this->data[$this->index]['fecha'],
                        'documento'     => $this->data[$this->index]['documento'],
                        'referencia'    => $this->data[$this->index]['referencia'],
                        'monto'         => $this->data[$this->index]['monto'],
                        'entidad'       => $this->data[$this->index]['entidad'],
                        'efectivo'      => true,
                        'ref_type'      => 'App\\Precredito',
                        'ref_id'        => $this->data[$this->index]['solicitud_id'],
                        'ref_recibo_id' => $recibo->id,
                        'load_id'       => $this->load->id,
                        'created_at'    => $this->now
                    ]);
        
                } else {
        
                    $this->arr_error[] = [
                        'line' => $this->index + 2,
                        'message' => "No se pudo registrar el pago, no se encuentran coincidencias o no tiene un credito activo (soicitud $solicitud->id)"
                    ];
                }
	        }
            // verificar si requiere pago por cuota inicial
            else if ( $solicitud->cuota_inicial > 0 && !$pagos->where('concepto_id',2)->all() ) {

                $solicitud = DB::table('precreditos')->where('id',$this->data[$this->index]['solicitud_id'])->first();
                // para que cargue la inicial el valor ingresado debe ser igual al reg en la solicitud

                if ($this->data[$this->index]['monto'] == $solicitud->cuota_inicial) {

                    // make payment inicial
            
                    $recibo                 = new _\Factprecredito();
                    $recibo->num_fact       = $this->auto();
                    $recibo->fecha          = $this->data[$this->index]['fecha'];
                    $recibo->tipo           = 'Consignación';
                    $recibo->precredito_id  = $solicitud->id;
                    $recibo->total          =  $this->data[$this->index]['monto'];
                    $recibo->user_create_id = Auth::user()->id;
                    $recibo->save();

                    $pago                   = new _\PrecreditoPago();
                    $pago->fact_precredito_id = $recibo->id;
                    $pago->concepto_id      = 2;
                    $pago->precredito_id    = $solicitud->id;
                    $pago->subtotal         = $this->data[$this->index]['monto'];
                    $pago->user_create_id   = Auth::user()->id;
                    $pago->save();

                    // Save suport in masivos

                    $masivo = DB::table('masivos')->insert([
                        'fecha'         => $this->data[$this->index]['fecha'],
                        'documento'     => $this->data[$this->index]['documento'],
                        'referencia'    => $this->data[$this->index]['referencia'],
                        'monto'         => $this->data[$this->index]['monto'],
                        'entidad'       => $this->data[$this->index]['entidad'],
                        'efectivo'      => true,
                        'ref_type'      => 'App\\Precredito',
                        'ref_id'        => $this->data[$this->index]['solicitud_id'],
                        'ref_recibo_id' => $recibo->id,
                        'load_id'       => $this->load->id,
                        'created_at'    => $this->now
                    ]);
                
                } else {
                
                    $this->arr_error[] = [
                        'line' => $this->index + 2,
                        'message' => "No se pudo registrar el pago, no se encuentran coincidencias o no tiene un credito activo (soicitud $solicitud->id)"
                    ];	
                }
            } else {
                $this->arr_error[] = [
                    'line' => $this->index + 2,
                    'message' => "No se pudo registrar el pago, no se encuentran coincidencias o no tiene un credito activo (soicitud $solicitud->id)"
                ];
            }
        }
    }

    /**
     * Realizar pagos  a crédito si este existe
     */

    public function pagoCredito()
    {
        $fecha = $this->data[$this->index]['fecha'];
        $format = new FormatDate($fecha); // formated date to yyyy-mm-dd
        $fecha = $format->carbon(); // payment day

        $credito = _\Credito::find($this->data[$this->index]['credito_id']); 
        
        $this->descontarSanciones($fecha, $credito);

        /**
         * Generate payment
         */

        $abono = new \App\Classes\Abono($credito->id, intval($this->data[$this->index]['monto']));
        
        $prepago = $abono->make();

        $general = [
            'interno'           => true,
            'auto'              => true,
            'tipo_pago'         => 'Consignación',
            'fecha'             => $this->data[$this->index]['fecha'],
            'banco'             => $this->data[$this->index]['entidad'],
            'credito_id'        => $this->data[$this->index]['credito_id'],
            'monto'             => $this->data[$this->index]['monto'],
            'num_consignacion'  => $this->data[$this->index]['referencia'],
            'pagos'             => $prepago
        ];


        $recibo = new \App\Classes\PagosCredito(
            '',
            $general['fecha'],
            $general['monto'],
            $general['tipo_pago'],
            true,
            $general['pagos'],
            $general['banco'],
            $general['credito_id'],
            $general['num_consignacion'],
            \Auth::user()->id
        );

        
        $recibo->make();
        $recibo = $recibo->get();

        /**
         * Register masivo executed
         */

        $dat = [
            'fecha'         => $this->data[$this->index]['fecha'],
            'documento'     => $this->data[$this->index]['documento'],
            'referencia'    => $this->data[$this->index]['referencia'],
            'monto'         => $this->data[$this->index]['monto'],
            'entidad'       => $this->data[$this->index]['entidad'],
            'efectivo'      => true,
            'ref_type'      => 'App\\Credito',
            'ref_id'        => $this->data[$this->index]['credito_id'],
            'ref_recibo_id' => $recibo->id,
            'load_id'       => $this->load->id,
            'created_at'    => $this->now
        ];

        $masivo = DB::table('masivos')->insert($dat);
        
    }
    /*
     ** Descontar sanciones
     */

    public function descontarSanciones($fecha, $credito) 
    {

        if ( $fecha && $fecha->lt($this->now)) {

            $diff = DB::table('sanciones')
                ->where('created_at', '>', $fecha)
                ->where('credito_id', $credito->id)
                ->where('estado', 'Debe')
                ->select('id')
                ->get();

            DB::table('sanciones')
                ->whereIn('id', collect($diff)->pluck('id'))
                ->update(['estado' => 'Exonerada']);
            
            $credito->sanciones_exoneradas += count($diff);
            $credito->sanciones_debe -= count($diff);
            $credito->saldo = $credito->saldo - (count($diff) * $this->vlr_dia_sancion); 
            $credito->save();

            return true;
        } 

        return false;
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
            ->whereNotIn('creditos.estado',['Cancelado','Cancelado por refinanciacion'])
            //->where('estado', 'Al dia')
            ->where('clientes.id', $cliente_id)
            ->first();
    }

    public function lastSolicitud($cliente_id)
    {
        return DB::table('precreditos')
            ->join('clientes','precreditos.cliente_id','=','clientes.id')
            ->leftJoin('creditos','precreditos.id','=','creditos.precredito_id')
            ->select('precreditos.*')
            ->where('clientes.id',$cliente_id)
            ->whereNull('creditos.id')
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

    public function pagosRecientes()
    {
        // $depr :: mínimo de dias para la evaluación

        $depr = DB::table('consecutivos')
            ->where('prefijo', 'depr')
            ->first();
        
        $antes = Carbon::now()->subDay(intval($depr->incrementable));

        $this->index = 1;

        foreach ($this->data as $item) {

            $this->index++;

            $existen_pagos = DB::table('facturas')
                ->join('creditos', 'facturas.credito_id', '=', 'creditos.id')
                ->join('precreditos', 'creditos.precredito_id', '=', 'precreditos.id')
                ->join('clientes', 'precreditos.cliente_id', '=', 'clientes.id')
                ->where('clientes.num_doc', $item->documento)
                ->where('facturas.created_at', '>=', $antes)
                ->where('facturas.total', '=', $item->monto)
                ->count();

            if ($existen_pagos) {

                $this->arr_error[] = [
                    'line' => $this->index,
                    'message' => "Existen pagos recientes con el mismo monto, ver cliente con documento: ".$item->documento
                ];
            }
        }

    }

}


