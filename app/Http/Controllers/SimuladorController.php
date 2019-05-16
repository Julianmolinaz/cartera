<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Variable;

class SimuladorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variables = Variable::find(1);

        return view('start.simulador.index')
            ->with('variables',$variables);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            $monto = $request->input('monto');
            $meses = $request->input('meses');
            switch ($meses) {
                case 2:
                    $interes = 1.2;
                    break;
                case 3:
                    $interes = 1.3;
                    break;
                case 4:
                    $interes = 1.4;
                    break;
                case 5:
                    $interes = 1.5;
                    break;
                case 6:
                    $interes = 1.5;
                    break;
                case 7:
                    $interes = 1.55;
                    break;    
                case 8:
                    $interes = 1.6;
                    break; 
                case 9:
                    $interes = 1.65;
                    break;
                case 10:
                    $interes = 1.7;
                    break;
                case 12:
                    $interes = 2;
                    break;       

                default:
                    $interes = 0;
                    break;
            }
            if($request->input('periodo') == 'Quincenal'){
                $meses = $meses * 2;
            }


            $resultado = $monto * $interes / $meses;
 

            echo json_encode($resultado);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
