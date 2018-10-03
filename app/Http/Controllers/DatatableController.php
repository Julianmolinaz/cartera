<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class DatatableController extends Controller
{
    public function egresos(Datatables $datatables)
    {
    	$query = DB::table('egresos')
    		->join('users','egresos.user_create_id','=','users.id')
    		->join('carteras','egresos.cartera_id','=','carteras.id')
    		->select('egresos.id as id',
    			     'egresos.comprobante_egreso as comprobante_egreso',
    			     'egresos.concepto as concepto',
    			     'egresos.fecha as fecha',
    			     'egresos.valor as valor',
    			     'egresos.observaciones as observaciones',
    			     'users.name as creo as creo',
    			     'carteras.nombre as cartera'
    	              );

    	return DataTables::of($query)
    	->make(true);

    }
}
