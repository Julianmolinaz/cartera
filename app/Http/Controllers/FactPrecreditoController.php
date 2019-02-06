<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ConceptoFactPrecredito;
use App\Traits\FacturaPrecreditoTrait;
use App\Factprecredito;
use App\PrecreditoPago;
use App\Precredito;
use Carbon\Carbon;
use App\Punto;
use Validator;
use Auth;
use DB;

class FactPrecreditoController extends Controller
{
    use FacturaPrecreditoTrait;

    protected $fact;
    protected $now;

    function __construct()
    {
        $this->fact = new Factprecredito();
        $this->now  = Carbon::now();
    }  

    public function invoice_to_print($factura_id)
    {
      return $this->generate_content_to_print($factura_id);
    }
 
    
    public function create($precredito_id)
    {
    	$precredito = Precredito::find($precredito_id);
    	$tipo_pago  = getEnumValues('fact_precreditos','tipo');
    	$punto      = Punto::find(Auth::user()->punto_id);
        $conceptos  = ConceptoFactPrecredito::orderBy('id')->get();
        $pagos      = PrecreditoPago::where('precredito_id',$precredito_id)
                        ->orderBy('created_at','desc')
                        ->get();

    	return view('start.facturas.fact_precredito.create')
    		->with('precredito',$precredito)
    		->with('tipo_pago',$tipo_pago)
            ->with('conceptos', $conceptos)
    		->with('punto',$punto)
            ->with('pagos',$pagos);
    }

    public function store(Request $request)
    {

        try {

            // consecutivo automatico ****

            if($request->factura['auto']){
                $this->auto();
            }
            // si se elabora manualmente la factura
            else{
                //validar que la el numero de factura no se repita

                if( $this->exist_fact( $request->factura['num_fact'] )) {
                    return response()->json(['error' => true,
                        'message'=>'Ya existe una factura con ese número de factura']);
                } else {
                    $this->fact->num_fact = $request->factura['num_fact'];
                }
            }
            // validar fecha
            if(! $this->validar_fecha($request->factura['fecha']) ){
                return response()->json(['error' => true, 'message' => 'Fecha incorrecta']);
            }

            //llenado de datos restantes factura ********************************
            $this->fact->precredito_id    = $request->factura['precredito']['id'];
            $this->fact->total            = $request->factura['total'];
            $this->fact->tipo             = $request->factura['tipo'];
            $this->fact->user_create_id   = Auth::user()->id;
            $this->fact->save();


            //creacion de pagos ***************
            $this->set_pagos($request->factura);

            DB::commit();

            //respuesta**************************************************
            $res = ['error' => false, 'message' => 'Transacción exitosa', 'dat' => $this->fact];

            return response()->json($res);

            
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error'=>true, 'message'=>$e->getMessage()]);
        }
    }


    /**
     * Falida que la fecha de la factura sea correcta
     * 1- Si es un administrador la fecha puede ser de n $meses restantes
     * 2- No se permite fechas futuras
     * 3- Si es diferente de Administrador solo se permite la fecha actual
     * recibe: una fecha en formato 'YYYY-MM-DD'
     */


    public function validar_fecha($fecha)
    {
        $fecha   = new Carbon($fecha);
        $hoy     = Carbon::now();
        $meses_restantes = 3;

        //SI ES ADMINISTRADOR PERMITIR FECHAS ANTERIORES

        if(Auth::user()->rol === 'Administrador'){
            $desde   = Carbon::now()->subMonths($meses_restantes);

            if( $fecha->between($desde,$hoy) ){
                $this->fact->fecha = $fecha;
                return true;
            } else {
                return false;
            }
        }

        // SI NO ES ADMINISTRADOR SOLO PERMITE LA FECHA ACTUAL

        else{ 
            if($fecha->toDateString() === $hoy->toDateString() ) {
                $this->fact->fecha = $fecha;
                return true;
            } else {
                return false;
            }
        }

    }


    /**
     * crea pagos contenidos en una factura
     * @input $factura generada en la vista
     */


    public function set_pagos($factura) 
    {
        foreach( $factura['pagos'] as $pago ){
            $buy = new PrecreditoPago();
            $buy->concepto_id         = $pago[0]['concepto']['id'];
            $buy->fact_precredito_id  = $this->fact->id;
            $buy->precredito_id       = $factura['precredito']['id'];
            $buy->subtotal            = $pago[0]['subtotal'];
            $buy->user_create_id      = Auth()->user()->id;
            $buy->save();
        }
    }

    /**
     * Generador automatico de fecha acvtual y número de factura
     * ejemplo PER1
     */
    public function auto()
    {
        $punto              = Punto::find(Auth::user()->punto_id); 
        $punto->increment   = $punto->increment + 1;   
        $this->fact->num_fact  = $punto->prefijo.$punto->increment;
        $this->fact->fecha     = $this->now;
        $punto->save();
    }


    /**
     * valida mediante un numero de factura "$num_fact"
     * si ya existe.
     * @return true: si existe factura; false: si no
     */

    public function exist_fact($num_fact)
    {
        $fact = DB::table('fact_precreditos')
            ->where('num_fact','=',$num_fact)
            ->count();

        if($fact > 0){
            return true; 
        } else {
            return false;
        }
        
    }

}

