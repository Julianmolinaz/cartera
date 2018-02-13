<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ClienteCreateRequest;

use App\Cliente;
use App\Municipio;
use App\Codeudor;
use App\Precredito;
use App\Estudio;
use Auth;
use App\Services\PayUService\Exception;
use DB;

class ClienteController extends Controller
{
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
            ->orderBy('clientes.updated_at')
            ->paginate(100);


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
        $municipios         = Municipio::where('id', '!=', 10)->orderBy('departamento','asc')->get();
        $tipo_actividades   = getEnumValues('clientes','tipo_actividad');
        $tipos_documento    = getEnumValues('clientes','tipo_doc');


        return view('start.clientes.create')
            ->with('municipios',$municipios)
            ->with('tipo_actividades',$tipo_actividades)
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

        // REGLAS DE VALIDACION DE LOS DATOS DEL CLIENTE


        $rules_cliente = array(
            'primer_nombre'             => 'required|max:60',
            'segundo_nombre'            => 'max:30',
            'primer_apellido'           => 'required|max:30',
            'segundo_apellido'          => 'max:30',
            'tipo_doc'                  => 'required',
            'num_doc'                   => 'required|max:15|unique:clientes',
            'fecha_nacimiento'          => 'required',
            'direccion'                 => ['required','max:100'],
            'barrio'                    => 'required',
            'municipio_id'              => 'required',
            'movil'                     => 'required|max:20',
            'ocupacion'                 => 'required',
            'tipo_actividad'            => 'required',
            'email'                     => 'max:60'
            );

        $message_cliente = array(
           'primer_nombre.required'     => 'EL primer nombre del cliente es requerido',
           'primer_nombre.max'          => 'El primer nombre del cliente excede los 60 caracteres permitidos',
           'segundo_nombre.max'         => 'El segundo nombre del cliente excede los 30 caracteres',
           'primer_apellido.required'   => 'EL primer apellido del cliente es requerido',
           'primer_apellido.max'        => 'El primer apellido del cliente excede los 30 caracteres permitidos',
           'segundo_apellido.max'       => 'El segundo apellido del cliente excede los 30 caracteres permitidos',
           'tipo_doc.required'          => 'El tipo de documento  del cliente es requerido',
           'num_doc.unique'             => 'EL número de documento del cliente ya esta en uso',
           'num_doc.max'                => 'El número de documento excede los 8 digitos permitidos',
           'num_doc.required'           => 'El número de documento del cliente es requerido',
           'fecha_nacimiento.required'  => "La fecha de nacimiento del cliente es requerida",
           'direccion.required'         => 'La dirección del cliente es requerida',
           'direccion.max'              => 'La dirección del cliente excede los 100 caracteres permitidos',
           'barrio.required'            => 'El barrio del cliente es requerido',
           'municipio_id.required'      => 'El municipio del cliente es requerido' ,
           'movil.required'             => "El celular del cliente es requrido",
           'movil.max'                  => 'El número celular del cliente excede los 20 dígitos permitidos',
           'ocupacion.required'         => 'La ocupación del cliente es requerida',
           'tipo_actividad.required'    => 'El tipo de actividad del cliente es requerida',
           'email.max'                  => 'El correo electronico del cliente excede los 60 caracteres permitidos'
            );

        // DATOS DE VALIDACION DEL CODEUDOR

        $rules_codeudor = array(
            'primer_nombrec'            => 'required|max:60',
            'segundo_nombrec'           => 'max:30',
            'primer_apellidoc'          => 'required|max:30',
            'segundo_apellidoc'          => 'max:30',
            'tipo_docc'                 => 'required',
            'num_docc'                  => 'required|max:15',
            'fecha_nacimientoc'         => 'required',
            'direccionc'                => 'required|max:100',
            'barrioc'                   => 'required',
            'municipioc_id'             => 'required',
            'movilc'                    => 'required|max:20',
            'ocupacionc'                => 'required',
            'tipo_actividadc'           => 'required',
            'emailc'                    => 'max:60'
            );

