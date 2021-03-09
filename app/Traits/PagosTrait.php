<?php 

namespace App\Traits;
use Carbon\Carbon;
use App\Credito;
use App\Pago;
use Auth;
use DB;


trait PagosTrait
{
    public function totalPagosTr($credito)
    {
        return DB::table('pagos')
                ->where('credito_id',$credito->id)
                ->sum('abono');
    }
}