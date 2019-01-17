<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ConceptoFactPrecredito;
use App\Factprecredito;
use App\PrecreditoPago;
use App\Precredito;
use Carbon\Carbon;
use App\Punto;
use Validator;
use Auth;
use DB;

class FactPrecreditoCotroller extends Controller
{
    protected $fact;
    protected $now;

    function __construct()
    {
        $this->fact = new Factprecredito();
        $this->now  = Carbon::now();
    }   
    
    public function create($precredito_id)
    {
    	$precredito = Precredito::find($precredito_id);
    	$tipo_pago  = getEnumValues('fact_precreditos','tipo');
    	$punto      = Punto::find(Auth::user()->punto_id);
        $conceptos  = ConceptoFactPrecredito::orderBy('nombre')->get();

    	return view('start.facturas.fact_precredito.create')
    		->with('precredito',$precredito)
    		->with('tipo_pago',$tipo_pago)
            ->with('conceptos', $conceptos)
    		->with('punto',$punto);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            //QUEDA FALTANDO CONFIGURAR LA FECHA ??????????????????????

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
                    $validacion_fecha = $this->validar_fecha($request->factura['fecha']);
                    if(!  $validacion_fecha->valid ){
                        return $validacion_fecha->respuesta;
                    }
                }
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
            $res = ['error' => false, 'message' => 'Transacción exitosa'];

            return response()->json($res);

            
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error'=>true, 'message'=>$e->getMessage()]);
        }
    }


    public function validar_fecha($fecha)
    {
        //VALIDAR QUE SEA UNA FECHA PERMITIDA

        //SI ES ADMINISTRADOR PERMITIR FECHAS ANTERIORES

        // SI NO ES ADMINISTRADOR SOLO PERMITE LA FECHA ACTUAL
        
        //NO PERMITIR FECHAS FUTURAS

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
            $buy->valor               = $pago[0]['concepto']['valor'];
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
        $fact = DB::table('facturas')
            ->where('num_fact','=',$num_fact)
            ->count();

        return ($fact > 0) ? true : false;
        
    }

}