        $message_codeudor = array(
           'primer_nombrec.required'    => 'EL primer nombre del codeudor es requerido',
           'primer_nombrec.max'         => 'El primer nombre del codeudor excede los 60 caracteres permitidos',
           'segundo_nombrec.max'        => 'El segundo nombre del codeudor excede los 30 caracteres permitidos',
           'primer_apellidoc.required'  => 'El primer apellido del codeudor es requerido',
           'primer_apellidoc.max'       => 'El primer apellido del codeudor excede los 30 caracteres',
           'segundo_apellidoc.max'      => 'El segundo apellido del codeudor excede los 30 caracteres',
           'tipo_docc.required'         => 'El tipo de documento del codeudor es requerido',    
           'num_docc.required'          => 'El número de documento del codeudor es requerido',
           'num_docc.max'               => 'El número de documento del codeudor excede los 8 digitos permitidos',
           'fecha_nacimientoc.required' => 'La fecha de nacimiento del codeudor es requerida',
           'direccionc.required'        => 'La dirección del codeudor es requerida',
           'direccionc.max'             => 'La dirección del codeudor excede los 100 caracteres permitidos',
           'barrioc.required'           => 'El barrio del codeudor es requerido',
           'municipioc_id.required'     => 'El municipio del codeudor es requerido',
           'movilc.required'            => 'El número celular del codeudor es requerido',
           'movilc.max'                 => 'El número celular del codeudor excede los 20 dígitos permitidos',  
           'ocupacionc.required'        => 'La ocupación del codeudor es requerida',
           'tipo_actividadc.required'   => 'El tipo de actividad del codeudor es requerida',
           'emailc.max'                 => 'El correo electronico del codeudor excede los 60 caracteres permitidos'
            );

        // SI SE ESCOGE CODEUDOR "SI"     

