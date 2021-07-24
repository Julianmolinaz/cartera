<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masivo extends Model
{
    protected $fillable = [
        'id',
        'fecha',    
        'documento',
        'referencia',
        'monto',
        'entidad',
        'efectivo',
        'ref_type',
        'ref_id',
        'ref_pago_id',
        'created_at'
    ];

    public function getCreditoAttribute() {

        if ($this->ref_type == 'App\\Credito') {

            return Credito::where('id', $this->ref_id)
                ->first();
        } else {
            return null;
        }

    }

    public function getPrecreditoAttribute() {

        if ($this->ref_type == 'App\\Precredito') {

            return Precredito::where('id', $this->ref_id)
                ->first();
        } else {
            return null;
        }

    }   

    public function getPagoAttribute() {

        if ($this->ref_type == 'App\\Credito') {

            return Factura::where('id', $this->ref_recibo_id)->first();
        } else {
            return Factprecredito::where('id', $this->ref_recibo_id)->first();
        }

    }
}
