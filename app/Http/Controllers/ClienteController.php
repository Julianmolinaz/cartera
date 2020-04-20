<?php

namespace App\Http\Controllers;

use App\Traits\ClientesClass;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services\PayUService\Exception;
use App\Http\Requests\ClienteCreateRequest;

use App\Precredito;
use App\Municipio;
use App\Codeudor;
use App\Cliente;
use App\Conyuge;
use App\Estudio;
use Datatables;
use App\Soat;
use Auth;
use DB;

class ClienteController extends Controller
{

    use ClientesClass;

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
        return view('start.clientes.index');
    }

    public function list()
    {
        $clientes = DB::table('clientes')->select([
            'id','num_doc','nombre','movil'
        ]);

        return Datatables::of($clientes)
            ->addColumn('btn', function($cliente) {

                $route = route('start.clientes.show',$cliente->id);

                return '<a href="'.$route.'" class="btn btn-default btn-xs ver">
                              <span class="glyphicon glyphicon-eye-open"></span></a>';

            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_actividades   = getEnumValues('clientes','tipo_actividad');
        $tipos_documento    = getEnumValues('clientes','tipo_doc');
        $tipos_documentoy   = getEnumValues('conyuges','tipo_docy');
        $municipios         = Municipio::all();

        return view('start.clientes.create')
            ->with('municipios', $municipios)
            ->with('tipo_actividades',$tipo_actividades)
            ->with('tipos_documento', $tipos_documento)
            ->with('tipos_documentoy',$tipos_documentoy);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // REGLAS DE VALIDACION 

        $rules_cliente    = $this->rules_cliente('crear'); //ClientesClass
        $message_cliente  = $this->messages_cliente('crear'); //ClientesClass

        $this->validate($request,$rules_cliente,$message_cliente);
        
        DB::beginTransaction();

        try{
            // CREACION DEL CLIENTE

            $cliente = new Cliente();
            $cliente->fill($request->all());    
            $cliente->fecha_nacimiento = inv_fech($request->fecha_nacimiento);         
            $cliente->user_create_id  = Auth::user()->id;

            $cliente->save();

            //CREACION REGISTRO VENCIMIENTO SOAT

            if( $request->soat ){
                $this->createSoat($cliente, 'cliente', $request);
            }

            DB::commit();

            flash()->info('El cliente ('.$cliente->id.') '.$cliente->nombre. ' se creo con éxito!');
            return redirect()->route('start.clientes.show',$cliente->id);
        }//.try
        catch(\Exception $e){
            DB::rollback();
            flash()->error($e->getMessage());
            return redirect()->route('start.clientes.create');                    
        }

     }

    /**
     * show permite consultar la información del cliente
     * @input $id del cliente
     */

    public function show($id)
    {
        $cliente        = Cliente::find($id);

        if($cliente->codeudor && $cliente->codeudor->id == 100){
            $cliente->codeudor_id = null;
            $cliente->save();
        }

        $cliente = Cliente::find($id);

        $precreditos    = Precredito::where('cliente_id',$id)
                            ->orderBy('updated_at','desc')
                            ->get();
        $calificaciones = getEnumValues('clientes', 'calificacion');                 

        return view('start.clientes.show')
            ->with('cliente',$cliente)
            ->with('precreditos',$precreditos)
            ->with('calificaciones',$calificaciones);
    }


    public function edit($id)
    {

        $municipios         = Municipio::where('id', '!=', 100)->orderBy('departamento','asc')->get();
        $tipo_actividades   = getEnumValues('clientes','tipo_actividad');
        $cliente            = Cliente::find($id);
        $tipos_documento    = getEnumValues('clientes','tipo_doc');
        $cliente->fecha_nacimiento = inv_fech2($cliente->fecha_nacimiento);
        
        if($cliente->soat){
            $cliente->soat->vencimiento = inv_fech2($cliente->soat->vencimiento);
        }

        return view('start.clientes.edit')
            ->with('cliente',$cliente)
            ->with('municipios',$municipios)
            ->with('tipo_actividades',$tipo_actividades)
            ->with('tipos_documento',$tipos_documento);
    }



    public function update(Request $request, $id)
    {  
        $rules_cliente    = $this->rules_cliente('editar'); // ClientesClass
        $message_cliente  = $this->messages_cliente('editar'); // ClientesClass
  
        //ACTUALIZAR CLIENTE CON CODEUDOR
        $this->validate($request,$rules_cliente,$message_cliente);

        DB::beginTransaction();

        try
        {
            $cliente = Cliente::find($id); 
            $cliente->fill($request->all());

            if($cliente->isDirty()){ 
                $cliente->user_update_id = Auth::user()->id;
                $cliente->save();
            }

            if($cliente->soat && $request->soat && $request->placa){
                $soat = Soat::find($cliente->soat->id);
                $soat->fill([
                    'cliente_id' => $cliente->id,
                    'placa' => $request->placa,
                    'tipo'  => 'cliente',
                    'vencimiento' => $request->soat,
                    'user_update_id' => Auth::user()->id
                ]);
                
                if($soat->isDirty()){
                    $soat->save();
                }
            }
            elseif($cliente->soat === NULL && $request->soat && $request->placa){
                $soat = new Soat();

                $soat->fill([
                    'cliente_id' => $cliente->id,
                    'placa' => $request->placa,
                    'tipo'  => 'cliente',
                    'vencimiento' => $request->soat,
                    'user_create_id' => Auth::user()->id,
                    'user_update_id' => Auth::user()->id
                ]);

                $soat->save();
            }
            elseif($request->soat && $request->placa == NULL){
                flash()->error('Para crear el SOAT se necesita una placa');
                return redirect()->route('start.clientes.edit',$id); 
            }
            DB::commit();

            flash()->info('El cliente ('.$cliente->id.') '.$cliente->nombre. ' se editó con éxito!');
            return redirect()->route('start.clientes.show',$cliente->id);            

        }
        catch(\Exception $e)
        {
            DB::rollback();
            flash()->error($e->getMessage());
            return redirect()->route('start.clientes.edit',$id);     
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try{
            $cliente = Cliente::find($id);

            if($cliente->estudio){
                $estudio = Estudio::find($cliente->estudio->id);
                $estudio->delete();
            }

            if( $cliente->soat ){
                $soat = Soat::where('cliente_id',$cliente->id)->get();
                $soat[0]->delete();
            }
            $cliente->delete();

            DB::commit();

            flash()->success('El cliente ('.$cliente->id.') '.$cliente->nombre. ' se eliminó Exitosamente!');
            return redirect()->route('start.clientes.index');

        } catch(\Exception $e){
            DB::rollback();

            flash()->error('Ocurrio un error, no se pudo borrar el registro!');
            return redirect()->route('start.clientes.index');

        }

    }//.destroy

    public function uploadDocument($cliente_id)
    {
        $cliente = Cliente::find($cliente_id);

        return view('start.clientes.upload.create')
            ->with('cliente',$cliente);
    }
}
