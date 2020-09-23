<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\PagoMasivo; 
use Carbon\Carbon;
use Validator;
use Excel;
use File;
use DB;


class PagoMasivoController extends Controller
{
    public $report;
    public $data;
    public $arr_error = [];

    public function index() {
        return view('admin.masivos.index')
            ->with('err', []);
    }

    public function store(Request $request) 
    {
        // dd($request->archivo);

        $this->validate($request, ['archivo'=>'required']);

        if ($request->hasFile('archivo'))
        {
            $extension = File::extension($request->archivo->getClientOriginalName());

            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv")
            {
                $path = $request->archivo->getRealPath();

                $this->data = collect(Excel::load($path, function($reader){})->get());

                $this->validate_heading();

                if ($this->arr_error) {
                    return view('admin.masivos.index')
                        ->with('err', $this->arr_error);
                }

                $this->validation();

                $this->validate_banco();

                // dd($this->arr_error);

            } 
            else {
                $this->arr_error = ['Formato no soportado'];
            }

            return view('admin.masivos.index')
                ->with('err', $this->arr_error);
        }


    }

    public function validate_heading() 
    {
        $keys = $this->data[0]->keys();

        if ($keys->all()[0] != 'fecha' ) {
            $this->arr_error[] =  [
                'line'      => 1,
                'message'   => 'La primera columna debe llamarse fecha'
            ];
        }
        if ($keys->all()[1] != 'documento') {
            $this->arr_error[] =  [
                'line'      => 1,
                'message'   => 'La segunda columna debe llamarse documento'
            ];
        }
        if ($keys->all()[2] != 'referencia') {
            $this->arr_error[] = [
                'line'      => 1,
                'message'   => 'La tercer columna debe llamarse referencia'
            ]; 
        }
        if ($keys->all()[3] != 'monto') {
            $this->arr_error[] = [
                'line'      => 1,
                'message'   =>  'La cuarta columna debe llamarse monto'
            ]; 
        }
        if ($keys->all()[4] != 'entidad') {
            $this->arr_error[] = [
                'line'      => 1,
                'message'   => 'La quinta columna debe llamarse entidad'
            ]; 
        }
    }


    public function validation()
    {

        $count = 1;

        foreach ($this->data as $item) 
        {
            $count ++;

            // dd($item->toArray());

            $validation = Validator::make($item->toArray(), [
                'documento'     => 'required|integer|min:1',
                'referencia'    => 'required|alpha_num',
                'monto'         => 'required|integer|min:1',
                'entidad'       => 'required'
            ],[
                'documento.required'    => 'El campo documento en la linea '.$count.' es requerido',
                'documento.integer'     => 'El campo documento en la linea '.$count.' debe ser un entero',
                'documento.min'         => 'El campo documento en la linea '.$count.' debe ser mayor 0',
                'referencia.required'   => 'El campo referencia en la linea '.$count.' es requerido',     
                'referencia.alpha_num'  => 'El campo referencia en la linea '.$count.' debe contener números y/o letras',
                'monto.required'        => 'El campo monto en la linea '.$count.' es requerido',
                'monto.integer'         => 'El campo monto en la linea '.$count.' debe ser un entero',
                'monto.min'             => 'El campo monto en la linea '.$count.' debe ser mayor 0',
                'entidad.required'      => 'El campo entidad en la linea '.$count.' es requerido'
            ]);

            if ($validation->fails()) {

                foreach ($validation->errors()->toArray() as $err) {
                    $this->arr_error[] = [
                        'line'   => $count,
                        'message' => $err[0]
                    ];
                }
            }   
        }    
    }

    public function validate_banco()
    {
        $count = 1;

        $bancos = DB::table('bancos')->get();

        foreach ($this->data as $item)
        {
            $count ++;

            $flag = false;

            foreach ($bancos as $banco)
            {
                if (strtolower($banco->nombre) == strtolower($item->entidad)) $flag = true; 
            }

            if (!$flag) $this->arr_error[] = [
                'line' => $count,
                'message' => 'EL nombre de la entidad en la linea '.$count.' no coincide con nuestros registros'
            ];
        }

    }

}


