<?php 

namespace App\Traits;

trait IngresoEsperadoTrait
{
    public function ingresoNominalTr($ini, $fin) 
    {
        
        // cargar creditos con fecha de pago menor o igual a la fecha final
        
        $creditos = $this->creditosIngresoEsperadoTr($ini, $fin);

        //calcular sumatoria cuotas por pagar

        $this->calcularIngresoNominalTr($ini, $fin, $creditos);

    }

    public function creditosIngresoEsperadoTr($ini, $fin)
    {
        $ids =  \DB::table('creditos')
            ->join('fecha_cobros', function ($join) use ($fin){
                $join->on('creditos.id','=','fecha_cobros.credito_id')
                ->where('fecha_cobros.fecha_pago','<=', $fin->format('Y-m-d'));
            })
            ->join('precreditos','creditos.precredito_id','=','precreditos.id')
            ->select('creditos.id as id')
            ->whereNotIn('estado',['Cancelado','Cancelado por refinanciacion'])
            ->where('castigada', 'No')
            ->get();
        
        $collection = collect($ids);
        $plucked = $collection->pluck('id');
        $creditos = \App\Credito::find($plucked->all());
        
        return $creditos;
    }

    public function calcularIngresoNominalTr($ini, $fin, $creditos)
    {
        dd($creditos[0]->facturas->last());
    }
}