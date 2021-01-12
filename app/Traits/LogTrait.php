<?php

namespace App\Traits;

trait LogTrait 
{
    public function logPagoTr()
    {
        return $this->structLogFacturaTr();
    } 

    public function structLogFacturaTr()
    {
        return [
            'tipo'          =>'pago',
            'objeto'        => null, //puede ser precredito o credito   
            'saldo'         => null,
            'factura_id'    => null,
            'num_fact'      => null,
            'fecha'         => null,
            'tipo_pago'     => null,
            'banco'         => null,
            'creator_id'    => null,
            'pagos'         => []
        ];
    }

    public function structLogPagoTr()
    {
        return [
            'concepto' => null,
            'abono'    => null,
            'debe'     => null
        ];
    }
}