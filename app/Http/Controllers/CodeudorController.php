<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ClientesClass;
use App\Http\Requests;
use App\Precredito;
use App\Municipio;
use App\Codeudor;
use App\Cliente;
use App\Conyuge;
use App\Estudio;
use Carbon\Carbon;
use App\Soat;
use Auth;
use DB;

class CodeudorController extends Controller
{

    use ClientesClass;
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
        $municipios         = Municipio::where('id', '!=', 100)->orderBy('departamento','asc')->get();
        $tipo_actividades   = getEnumValues('codeudores','tipo_actividadc');
        $tipos_documento    = getEnumValues('codeudores','tipo_docc');


        return view('start.codeudores.create')
            ->with('municipios',$municipios)
            ->with('tipo_actividades',$tipo_actividades)
            ->with('tipos_documento', $tipos_documento)
            ->with('cliente_id',$cliente_id);
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
        // dd($request->all());

        $rules_codeudor    = $this->rules_codeudor('crear');
        $message_codeudor  = $this->messages_codeudor('crear');

        $this->validate($request,$rules_codeudor,$message_codeudor);

        try{
            // CREACION DEL CLIENTE

            $codeudor = new Codeudor();
            $codeudor->fill($request->all());         
            $codeudor->save();


            $cliente = Cliente::find($request->cliente_id);
            $cliente->codeudor_id = $codeudor->id;
            $cliente->save();

            //CREACION REGISTRO VENCIMIENTO SOAT

            if( $request->soatc ){
                $this->createSoat($codeudor, 'codeudor', $request);
            }

            DB::commit();

            flash()->info('El codeudor ('.$codeudor->id.') '.$codeudor->nombrec. ' se creo con éxito!');
            return redirect()->route('start.clientes.show',$cliente->id);
        }//.try
        catch(\Exception $e){
            DB::rollback();
            flash()->error('Error '.$e->getMessage());
            return redirect()->route('start.codeudores.create', $request->cliente_id);                    
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
        $municipios         = Municipio::where('id', '!=', 100)->orderBy('departamento','asc')->get();
        $tipo_actividadesc  = getEnumValues('codeudores','tipo_actividadc');
        $cliente            = Cliente::find($id);
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
        //dd($request->all());

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
}
