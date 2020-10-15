<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\MyService\PagosSolicitudService;
use App\PagoMasivo; 
use Carbon\Carbon;
use Validator;
use Excel;
use File;
use DB;


class PagoMasivoController extends Controller
{
    public $report;
    public $data;
    public $arr_error = [];
    public $bancos;
    public $index = 0;

    public function __construct()
    {
        $this->bancos = DB::table('bancos')->get();
    }


    public function index() 
    {
        return view('admin.masivos.index')
            ->with('err', []);
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
            $extension = File::extension($request->archivo->getClientOriginalName());

            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv")
            {
                $path = $request->archivo->getRealPath();

                $this->data = collect(Excel::load($path, function($reader){})->get());

                // Validaciones

                $this->validate_heading(); // valida en el encabezado del archivo

                if ($this->arr_error) 
                    return view('admin.masivos.index')->with('err', $this->arr_error);


                $this->validation(); // valida formato y requerido

                if ($this->arr_error) 
                    return view('admin.masivos.index')->with('err', $this->arr_error);

                $this->rulesPay(); // validar pagos
 
            } 
            else {
                $this->arr_error = ['Formato no soportado'];
            }

            return view('admin.masivos.index')
                ->with('err', $this->arr_error);
        }
    }

    /**
     * REGLAS PARA REALIZAR EL PAGO
     */
    
    public function rulesPay() 
    {
        for ($this->index = 0; $this->index < count($this->data); $this->index ++) {

            $this->ruleCliente($this->data[$this->index]);
            $this->ruleObligacion($this->data[$this->index]);
            $this->validAcuerdo($this->data[$this->index]);
        }
        // dd($this->err);
    }

    /**
     * REGLAS DE CLIENTE
     */

    public function ruleCliente($pay) 
    {
        // dd($pay->documento);

        $cliente = DB::table('clientes')
            ->where('num_doc', $pay->documento)
            ->first();

        if ($cliente) {
           $this->data[$this->index]['cliente_id'] = $cliente->id;
        } else {
            $this->err[] = [
                'line' => $this->index + 2,
                'message' => 'El documento '.$pay->documento.' no existe'
            ];
            $this->data[$this->index]['cliente_id'] = null;
        }
    }

    /**
     * REGLAS DE OBLICAGIÓN
     */

    public function ruleObligacion($pay)
    {
        if ($pay['cliente_id']) {

            $credito = $this->getCreditosActivo($pay['cliente_id']);

            if (isset($credito->id)) {

                $this->data[$this->index]['credito_id'] = $credito->id;

            } else {
                
                $solicitud = $this->lastSolicitud($pay['cliente_id']);

                if ($solicitud) {

                    $conceptos_pagados = $this->getPagosSolicitud($solicitud->id);

                    $conceptos = collect(DB::table('fact_precred_conceptos')->get());

                    if (empty($conceptos_pagados)) {

                        $conceptos = $conceptos->filter(function ($concepto, $key) use($conceptos_pagados){
                            foreach($conceptos_pagados as $concepto_pago) {
                                return $concepto->nombre != $concepto_pago;
                            }
                        });
                    }

                    $concepto_filtrado = $conceptos->where('valor',$pay->monto);

                    if (count($concepto_filtrado)) {

                        $concepto_filtrado = $concepto_filtrado->all()[0];

                        // hacer pago por el concepto
                        $pago_solicitud = new PagosSolicitudService();

                        $recibo = [ 
                            'fecha' => $pay->fecha,
                            'tipo' => 'Consignación',
                            'ref' => $pay->referencia,
                            'precredito_id' => $solicitud->id,
                            'total' => $pay->monto  
                        ];

                        $pagos = [
                            [
                                'concepto_id' => $concepto_filtrado->id,
                                'precredito_id' => $solicitud->id,
                                'subtotal' => $pay->monto
                            ]
                        ];

                        $pago_solicitud->make($recibo, $pagos);

                    } else {
                        // pago no fue realizado
                    }
                    
                } else {
                    // pago no fue realizado
                }

                $this->data[$this->index]['credito_id'] = null;
            }

            if (!$this->data[$this->index]->credito_id) {
                $this->err[] = [
                    'line' => $this->index + 2,
                    'message' => "No se encuentra una solicitud o un crédito activo para el documento $pay->documento"
                ];
            }
        } 
    }

    public function getPagosSolicitud($solicitud_id)
    {
        return collect(DB::table('precred_pagos')
            ->join('fact_precred_conceptos','precred_pagos.concepto_id','=','fact_precred_conceptos.id')
            ->select('fact_precred_conceptos.nombre')
            ->where('precredito_id',$solicitud_id)
            ->get())->pluck('nombre');
    }


    public function getCreditosActivo($cliente_id) 
    {
        return DB::table('creditos')
            ->join('precreditos','creditos.precredito_id','=','precreditos.id')
            ->join('clientes','precreditos.cliente_id','=','clientes.id')
            ->select('creditos.id')
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
                'documento.required'    => 'El campo documento en la linea '.$this->index.' es requerido',
                'documento.integer'     => 'El campo documento en la linea '.$this->index.' debe ser un entero',
                'documento.min'         => 'El campo documento en la linea '.$this->index.' debe ser mayor 0',
                'referencia.required'   => 'El campo referencia en la linea '.$this->index.' es requerido',     
                'referencia.alpha_num'  => 'El campo referencia en la linea '.$this->index.' debe contener números y/o letras',
                'monto.required'        => 'El campo monto en la linea '.$this->index.' es requerido',
                'monto.integer'         => 'El campo monto en la linea '.$this->index.' debe ser un entero',
                'monto.min'             => 'El campo monto en la linea '.$this->index.' debe ser mayor 0',
                'entidad.required'      => 'El campo entidad en la linea '.$this->index.' es requerido'
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
                'message' => 'EL nombre de la entidad en la linea '.$this->index.' no coincide con nuestros registros'
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

        Excel::create('plantilla_pagos_masivos',function($excel) use ($arr){
            
            $excel->sheet('Sheetname',function($sheet) use ($arr){       
                
            $sheet->fromArray($arr,null,'A1',false,false);
            });
        })->download('xls');
    }


}


