<?php

namespace App\Traits;

trait DetalleClientesTrait
{
    public function detalleClientesTr($tipo, $rango)
    {
        $ini        = new \Carbon\Carbon( substr($rango, 0, 10) );
        $fin        = new \Carbon\Carbon( substr($rango, 13, 10) );
        $creditos   = $this->getCreditosTr($ini, $fin);

        $creditos_a_mostrar = [];

        foreach ($creditos as $credito) {
            $abonos = $this->totalPagosCtaTr($credito);

            if ($this->mostrarTr($tipo, $credito, $abonos)) {
                array_push($creditos_a_mostrar, $credito);
            }
        }
    }

    public function mostrarTr($tipo, $credito, $abonos)
    {
        if($credito->id == 5283){
            dd($credito);
        }

        if ($tipo == '01Pago') {
            if ($abonos <= $credito->vlr_fin * 0.2){ echo $credito->id.'<br>'; return true; }
            else { return false; }
        }
        else if ($tipo == 'promedio') {
            if ( ($abonos > $credito->vlr_fin * 0.2) && ($abonos <= $credito->vlr_fin * 1 )){ 
                     return true; }
            else {  return false; }
        }
        else if ($tipo == 'ideal') {
            if ( $abonos > $credito->vlr_fin * 1){ 
                     return true; }
            else {  return false; }
        }
    }

    public function totalPagosCtaTr($credito)
    {
        $pagos = 0;

        $pagos += \DB::table('pagos')
            ->where('credito_id', $credito->id)
            ->where( function ($query) {
                $query->where('concepto','Cuota')
                      ->orWhere('concepto', 'Cuota Parcial'); })
            ->sum('abono');

        $refinanciado = \DB::table('creditos')
            ->where('credito_refinanciado_id',$credito->id)
            ->first();
        
        if ($refinanciado) {
            $pagos += \DB::table('pagos')
                ->where('credito_id', $refinanciado->id)
                ->where( function ($query) {
                    $query->where('concepto','Cuota')
                        ->orWhere('concepto', 'Cuota Parcial'); })
                ->sum('abono');

            }
        
        return $pagos;
    }

    /**
     * Retorna los creditos en el rango solicitado
     * @param $ini , $fin son dos date time Carbon
     * PG 05092019
     */

    public function getCreditosTr($ini, $fin)
    {
        $negocio = \App\Negocio::find(18);
	    $ids_carteras = collect($negocio->carteras)->pluck('id');

        $creditos = \DB::table('creditos')
            ->join('precreditos','creditos.precredito_id','=','precreditos.id')
            ->join('carteras','precreditos.cartera_id','=','carteras.id')
            ->select('creditos.*', 'precreditos.vlr_fin as vlr_fin')
            ->whereIn('carteras.id',$ids_carteras)
            ->where('creditos.credito_refinanciado_id',null)
            ->whereBetween('creditos.created_at',[$ini,$fin])
            ->get();

        return $creditos;
    }

}