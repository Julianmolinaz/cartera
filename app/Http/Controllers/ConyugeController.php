<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Traits\ConyugeTrait;
use App\Http\Requests;
use App\Codeudor;
use App\Cliente;
use App\Conyuge;
use Validator;
use Auth;
use DB;

class ConyugeController extends Controller
{
    use ConyugeTrait;

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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($cliente_id, $tipo)
    {
        $obj = Cliente::find($cliente_id);

        if(strtolower($tipo) == 'codeudor'){
            $obj = Codeudor::find($obj->codeudor_id);
        }
        $tipos_documento = getEnumValues('conyuges', 'tipo_docy');

        return view('start.conyuges.create')
            ->with('tipo',$tipo)
            ->with('obj',$obj)
            ->with('tipos_documento',$tipos_documento);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->conyuge,$this::rulesConyugeTr('create'),$this::messagesConyugeTr());

        if ($validator->fails()) {
            return res(true, $validator->errors(),'');
        }

        DB::beginTransaction();

        try
        {
            if ( isset($request->conyuge['id']) ) {
                $conyuge = Conyuge::find($request->conyuge['id']);
                $conyuge->fill($request->conyuge);
                $conyuge->save();
            } else {
                $conyuge = new Conyuge();
                $conyuge->fill($request->conyuge);
                $conyuge->save();

                $cliente = Cliente::find($request->cliente_id);
                $cliente->conyuge_id = $conyuge->id;
                $cliente->user_update_id = Auth::user()->id;
                $cliente->save();
            }



            DB::commit();
            return res(true,'','Conyuge creado exitosamente !!!');
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return res(false,'','Error: '.$e->getMessage());
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
    public function edit($id,$tipo)
    {
        if(strtolower($tipo) == 'cliente'){
            $obj = Cliente::find($id);
        }
        else{
            $obj = Codeudor::find($id);
        }
        $tipos_documento = getEnumValues('conyuges', 'tipo_docy');

        return view('start.conyuges.edit')
            ->with('obj',$obj)
            ->with('tipo',$tipo)
            ->with('tipos_documento',$tipos_documento);
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
        $this->validate($request,[
            'p_nombrey'     => 'required|alpha',
            'p_apellidoy'   => 'required|alpha',
            'tipo_docy'     => 'required',
            'num_docy'      => 'required|unique|numeric',
            'movily'        => 'required',
            'diry'          => 'required'
        ],[
            'p_nombrey.required'     => 'El primer nombre del conyuge es requerido',
            'p_apellidoy.required'   => 'El primer apellido del conyuge es requerido',
            'num_docy.required'      => 'El tipo de documento del conyuge es requerido',
            'num_docy.required'      => 'El numero de documento del conyuge es requerido',
            'movily.required'        => 'El celular del conyuge es requerido',
            'diry.required'          => 'La dirección del conyuge es requerida'
        ]);

        DB::beginTransaction();
        try
        {
            $conyuge = Conyuge::find($request->conyuge_id);
            $conyuge->fill($request->all());
            if(!$conyuge->isDirty()){
                flash()->info('Ningun cambio en registro');
                return redirect()->route('start.conyuges.edit',[$request->obj_id, $request->tipo]);
            }
            $conyuge->save();

            if($request->tipo == 'cliente'){
                $cliente = Cliente::find($request->obj_id);
                $cliente->conyuge_id = $conyuge->id;
                $cliente->user_update_id = Auth::user()->id;
                $cliente->save();
            }

            DB::commit();
            flash()->success('El conyuge se editó con éxito');
            return redirect()->route('start.clientes.show',$request->obj_id);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            flash()->error('error ' . $e->getMessage());
            if($request->tipo == 'cliente'){
                return redirect()->route('start.conyuges.edit',[$request->obj_id,$tipo]);
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($obj_id, $tipo)
    {
        DB::beginTransaction();
        try
        {
            $cliente = Cliente::find($obj_id);
            $id = $cliente->id;

            if($tipo === 'cliente')
            {
                $conyuge = Conyuge::find($cliente->conyuge_id);
                $cliente->conyuge_id = NULL;
                $cliente->save();
                $conyuge->delete();
            }
            else{
                $codeudor = Codeudor::find($cliente->codeudor_id);
                $conyuge = Conyuge::find($codeudor->conyuge_id);
                $codeudor->conyuge_id = NULL;
                $codeudor->save();
                $conyuge->delete();      
            }

            DB::commit();
            flash()->success('Se eliminó el conyuge');
            return redirect()->route('start.clientes.show',$obj_id);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            flash()->error('Error '. $e->getMessage());
            return redirect()->route('start.clientes.show', $obj_id);
        }
    }
}
