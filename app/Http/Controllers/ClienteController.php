<?php

namespace App\Http\Controllers;

use App\Traits\ClientesClass;
use App\Traits\CastClienteTrait;
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
use Validator;
use App\Soat;
use App as _;
use Auth;
use DB;

class ClienteController extends Controller
{
    use ClientesClass;
    use CastClienteTrait;

    public $cliente;

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
     * $tipo = cliente, codeudor
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tipo, $cliente_id = false)
    {
        return view('start.clientes.create')
            ->with('municipios',Municipio::all())
            ->with('data',$this->getData())
            ->with('estado','creacion')
            ->with('cliente',[])
            ->with('cliente_id',$cliente_id)
            ->with('tipo',$tipo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store()

    public function store(Request $request)   
    {
        \Log::info($request->all());

        // $request = (object)array (
        //     'cliente' => 
        //     array (
        //       'id' => '',
        //       'tipo' => 'codeudor',
        //       'info_personal' => 
        //       array (
        //         'primer_nombre' => 'pablo',
        //         'segundo_nombre' => 'adrian',
        //         'primer_apellido' => 'gonzalez',
        //         'segundo_apellido' => 'salazar',
        //         'tipo_doc' => 'Cedula Ciudadanía',
        //         'num_doc' => '9875654444',
        //         'fecha_nacimiento' => '1999-01-01',
        //         'lugar_exp' => 'pereira',
        //         'fecha_exp' => '2000-01-01',
        //         'lugar_nacimiento' => 'pereira',
        //         'nivel_estudios' => 'Bachiller',
        //         'estado_civil' => 'Casado/a',
        //       ),
        //       'info_ubicacion' => 
        //       array (
        //         'direccion' => 'dir 12',
        //         'barrio' => 'centro',
        //         'municipio_id' => 1,
        //         'movil' => '1234586444',
        //         'fijo' => '454654654',
        //         'email' => 'mail@mail.com',
        //         'estrato' => '3',
        //         'anos_residencia' => '3',
        //         'meses_residencia' => '2',
        //         'tipo_vivienda' => 'Propia',
        //         'envio_correspondencia' => 'Casa',
        //         'nombre_arrendador' => '',
        //         'telefono_arrendador' => '',
        //       ),
        //       'info_economica' => 
        //       array (
        //         'oficio' => 'Asalariado',
        //         'tipo_actividad' => 'Dependiente',
        //         'empresa' => 'Free',
        //         'tel_empresa' => '321212454',
        //         'dir_empresa' => 'dir 123',
        //         'doc_empresa' => '213215445',
        //         'cargo' => 'new',
        //         'tipo_contrato' => 'Idefinido',
        //         'fecha_vinculacion' => '2000-01-01',
        //         'descripcion_actividad' => '',
        //       ),
        //       'conyuge' => '',
        //       'calificacion' => '',
        //       'cdeudor' => '',
        //     ),
        //     'cliente_id' => '13536',
        // );
          
        $rq = [];

        $cliente = (object) $request->cliente;
        $cliente_id = $request->cliente_id;

        if ( is_array($cliente->info_personal  ) ) { $rq = array_merge($rq, $cliente->info_personal);  } 
        if ( is_array($cliente->info_ubicacion ) ) { $rq = array_merge($rq, $cliente->info_ubicacion); } 
        if ( is_array($cliente->info_economica ) ) { $rq = array_merge($rq, $cliente->info_economica); } 

        $validator = Validator::make($rq, $this->rules_cliente('crear'),$this->messages_cliente());

        if ($validator->fails()) {
            return res( true,$validator->errors(),'');
        }

        DB::beginTransaction();

        try {
            // puede ser deudor o cdeudor

            $cliente = new Cliente();
            $cliente->tipo = $request->cliente['tipo'];
            $cliente->fill($rq);
            $cliente->version = 2;
            $cliente->user_create_id = Auth::user()->id;            
            $cliente->save();

            \Log::info('***************************************');
            \Log::info($cliente_id);
            \Log::info($cliente->tipo);


            if ($request->cliente['tipo'] == 'codeudor') {
                $cliente_deudor = Cliente::find($cliente_id);

                \Log::error('////////////////////////////');
                \Log::error($cliente->id);
                
                $cliente_deudor->cdeudor_id = $cliente->id;
                \Log::info($cliente_deudor);
                $cliente_deudor->save();
            }
            
            DB::commit();

            return res(true, $cliente, 'El cliente se creó exitosamente !!!');

        } catch (\Exception $e) {

            // \Log::error($e);
            DB::rollback();
            return res(false,'',$e->getMessage());
        }
        
    }//.store

    /**
     * show permite consultar la información del cliente
     * @input $id del cliente
     */

    public function show($id)
    {
        $cliente = Cliente::find($id);

        if(isset($cliente->codeudor) && $cliente->codeudor->id == 100){
            $cliente->codeudor_id = null;
            $cliente->save();
        }

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
        $this->cliente            = Cliente::find($id);
        
        if($this->cliente->soat){
            $this->cliente->soat->vencimiento = inv_fech2($this->cliente->soat->vencimiento);
        }
        
        if ($this->cliente->version == 1) {
            
            $tipos_documento    = getEnumValues('clientes','tipo_doc');
            $this->cliente->fecha_nacimiento = inv_fech2($this->cliente->fecha_nacimiento);
            $tipo_actividades   = getEnumValues('clientes','tipo_actividad');

            return view('start.clientes.edit')
                ->with('cliente',$this->cliente)
                ->with('municipios',$municipios)
                ->with('tipo_actividades',$tipo_actividades)
                ->with('tipos_documento',$tipos_documento);
        } 
        else if ($this->cliente->version == 2) {

            $cliente = $this->cast_cliente();

            return view('start.clientes.create')
                ->with('cliente',$cliente)
                ->with('municipios',$municipios)
                ->with('data',$this->getData())
                ->with('estado','edicion');
        }
        
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

    public function updateV2(Request $request)
    {
        $rq = [];   
        
        if ( is_array($request->info_personal  ) ) { $rq = array_merge($rq, $request->info_personal);  } 
        if ( is_array($request->info_ubicacion ) ) { $rq = array_merge($rq, $request->info_ubicacion); } 
        if ( is_array($request->info_economica ) ) { $rq = array_merge($rq, $request->info_economica); } 
        
        \Log::info($rq);
        
        
        $validator = Validator::make($rq, $this->rules_cliente('editar'),$this->messages_cliente());
        
        if ($validator->fails()) {

            return res( false,$validator->errors(),'');
        }

        DB::beginTransaction();

        try {

            $cliente = Cliente::find($request->id);
            $cliente->fill($rq);
            $cliente->user_update_id = Auth::user()->id;
            $cliente->save();
    
            DB::commit();
            return res(true, $cliente, 'El cliente se editó exitosamente !!!');

        } catch (\Exception $e) {
            DB::rollback();
            return res(false,'',$e->getMessage());
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


    public function validate_document(Request $request) 
    {
        $cliente = Cliente::where('tipo_doc', $request->tipo_doc)
            ->where('num_doc', $request->num_doc)
            ->count();

        if ($cliente > 0) {

            return res(true,true,'Ya existe un cliente con este número de documento');
        } else {

            return res(true,false,'');
        }
    }


    public function getData()
    {
        return [  
            'tipo_doc'              => getEnumValues('clientes','tipo_doc'),    
            'estado_civil'          => getEnumValues('clientes','estado_civil'),
            'nivel_estudios'        => getEnumValues('clientes','nivel_estudios'),
            'envio_correspondencia' => getEnumValues('clientes','envio_correspondencia'),
            'estrato'               => getEnumValues('clientes','estrato'),
            'tipo_vivienda'         => getEnumValues('clientes','tipo_vivienda'),
            'tipo_actividad'        => getEnumValues('clientes','tipo_actividad'),
            'oficios'               => \App\Oficio::orderBy('nombre')->get(),
            'tipo_contrato'         => getEnumValues('clientes','tipo_contrato'),
            'calificacion'          => getEnumValues('clientes','calificacion')
        ];
    }

}
