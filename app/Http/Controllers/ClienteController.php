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
use App\Soat;
use Auth;
use DB;

class ClienteController extends Controller
{

    use ClientesClass;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {         
 
        $clientes_qwery = 
        DB::table('clientes')
            ->join('codeudores','clientes.codeudor_id','=','codeudores.id')
            ->join('users','clientes.user_create_id','=','users.id')
            ->select('clientes.id as id',
                     'clientes.nombre as nombre',
                     'clientes.num_doc as num_doc',
                     'clientes.fecha_nacimiento as fecha_nacimiento',
                     'clientes.movil as movil',
                     'clientes.fijo as fijo',
                     'codeudores.nombrec as codeudor',
                     'codeudores.movilc as movilc',
                     'codeudores.fijoc as fijoc',
                     'users.name as user_create',
                     'clientes.created_at as created_at',
                     'clientes.updated_at as updated_at')
            ->orderBy('clientes.updated_at','desc')
            ->paginate(50);


        return view('start.clientes.index')
            ->with('clientes',$clientes_qwery);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipios         = Municipio::where('id', '!=', 100)->orderBy('departamento','asc')->get();
        $tipo_actividades   = getEnumValues('clientes','tipo_actividad');
        $tipos_documento    = getEnumValues('clientes','tipo_doc');
        $tipos_documentoy   = getEnumValues('conyuges','tipo_docy');


        return view('start.clientes.create')
            ->with('municipios',$municipios)
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

        $rules_cliente    = $this->rules_cliente('crear');
        $message_cliente  = $this->messages_cliente('crear');
        $rules_codeudor   = $this->rules_codeudor('crear');
        $message_codeudor = $this->messages_codeudor('codeudor');

        // SI SE ESCOGE CODEUDOR "SI"     

        if($request->codeudor == 'si'){

            // EJECUCIÓN VALIDACIÓN CLIENTE Y CODEUDOR
            $this->validate($request,
                array_merge($rules_cliente,$rules_codeudor),
                array_merge($message_cliente,$message_codeudor));

            return $this->crearClienteConCodeudor($request);


        }//.if
        // SI SE ESCOGE CODEUDOR "NO" 
        else
        {
            // VALIDACION DE LOS DATOS DEL CLIENTE

            $this->validate($request,$rules_cliente,$message_cliente);
            return $this->crearClienteSinCodeudor($request);
        }//.else
     }

    /**
     * show permite consultar la información del cliente
     * @input $id del cliente
     */

    public function show($id)
    {
        $cliente        = Cliente::find($id);

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
        $tipos_documentoc   = getEnumValues('codeudores','tipo_docc');
        $tipos_documentoy   = getEnumValues('conyuges','tipo_docy');

        return view('start.clientes.edit')
            ->with('cliente',$cliente)
            ->with('municipios',$municipios)
            ->with('tipo_actividades',$tipo_actividades)
            ->with('tipos_documento',$tipos_documento)
            ->with('tipos_documentoc',$tipos_documentoc)
            ->with('tipos_documentoy',$tipos_documentoy);
    }



    public function update(Request $request, $id)
    {  

        $rules_cliente    = $this->rules_cliente('editar');
        $message_cliente  = $this->messages_cliente('editar');
        $rules_codeudor   = $this->rules_codeudor('editar');
        $message_codeudor = $this->messages_codeudor('editar');

        //ACTUALIZAR CLIENTE CON CODEUDOR

        if($request->codeudor == 'si')
        {
            
            $this->validate($request,array_merge($rules_cliente,$rules_codeudor),
                                     array_merge($message_cliente,$message_codeudor));
            return $this->actualizarClienteConCodeudor($request,$id);

        }//.f($request->codeudor == 'si')
            
        //ACTUALIZAR UN CLIENTE SIN CODEUDOR

        elseif($request->codeudor == 'no')
        { 
            $this->validate($request,$rules_cliente,$message_cliente);
            return $this->actualizarClienteSinCodeudor($request, $id);

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
}
