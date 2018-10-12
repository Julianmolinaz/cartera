<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Egreso;
use Auth;
use DB;

class DatatableController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function egresos(Datatables $datatables)
    {
        
        if(!middleware(array('Administrador'))){
            return false;
        }

       $query = Egreso::with('user_create')->with('cartera')->orderBy('updated_at','desc');

    	return DataTables::of($query)
        ->addColumn('btn','
             <a href="{{route(\'admin.egresos.edit\',$id)}}" class = \'btn btn-default btn-xs\'><span class="glyphicon glyphicon-pencil"  title="ver"></span></a>
              <a href="{{route(\'admin.egresos.destroy\',$id)}}" onclick="return confirm(\'¿Esta seguro de eliminar el registro de egreso?\')" class = \'btn btn-default btn-xs\'><span class = "glyphicon glyphicon-trash" title="Eliminar"></span></a> ')
    	->make(true);
    }
}
