<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ConceptoFactPrecredito;
use App\Precredito;
use App\Punto;
use App\Factprecredito;
use Validator;
use Auth;
use DB;

class FactPrecreditoCotroller extends Controller
{
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
            //crear factura
            $fact = new Factprecredito();

            //QUEDA FALTANDO CONFIGURAR LA FECHA ??????????????????????

            // si se requiere consecutivo automatico
            if($request->factura['auto']){

                $punto              = Punto::find(Auth::user()->punto_id); 
                $prefijo            = $punto->prefijo;
                $consecutivo        = $punto->increment + 1;
                $punto->increment   = $consecutivo; 
                $punto->save();

                $date_time          = new Carbon($request->fecha);
                $fact->num_fact     = $prefijo.$consecutivo;
                $fact->fecha        = $date_time->format('d-m-Y');
            }
            // si se elabora manualmente la factura
            else{
                //validar que la el numero de factura no se repita
                if( $this->exist_fact( $request->factura['num_fact'] )){
                    return response()->json(['error' => true,
                        'message'=>'Ya existe una factura con ese número de factura']);
                } else{
                    $fact->num_fact = $request->factura['num_fact'];
                }
            }

            $fact->precredito_id    = $request->factura['precredito']['id'];
            $fact->total            = $request->factura['total'];
            $fact->tipo             = $request->factura['tipo'];
            $fact->user_create_id   = Auth::user()->id;

            return response()->json($fact);

            
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error'=>true, 'message'=>$e->getMessage()]);
        }

        return response()->json($fact);


    }

    public function exist_fact($num_fact)
    {
        $fact = DB::table('facturas')
            ->where('num_fact','=',$num_fact)
            ->count();

        return ($fact > 0) ? true : false;
        
    }

}

