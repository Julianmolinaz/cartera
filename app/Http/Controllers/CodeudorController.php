<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ClientesClass;
use App\Traits\CastCodeudorTrait;
use App\Traits\CodeudorTrait;
use App\Http\Requests;
use App\Precredito;
use Carbon\Carbon;
use App\Municipio;
use App\Codeudor;
use App\Cliente;
use App\Conyuge;
use App\Estudio;
use Validator;
use App\Soat;
use Auth;
use DB;

class CodeudorController extends Controller
{
    use ClientesClass;
    use CodeudorTrait;
    use CastCodeudorTrait;

    public $codeudor;

    public function __construct()
    {
        // $this->middleware('auth');
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
    public function create($cliente_id)
    {
        $municipios = Municipio::where('id', '!=', 100)->orderBy('departamento','asc')->get();

        return view('start.clientes.create')
            ->with('municipios',Municipio::where('id', '!=', 100)->orderBy('departamento','asc')->get())
            ->with('data',$this->getData())
            ->with('estado','creacion')
            ->with('cliente',[])
            ->with('cliente_id',$cliente_id)
            ->with('tipo','codeudor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD

=======
>>>>>>> 0443c3877cd36bb397b79614d215938e000a988c
        $rq      = [];
        $codeudor = (object) $request->cliente;


        if ( is_array($codeudor->info_personal  ) ) { $rq = array_merge($rq, $codeudor->info_personal);  } 
        if ( is_array($codeudor->info_ubicacion ) ) { $rq = array_merge($rq, $codeudor->info_ubicacion); } 
        if ( is_array($codeudor->info_economica ) ) { $rq = array_merge($rq, $codeudor->info_economica); } 
 
        $validator = Validator::make( $rq, $this->rulesCodeudorTr(), $this->messagesCodeudorTr());

        if ($validator->fails()) return res('false',$validator->errors(),'Error en la validación.');

        DB::beginTransaction();

        try{
            $codeudor = new Codeudor();
            $codeudor->fill($rq);   
            $codeudor->version = 2; 
            $codeudor->created_at = Auth::user()->id;     
            $codeudor->save();


            \DB::table('clientes')->where('id',$request->cliente_id)->update([ 'codeudor_id' => $codeudor->id ]);

            DB::commit();

            $data = [ 
                'ref_cliente' => $codeudor->client->id,
                'cliente_id'  => $codeudor->id
            ];

            return res(true,$data,'Codeudor creado exitosamente !!!');
        }
        catch(\Exception $e){
<<<<<<< HEAD
            \Log::info($e);
	    DB::rollback();
=======

            \Log::error($e);
            DB::rollback();
>>>>>>> 0443c3877cd36bb397b79614d215938e000a988c
            return  res(false, '', $e->getMessage());
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
        $cliente = Cliente::find($id);
        $municipios = Municipio::where('id', '!=', 100)->orderBy('departamento','asc')->get();

        if ($cliente->codeudor->version == 1) {

            $tipo_actividadesc  = getEnumValues('codeudores','tipo_actividadc');
            $tipos_documentoc   = getEnumValues('codeudores','tipo_docc');
            $cliente->codeudor->fecha_nacimientoc = inv_fech2($cliente->codeudor->fecha_nacimientoc);
    
            if($cliente->codeudor->soat){
                $cliente->codeudor->soat->vencimiento = inv_fech2($cliente->codeudor->soat->vencimiento); 
            }
    
            return view('start.codeudores.edit')
                ->with('cliente',$cliente)
                ->with('municipios',$municipios)
                ->with('tipo_actividadesc',$tipo_actividadesc)
                ->with('tipos_documentoc',$tipos_documentoc);

        } else if ($cliente->codeudor->version == 2) {

            $this->codeudor = $cliente->codeudor;
            
            return view('start.clientes.create')
                ->with('cliente_id', $cliente->id)
                ->with('tipo','codeudor')
                ->with('cliente',$this->cast_codeudor())
                ->with('municipios',$municipios)
                ->with('data',$this->getData())
                ->with('estado','edicion');

        }


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
        // REGLAS DE VALIDACION 
        $rules_codeudor    = $this->rules_codeudor('editar');
        $message_codeudor  = $this->messages_codeudor('editar');

        $this->validate($request,$rules_codeudor,$message_codeudor);

        try{
            // CREACION DEL CLIENTE

            $codeudor = Codeudor::find($request->id);
            $codeudor->fill($request->all());    
            if($codeudor->isDirty()){
                $codeudor->save();
            }
            elseif($request->soatc && $request->placac == NULL){
                flash()->error('Para crear el SOAT se necesita una placa');
                return redirect()->route('start.codeudores.edit',$id); 
            }   
            else{
                flash()->info('Ningun cambio en registro');
                return redirect()->route('start.codeudores.edit', $request->cliente_id);   
            }

            //CREACION REGISTRO VENCIMIENTO SOAT

            if( $request->soatc ){
                $this->updateSoat($codeudor, 'codeudor', $request);
            }

            DB::commit();

            flash()->info('El codeudor ('.$codeudor->id.') '.$codeudor->nombrec. ' se editó con éxito!');
            return redirect()->route('start.clientes.show',$request->cliente_id);
        }//.try
        catch(\Exception $e){
            DB::rollback();
            flash()->error('Error '.$e->getMessage());
            return redirect()->route('start.codeudores.edit', $request->cliente_id);                    
        }
    }


    public function updateV2(Request $request, $cliente_id)
    {        
        $rq = [];

        if ( is_array($request->info_personal  ) ) { $rq = array_merge($rq, $request->info_personal);  } 
        if ( is_array($request->info_ubicacion ) ) { $rq = array_merge($rq, $request->info_ubicacion); } 
        if ( is_array($request->info_economica ) ) { $rq = array_merge($rq, $request->info_economica); }   
        

        $validator = Validator::make( $rq, $this->rulesCodeudorTr(), $this->messagesCodeudorTr());

        if ($validator->fails()) return res('true',$validator->errors(),'Error en la validación.');

        DB::beginTransaction();

        try{
            $codeudor = Codeudor::find($request->id);
            $codeudor->fill($rq);   
            $codeudor->updated_at = Auth::user() ? Auth::user()->id : 1;     
            $codeudor->save();

            \DB::table('clientes')->where('id',$cliente_id)->update([ 'codeudor_id' => $codeudor->id ]);

            DB::commit();

            return res(true,$codeudor->client->id,'Codeudor creado exitosamente !!!');
        }
        catch(\Exception $e){
            DB::rollback();
            return  res(false, '', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cliente_id)
    {
        DB::beginTransaction();

        try
        {
            $cliente = Cliente::find($cliente_id);
            $id = $cliente->codeudor_id;
            $codeudor = Codeudor::find($cliente->codeudor_id);
            $cliente->codeudor_id = null;
            $cliente->save();

            if($codeudor->estudio){
                $estudio = Estudio::find($codeudor->estudio->id);
                $estudio->delete();
            }

            if($codeudor->soat){
                $soat = Soat::find($codeudor->soat->id);
                $soat->delete();
            }
            $codeudor->delete();

            DB::commit();
            
            flash()->success("Se eliminó el codeudor con el id " . $id . '  exitosamente');
            return redirect()->route('start.clientes.show',$cliente_id);

        }
        catch(\Exception $e)
        {
            DB::rollback();
            flash()->error("Error al eliminar " . $e->getMessage());
            return redirect()->route('start.clientes.show',$cliente->id);
        }
    }

    public function getData()
    {
        return [  
            'tipo_doc'              => getEnumValues('codeudores','tipo_doc'),    
            'estado_civil'          => getEnumValues('codeudores','estado_civil'),
            'nivel_estudios'        => getEnumValues('codeudores','nivel_estudios'),
            'envio_correspondencia' => getEnumValues('codeudores','envio_correspondencia'),
            'estrato'               => getEnumValues('codeudores','estrato'),
            'tipo_vivienda'         => getEnumValues('codeudores','tipo_vivienda'),
            'tipo_actividad'        => getEnumValues('codeudores','tipo_actividad'),
            'generos'               => getEnumValues('codeudores','genero'),
            'oficios'               => \App\Oficio::orderBy('nombre')->get(),
            'tipo_contrato'         => getEnumValues('codeudores','tipo_contrato'),
            'calificacion'          => ''
        ];
    }

}
