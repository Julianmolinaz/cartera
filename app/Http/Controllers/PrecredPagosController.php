<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Factprecredito;
use App\Anulada;
use DB;
use Auth;

class PrecredPagosController extends Controller
{
    public function show($fact_precredito_id)
    {
        $facturas = Factprecredito::find($fact_precredito_id);

        return view('start.precred_pagos.show')
            ->with('factura', $facturas);
    }

    public function anular(Request $request)
    {
        DB::beginTransaction();
        try {
            $factura = Factprecredito::find($request->factura_id);
            $num_fact = $factura->num_fact;
            $precredito_id = $factura->precredito->id;

            $this->create_anulada($factura, $request);
    
            foreach($factura->pagos as $pago) {
                $pago = DB::table('precred_pagos')->where('id','=',$pago->id)->delete();
            }
    
            $factura->delete();
            DB::commit();

            flash()->success('Se eliminó la factura número '.$num_fact.' con Éxito!!!! :(');
            return redirect()->route('start.precreditos.ver',$precredito_id);

        } catch(\Exception $e) {
            DB::rollback();
            flash()->error('Se presentó un error al eliminar la factura:  :(  error: '.$e->getMessage());
            return redirect()->route('start.precreditos.ver',$precredito_id);
        }
    }

    public function create_anulada($factura, $request)
    {
        $anulada = new Anulada();
        $anulada->cliente_id = $factura->precredito->cliente_id;
        $anulada->factura_id = $factura->id;
        $anulada->credito_id = null;
        $anulada->precredito_id = $factura->precredito_id;
        $anulada->num_fact   = $factura->num_fact;
        $anulada->fecha      = $factura->fecha;
        $anulada->total      = $factura->total;
        $anulada->pagos      = "";
        $anulada->motivo_anulacion = $request->input('motivo_anulacion');
        $anulada->user_anula = Auth::user()->id;
        $anulada->user_create_id = $factura->user_create_id;
        $anulada->pagos = $anulada->pagos.' ** FACTURA POR SOLICITUD # '.$factura->num_fact.' CREADA EL: '.$factura->created_at.' por '.$factura->user_create->name.' **';
        
        foreach($factura->pagos as $pago) {
            $detalle_del_pago = '[ ID='.$pago->id.',CONCEPTO='.$pago->concepto->nombre.',SUBTOTAL='.$pago->subtotal.']';

            $anulada->pagos = $anulada->pagos.$detalle_del_pago;
        }


        $anulada->save();
    }
}