        if($request->codeudor == 'si'){

            // EJECUCIÓN VALIDACIÓN CLIENTE Y CODEUDOR

            $this->validate($request,
                array_merge($rules_cliente,$rules_codeudor),
                array_merge($message_cliente,$message_codeudor));

            // $nombrec ES UNA VARIABLE DONDE SE CONCATENA LOS NOMBRES Y LOS APELLIDOS

            /**********************************************/
            
            $nombrec = $request->input('primer_nombrec');

            if($request->input('segundo_nombrec') != ""){ 
              $nombrec = $nombrec.' '.$request->input('segundo_nombrec');  
            }

            $nombrec = $nombrec.' '.$request->input('primer_apellidoc');

            if($request->input('segundo_apellidoc') != ""){
                $nombrec = $nombrec.' '.$request->input('segundo_apellidoc');
            }
            /**********************************************/

            // CREACION DEL CODEUDOR

            $codeudor                   = new Codeudor();
            $codeudor->nombrec          = strtoupper($nombrec);
            $codeudor->primer_nombrec   = trim(strtoupper($request->input('primer_nombrec')));
            $codeudor->segundo_nombrec  = trim(strtoupper($request->input('segundo_nombrec')));
            $codeudor->primer_apellidoc = trim(strtoupper($request->input('primer_apellidoc')));
            $codeudor->segundo_apellidoc= trim(strtoupper($request->input('segundo_apellidoc')));
            $codeudor->tipo_docc        = $request->input('tipo_docc');
            $codeudor->num_docc         = $request->input('num_docc');
            $codeudor->fecha_nacimientoc= $request->input('fecha_nacimientoc');
            $codeudor->direccionc       = trim($request->input('direccionc'));
            $codeudor->barrioc          = $request->input('barrioc');
            $codeudor->municipioc_id    = $request->input('municipioc_id');
            $codeudor->movilc           = $request->input('movilc');
            $codeudor->fijoc            = $request->input('fijoc');
            $codeudor->tipo_actividadc  = $request->input('tipo_actividadc');
            $codeudor->ocupacionc       = strtoupper($request->input('ocupacionc'));
            $codeudor->empresac         = strtoupper($request->input('empresac'));
            $codeudor->placac           = strtoupper($request->input('placac'));
            $codeudor->emailc           = $request->input('emailc');

            $codeudor->save();

            // $nombre ES UNA VARIABLE DONDE SE CONCATENA LOS NOMBRES Y LOS APELLIDOS DE CLIENTE

            /**********************************************/

            $nombre = $request->input('primer_nombre');

            if($request->input('segundo_nombre') != ""){ 
              $nombre = $nombre.' '.$request->input('segundo_nombre');  
            }

            $nombre = $nombre.' '.$request->input('primer_apellido');

            if($request->input('segundo_apellido') != ""){
                $nombre = $nombre.' '.$request->input('segundo_apellido');
            }
            /**********************************************/

            // CREACIÓN DE CLIENTE

            $cliente                    = new Cliente();
            $cliente->nombre            = strtoupper($nombre);
            $cliente->primer_nombre     = trim(strtoupper($request->input('primer_nombre')));
            $cliente->segundo_nombre    = trim(strtoupper($request->input('segundo_nombre')));
            $cliente->primer_apellido   = trim(strtoupper($request->input('primer_apellido')));
            $cliente->segundo_apellido  = trim(strtoupper($request->input('segundo_apellido')));
            
            $cliente->tipo_doc          = $request->input('tipo_doc');
            $cliente->num_doc           = $request->input('num_doc');
            $cliente->fecha_nacimiento  = $request->input('fecha_nacimiento');
            
            $cliente->direccion         = trim(strtoupper($request->input('direccion')));
            $cliente->barrio            = strtoupper($request->input('barrio'));
            $cliente->municipio_id      = $request->input('municipio_id');
            $cliente->movil             = $request->input('movil');
            $cliente->fijo              = $request->input('fijo');   

            $cliente->tipo_actividad    = $request->input('tipo_actividad');
            $cliente->ocupacion         = strtoupper($request->input('ocupacion'));
            $cliente->empresa           = strtoupper($request->input('empresa'));
            $cliente->placa             = strtoupper($request->input('placa'));
            $cliente->email             = $request->input('email');
            
            $cliente->codeudor_id       = $codeudor->id;

            $cliente->user_create_id= Auth::user()->id;
            $cliente->user_update_id= Auth::user()->id;
            $cliente->save();

            

            flash()->success('El cliente ('.$cliente->id.') '.$cliente->nombre.' se creo con éxito!');
            return redirect()->route('start.clientes.show',$cliente->id);

        }

        // SI SE ESCOGE CODEUDOR "NO" 

