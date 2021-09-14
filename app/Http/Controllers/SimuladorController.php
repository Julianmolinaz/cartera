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
                case 1:
                    $factor = 1.10006;
                    break; 
                case 2:
                    $factor = 1.20016;
                    break;
                case 3:
                    $factor = 1.3002;
                    break;
                case 4:
                    $factor = 1.40008;
                    break;
                case 5:
                    $factor = 1.4004;
                    break;
                case 6:
                    $factor = 1.50036;
                    break;
                case 7:
                    $factor = 1.49996;
                    break;   
                case 8:
                    $factor = 1.5; 
                    break;
                case 10:
                    $factor = 1.5; 
                    break;
                default:
                    $factor = 0;
                    break;
            }
            if($request->input('periodo') == 'Quincenal'){
                $quincenas = $meses * 2;
		        $resultado = $monto * $factor / $quincenas;
            }
            else {
                $resultado = $monto * $factor / $meses;
            }

            return response()->json($resultado);
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