        else{

            // VALIDACION DE LOS DATOS DEL CLIENTE

            $this->validate($request,$rules_cliente,$message_cliente);

            // SE CREA UN CODEUDOR VACIO CON ID 100 TABLA CODEUDORES
        
            $codeudor  = Codeudor::find(100);
        
            // $nombre ES UNA VARIABLE DONDE SE CONCATENA LOS NOMBRES Y LOS APELLIDOS DE CLIENTE

            /**********************************************/

            $nombre = $request->input('primer_nombre');

            if($request->input('segundo_nombre') != ""){ 
              $nombre = $nombre.' '.$request->input('segundo_nombre');  
            }

            $nombre = $nombre.' '.$request->input('primer_apellido');

            if($request->input('segundo_apellido') != ""){
                $nombre = $nombre.' '.$request->input('segundo_apellido');
            }
            /**********************************************/

            // CREACION DEL CLIENTE

            $cliente                    = new Cliente();
            $cliente->nombre            = strtoupper($nombre);
            $cliente->primer_nombre     = trim(strtoupper($request->input('primer_nombre')));
            $cliente->segundo_nombre    = trim(strtoupper($request->input('segundo_nombre')));
            $cliente->primer_apellido   = trim(strtoupper($request->input('primer_apellido')));
            $cliente->segundo_apellido  = trim(strtoupper($request->input('segundo_apellido')));
            
            $cliente->tipo_doc          = $request->input('tipo_doc');
            $cliente->num_doc           = $request->input('num_doc');
            $cliente->fecha_nacimiento  = $request->input('fecha_nacimiento');
            
            $cliente->direccion         = trim(strtoupper($request->input('direccion')));
            $cliente->barrio            = strtoupper($request->input('barrio'));
            $cliente->municipio_id      = strtoupper($request->input('municipio_id'));
            $cliente->movil             = $request->input('movil');
            $cliente->fijo              = $request->input('fijo');   

            $cliente->tipo_actividad    = $request->input('tipo_actividad');
            $cliente->ocupacion         = strtoupper($request->input('ocupacion'));
            $cliente->empresa           = strtoupper($request->input('empresa'));
            $cliente->placa             = strtoupper($request->input('placa'));
            $cliente->email             = $request->input('email');
            
            $cliente->codeudor_id       = $codeudor->id;

            $cliente->user_create_id= Auth::user()->id;
            $cliente->user_update_id= Auth::user()->id;
            $cliente->save();

            flash()->success('El cliente ('.$cliente->id.') '.$cliente->nombre. ' se creo con éxito!');
            return redirect()->route('start.clientes.show',$cliente->id);
        }
     }


    public function consultar_codeudor($id){
        $codeudor = Codeudor::find($id);
        return response()->json($codeudor);
    }


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

        return view('start.clientes.edit')
            ->with('cliente',$cliente)
            ->with('municipios',$municipios)
            ->with('tipo_actividades',$tipo_actividades)
            ->with('tipos_documento',$tipos_documento)
            ->with('tipos_documentoc',$tipos_documentoc);
    }



    public function update(Request $request, $id)
    { 
        // REGLAS DE VALIDACION DE LOS DATOS CLIENTE
        // regex:/^([aA-zZñÑáéíóúÁÉÍÓÚ\s]*)$/,
        $rules_cliente = array(
            'primer_nombre'             => 'required|max:60',
            'segundo_nombre'            => 'max:30',
            'primer_apellido'           => 'required|max:30',
            'segundo_apellido'          => 'max:30',
            'tipo_doc'                  => 'required',
            'num_doc'                   => 'required|max:15|unique:clientes,'.'id',
            'fecha_nacimiento'          => 'required',
            'direccion'                 => 'required|max:100',
            'barrio'                    => 'required',
            'municipio_id'              => 'required',
            'movil'                     => 'required|max:20',
            'ocupacion'                 => 'required',
            'tipo_actividad'            => 'required',
            'email'                     => 'max:60'
            );

        $message_cliente = array(
           'primer_nombre.required'     => 'EL primer nombre del cliente es requerido',
           'primer_nombre.max'          => 'El primer nombre del cliente excede los 60 caracteres permitidos',
           'segundo_nombre.max'         => 'El segundo nombre del cliente excede los 30 caracteres permitidos',
           'primer_apellido.required'   => 'El primer apellido del cliente es requerido',
           'primer_apellido.max'        => 'El primer apellido del cliente excede los 30 caracteres permitidos',
           'segundo_apellido.max'       => 'El segundo apellido del cliente excede los 30 caracteres permitidos',
           'tipo_doc.required'          => 'El tipo de documento del cliente es requerido',
           'num_doc.unique'             => 'EL número de documento del cliente ya esta en uso',
           'num_doc.required'           => 'El número de documento del cliente es requerido',
           'num_doc.max'                => 'El número de documento del cliente excede los 8 caracteres permitidos',
           'fecha_nacimiento.required'  => "La fecha de Nacimiento del cliente es requerida",
           'direccion.required'         => 'La dirección del cliente es requerida',
           'direccion.max'              => 'La dirección del cliente excede los 100 caracteres permitidos',
           'barrio.required'            => 'El barrio del cliente es requerido',
           'municipio_id.required'      => 'El municipio del cliente es requerido' ,
           'movil.required'             => "El celular del cliente es requrido",
           'movil.max'                  => 'El número celular del cliente excede los 20 dígitos',
           'ocupacion.required'         => 'La ocupación  del cliente es requerida',
           'tipo_actividad.required'    => 'El tipo de actividad del cliente es requerida',
           'email.max'                  => 'El correo electronico del cliente excede los 60 caracteres permitidos'

            );

        // REGLAS DE VALIDACION DE LOS DATOS CODEUDOR

        $rules_codeudor = array(
            'primer_nombrec'            => 'required|max:60|regex:/^([aA-zZñÑ]*)$/',
            'segundo_nombrec'           => 'max:30|regex:/^([aA-zZñÑ]*)$/',
            'primer_apellidoc'          => 'required|max:30|regex:/^([aA-zZñÑ]*)$/',
            'segundo_apellidoc'         => 'max:30|regex:/^([aA-zZñÑ]*)$/',    
            'tipo_docc'                 => 'required',
            'num_docc'                  => 'required|max:15',
            'fecha_nacimientoc'         => 'required',
            'direccionc'                => 'required|max:100',
            'barrioc'                   => 'required',
            'municipioc_id'             => 'required',
            'movilc'                    => 'required|max:20',
            'ocupacionc'                => 'required',
            'tipo_actividadc'           => 'required',
            'emailc'                    => 'max:60'
            );
        $message_codeudor = array(
           'primer_nombrec.required'    => 'El primer nombre del codeudor es requerido',
           'primer_nombrec.max'         => 'El primer nombre del codeudor excede los 60 caracteres permitidos',
           'primer_nombrec.regex'       => 'El primer nombre no tiene el formato requerido',
           'segundo_nombrec.max'        => 'El segundo nombre del codeudor excede los 30 caracteres permitidos',
           'primer_apellidoc.required'  => 'El primer apellido del codeudor es requerido',
           'primer_apellidoc.max'       => 'El primer apellido del codeudor excede los 30 caracteres permitidos',
           'segundo_apellidoc.max'      => 'El segundo apellido del codeudor excede los 30 caracteres permitidos',
           'tipo_docc.required'         => 'El tipo de documento del codeudor es requerido',    
           'num_docc.required'          => 'El número de documento del codeudor es requerido',
           'num_docc.max'               => 'El numero de documento del codeudor excede los 8 digitos permitidos',
           'fecha_nacimientoc.required' => 'La fecha de nacimiento del codeudor es requerida',
           'direccionc.required'        => 'La dirección del codeudor es requerida',
           'direccionc.max'             => 'La dirección del codeudor excede los 100 caracteres',
           'barrioc.required'           => 'El barrio del codeudor es requerido',
           'municipioc_id.required'     => 'El municipio del codeudor es requerido',
           'movilc.required'            => 'El número celular del codeudor es requerido',
           'movilc.max'                  => 'El número celular del codeudor excede los 20 dígitos',
           'ocupacionc.required'        => 'La ocupación del codeudor es requerida',
           'tipo_actividadc.required'   => 'El tipo de actividad del codeudor es requerida',
           'emailc.max'                 => 'El correo electronico del codeudor excede los 60 caracteres permitidos'
            );

        // $nombre ES UNA VARIABLE DONDE SE CONCATENA LOS NOMBRES Y LOS APELLIDOS DE CLIENTE

        /**********************************************/

        $nombre = $request->input('primer_nombre');

        if($request->input('segundo_nombre') != ""){ 
          $nombre = $nombre.' '.$request->input('segundo_nombre');  
        }

        $nombre = $nombre.' '.$request->input('primer_apellido');

        if($request->input('segundo_apellido') != ""){
            $nombre = $nombre.' '.$request->input('segundo_apellido');
        }

        /**********************************************/


        if($request->codeudor == 'si'){
            
            $this->validate($request,
                array_merge($rules_cliente,$rules_codeudor),
                array_merge($message_cliente,$message_codeudor));

            $nombrec = $request->input('primer_nombrec');

            if($request->input('segundo_nombrec') != ""){ 
                $nombrec = $nombrec.' '.$request->input('segundo_nombrec');  
            }

            $nombrec = $nombrec.' '.$request->input('primer_apellidoc');

            if($request->input('segundo_apellidoc') != ""){
                $nombrec = $nombrec.' '.$request->input('segundo_apellidoc');
            }
            
           $cliente = Cliente::find($id);

            /* valida la existencia del codeudor
            * se recuerda que no existen codeudores nulos
            * para no generar errores se creó un codeudor vacio de id 100
            * que por defecto tiene en su campo codeudor 'no', esto para señalar que
            * logicamente el codeudor no existe. !Dudas: etereosum@gmail.com
            */

            if($cliente->codeudor->codeudor == "no"){ 
                $codeudor                   = new Codeudor();
                $codeudor->nombrec          = strtoupper($nombrec);
                $codeudor->primer_nombrec   = trim(strtoupper($request->input('primer_nombrec')));
                $codeudor->segundo_nombrec  = trim(strtoupper($request->input('segundo_nombrec')));
                $codeudor->primer_apellidoc = trim(strtoupper($request->input('primer_apellidoc')));
                $codeudor->segundo_apellidoc= trim(strtoupper($request->input('segundo_apellidoc')));
                $codeudor->tipo_docc        = $request->input('tipo_docc');
                $codeudor->num_docc         = $request->input('num_docc');
                $codeudor->fecha_nacimientoc= $request->input('fecha_nacimientoc');
                $codeudor->direccionc       = trim($request->input('direccionc'));
                $codeudor->barrioc          = $request->input('barrioc');
                $codeudor->municipioc_id    = $request->input('municipioc_id');
                $codeudor->movilc           = $request->input('movilc');
                $codeudor->fijoc            = $request->input('fijoc');
                $codeudor->tipo_actividadc  = $request->input('tipo_actividadc');
                $codeudor->ocupacionc       = strtoupper($request->input('ocupacionc'));
                $codeudor->empresac         = strtoupper($request->input('empresac'));
                $codeudor->placac           = strtoupper($request->input('placac'));
                $codeudor->emailc           = $request->input('emailc');

                $codeudor->save();

                if($codeudor->estudio != NULL){
                    $estudio = Estudio::find($codeudor->estudio->id);
                    $estudio->delete();
                }

                $cliente->nombre            = strtoupper($nombre);
                $cliente->primer_nombre     = trim(strtoupper($request->input('primer_nombre')));
                $cliente->segundo_nombre    = trim(strtoupper($request->input('segundo_nombre')));
                $cliente->primer_apellido   = trim(strtoupper($request->input('primer_apellido')));
                $cliente->segundo_apellido  = trim(strtoupper($request->input('segundo_apellido'))); 
                $cliente->tipo_doc          = $request->input('tipo_doc');
                $cliente->num_doc           = $request->input('num_doc');
                $cliente->fecha_nacimiento  = $request->input('fecha_nacimiento');                
                $cliente->direccion         = trim(strtoupper($request->input('direccion')));
                $cliente->barrio            = strtoupper($request->input('barrio'));
                $cliente->municipio_id      = strtoupper($request->input('municipio_id'));
                $cliente->movil             = $request->input('movil');
                $cliente->fijo              = $request->input('fijo');   
                $cliente->tipo_actividad    = $request->input('tipo_actividad');
                $cliente->ocupacion         = strtoupper($request->input('ocupacion'));
                $cliente->empresa           = strtoupper($request->input('empresa'));
                $cliente->placa             = strtoupper($request->input('placa'));
                $cliente->email             = $request->input('email');                
                $cliente->codeudor_id       = $codeudor->id;
                $cliente->user_update_id    = Auth::user()->id;
                $cliente->save();
            }
            elseif($cliente->codeudor->codeudor == "si"){

                $codeudor                   = Codeudor::find($cliente->codeudor_id);
                $codeudor->nombrec          = strtoupper($nombrec);
                $codeudor->primer_nombrec   = trim(strtoupper($request->input('primer_nombrec')));
                $codeudor->segundo_nombrec  = trim(strtoupper($request->input('segundo_nombrec')));
                $codeudor->primer_apellidoc = trim(strtoupper($request->input('primer_apellidoc')));
                $codeudor->segundo_apellidoc= trim(strtoupper($request->input('segundo_apellidoc')));
                $codeudor->tipo_docc        = $request->input('tipo_docc');
                $codeudor->num_docc         = $request->input('num_docc');
                $codeudor->fecha_nacimientoc= $request->input('fecha_nacimientoc');
                $codeudor->direccionc       = trim($request->input('direccionc'));
                $codeudor->barrioc          = $request->input('barrioc');
                $codeudor->municipioc_id    = $request->input('municipioc_id');
                $codeudor->movilc           = $request->input('movilc');
                $codeudor->fijoc            = $request->input('fijoc');
                $codeudor->tipo_actividadc  = $request->input('tipo_actividadc');
                $codeudor->ocupacionc       = strtoupper($request->input('ocupacionc'));
                $codeudor->empresac         = strtoupper($request->input('empresac'));
                $codeudor->placac           = strtoupper($request->input('placac'));
                $codeudor->emailc           = $request->input('emailc');
                $codeudor->save();


                $cliente->nombre            = strtoupper($nombre);
                $cliente->primer_nombre     = trim(strtoupper($request->input('primer_nombre')));
                $cliente->segundo_nombre    = trim(strtoupper($request->input('segundo_nombre')));
                $cliente->primer_apellido   = trim(strtoupper($request->input('primer_apellido')));
                $cliente->segundo_apellido  = trim(strtoupper($request->input('segundo_apellido')));
                $cliente->tipo_doc          = $request->input('tipo_doc');
                $cliente->num_doc           = $request->input('num_doc');
                $cliente->fecha_nacimiento  = $request->input('fecha_nacimiento');  
                $cliente->direccion         = trim(strtoupper($request->input('direccion')));
                $cliente->barrio            = strtoupper($request->input('barrio'));
                $cliente->municipio_id      = strtoupper($request->input('municipio_id'));
                $cliente->movil             = $request->input('movil');
                $cliente->fijo              = $request->input('fijo');   
                $cliente->tipo_actividad    = $request->input('tipo_actividad');
                $cliente->ocupacion         = strtoupper($request->input('ocupacion'));
                $cliente->empresa           = strtoupper($request->input('empresa'));
                $cliente->placa             = strtoupper($request->input('placa'));
                $cliente->email             = $request->input('email');                
                $cliente->codeudor_id       = $codeudor->id;
                $cliente->user_update_id    = Auth::user()->id;
                $cliente->save();
           }
        }
        /*si se escogió la opción: no requiere codeudor.
        * Aqui es importante recalcalcar que si existe un codeudor y ademas de esto
        * tiene un estudio hay que borrarlos porque ya se hizo la confirmación de borrado * previamente mediante jquery, desde la vista de edición (start.clientes.edit)
        */

        elseif($request->codeudor == 'no')
        { 
            $this->validate($request,$rules_cliente,$message_cliente);
             $cliente = Cliente::find($id);

           if($cliente->codeudor->codeudor == "no"){
                $cliente->nombre            = strtoupper($nombre);
                $cliente->primer_nombre     = trim(strtoupper($request->input('primer_nombre')));
                $cliente->segundo_nombre    = trim(strtoupper($request->input('segundo_nombre')));
                $cliente->primer_apellido   = trim(strtoupper($request->input('primer_apellido')));
                $cliente->segundo_apellido  = trim(strtoupper($request->input('segundo_apellido')));
                $cliente->tipo_doc          = $request->input('tipo_doc');
                $cliente->num_doc           = $request->input('num_doc');
                $cliente->fecha_nacimiento  = $request->input('fecha_nacimiento');  
                $cliente->direccion         = trim(strtoupper($request->input('direccion')));
                $cliente->barrio            = strtoupper($request->input('barrio'));
                $cliente->municipio_id      = strtoupper($request->input('municipio_id'));
                $cliente->movil             = $request->input('movil');
                $cliente->fijo              = $request->input('fijo');   
                $cliente->tipo_actividad    = $request->input('tipo_actividad');
                $cliente->ocupacion         = strtoupper($request->input('ocupacion'));
                $cliente->empresa           = strtoupper($request->input('empresa'));
                $cliente->placa             = strtoupper($request->input('placa'));
                $cliente->email             = $request->input('email');                
                $cliente->codeudor_id       = 100;
                $cliente->user_update_id    = Auth::user()->id;
                $cliente->save();
           }
           elseif($cliente->codeudor->codeudor == "si"){


            if($cliente->codeudor->estudio != null){

                $exestudio = Estudio::find($cliente->codeudor->estudio->id);
                $exestudio->delete();
            }

            //se crea un codeudor con id '100' que es un codeudor vacio por defecto
            $codeudor = Codeudor::find(100);
            $codeudor->save();

            $cliente->nombre            = strtoupper($nombre);
            $cliente->primer_nombre     = trim(strtoupper($request->input('primer_nombre')));
            $cliente->segundo_nombre    = trim(strtoupper($request->input('segundo_nombre')));
            $cliente->primer_apellido   = trim(strtoupper($request->input('primer_apellido')));
            $cliente->segundo_apellido  = trim(strtoupper($request->input('segundo_apellido')));
            $cliente->tipo_doc          = $request->input('tipo_doc');
            $cliente->num_doc           = $request->input('num_doc');
            $cliente->fecha_nacimiento  = $request->input('fecha_nacimiento');  
            $cliente->direccion         = trim(strtoupper($request->input('direccion')));
            $cliente->barrio            = strtoupper($request->input('barrio'));
            $cliente->municipio_id      = strtoupper($request->input('municipio_id'));
            $cliente->movil             = $request->input('movil');
            $cliente->fijo              = $request->input('fijo');   
            $cliente->tipo_actividad    = $request->input('tipo_actividad');
            $cliente->ocupacion         = strtoupper($request->input('ocupacion'));
            $cliente->empresa           = strtoupper($request->input('empresa'));
            $cliente->placa             = strtoupper($request->input('placa'));
            $cliente->email             = $request->input('email');                
            $cliente->codeudor_id       = $codeudor->id;
            $cliente->user_update_id    = Auth::user()->id;
            $cliente->save();

            //se elimina el codeudor existente

            $excodeudor = Codeudor::find($cliente->codeudor->id);
            $excodeudor->delete();
           }
        }


        flash()->success('El cliente ('.$cliente->id.') '.$cliente->nombre. ' se editó con éxito!');
        return redirect()->route('start.clientes.show',$cliente->id);


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
            $cliente->delete();

            DB::commit();

            flash()->success('El cliente ('.$cliente->id.') '.$cliente->nombre. ' se eliminó Exitosamente!');
            return redirect()->route('start.clientes.index');

        } catch(\Exception $e){
            DB::rollback();

            flash()->error('Ocurrio un error, no se pudo borrar el registro!');
            return redirect()->route('start.clientes.index');

        }

    }


}
