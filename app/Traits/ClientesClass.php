<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\Request;
use App\Codeudor;
use App\Conyuge;
use App\Cliente;
use App\Soat;
use Auth;
use DB;


trait ClientesClass
{
  /*
  |--------------------------------------------------------------------------
  | clienteConCodeudor 
  |--------------------------------------------------------------------------
  |
  | permite crear un cliente ccon codeudor
  | recibe el $request del formulario con info del 
  | cliente con el codeudor
  |
  */

  public function crearClienteConCodeudor($request)
  {
    DB::beginTransaction();

    try
    {
        // CREACION DEL CODEUDOR

        $codeudor = new Codeudor();
        $codeudor->fill($request->all());
        $codeudor->save();

        //CREAR SOAT PARA CODEUDOR

        if( $request->input('soatc') ){
          $this->createSoat($codeudor,'codeudor',$request);
        }

        // CREACIÓN DEL CONYUGE
        if($request->p_nombreyc){
            $this->createConyuge($codeudor,'codeudor',$request);
        }
            
        // CREACIÓN DE CLIENTE

        $cliente  = new Cliente();
        $values = $request->except(['tipo_docc']);
        $cliente->fill($values); 
        $cliente->codeudor_id       = $codeudor->id;
        $cliente->user_create_id    = Auth::user()->id;
        $cliente->user_update_id    = Auth::user()->id; 
        $cliente->save();
    
        if($request->p_nombrec){
            $this->createConyuge($cliente,'cliente',$request);
        }

        // CREACIÓN DEL SOAT
        
        if( $request->soat )
        {
            $this->createSoat($cliente, 'cliente', $request);
        }

        DB::commit();
        flash()->info('El cliente ('.$cliente->id.') '.$cliente->nombre.' se creo con éxito!');
        return redirect()->route('start.clientes.show',$cliente->id);
    }//.try
    catch(\Exception $e){
        DB::rollback();
        flash()->error($e->getMessage());
        return redirect()->route('start.clientes.create');
    }
    
  }

  /*
  |--------------------------------------------------------------------------
  | clienteSinCodeudor 
  |--------------------------------------------------------------------------
  |
  | Permite crear un cliente sin codeudor
  | recibe el $request del formulario con info del 
  | cliente
  |
  */

  public function crearClienteSinCodeudor($request)
  {

    DB::beginTransaction();
    try{
        // CREACION DEL CLIENTE

        $cliente = new Cliente();
        $cliente->fill($values);                
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
        dd($e->getMessage());
        return redirect()->route('start.clientes.create');                    
    }
  }

  /*
  |--------------------------------------------------------------------------
  | actualizarClienteConCodeudor 
  |--------------------------------------------------------------------------
  |
  | Permite actualizar un cliente con codeudor
  | recibe el $request del formulario con info del 
  | cliente y el codeudor
  |
  */

  public function actualizarClienteConCodeudor($request,$id)
  {

    DB::beginTransaction();

    try
    {    
        $cliente = Cliente::find($id);

        //ACTUALIZAR CLIENTE CON CODEUDOR SIN CODEUDOR ANTERIORMENTE

        if($cliente->codeudor->codeudor == "no"){ 

            $codeudor  = new Codeudor();
            $codeudor->fill($request->all());
            $codeudor->save();

            // CREACIÓN DEL SOAT
            if($request->soatc){
                $this->createSoat($codeudor, 'codeudor', $request);}

            // SE BORRA EL ESTUDIO 
            if($codeudor->estudio != NULL){
                $estudio = Estudio::find($codeudor->estudio->id);
                $estudio->delete();}

            // SE ACTUALIZA LA INFO DEL CLIENTE
            $this->update_cliente($cliente,$codeudor,$request);

            // SE CREA EL SOAT
            if($request->soat){
                $this->updateSoat($cliente,'cliente', $request);
            }

            if($cliente->conyuge){
                $this->editConyuge($cliente,'cliente',$request);
            }
            if($request->p_nombrecy){
                $this->createConyuge($codeudor,'codeudor',$request);
            }

        }//.if($cliente->codeudor->codeudor == "no")

        //ACTUALIZAR CLIENTE CON CODEUDOR CON CODEUDOR ANTERIORMENTE

        elseif($cliente->codeudor->codeudor == "si"){

            // ACTUALIZA CODEUDOR
       
            $codeudor  = Codeudor::find($cliente->codeudor_id);
            $codeudor->fill($request->all());
            $codeudor->save();

            // SE ACTUALIZA EL SOAT

            if($request->soatc){
                $this->updateSoat($codeudor, 'codeudor', $request);
            }

            // SE ACTUALIZA EL CLIENTE

            $this->update_cliente($cliente,$codeudor,$request);

            if($request->soat){
                $this->updateSoat($cliente, 'cliente', $request);
            }
            if($codeudor->conyuge){
                $this->editConyuge($codeudor,'codeudor',$request);
            }
            if($cliente->conyuge){
                $this->editConyuge($cliente,'cliente',$request);
            }

        }//.elseif

        
        DB::commit();
        flash()->info('El cliente ('.$cliente->id.') '.$cliente->nombre. ' se editó con éxito!');
        return redirect()->route('start.clientes.show',$cliente->id);

    }//.try
    catch(\Exception $e){
        DB::rollback();
        flash()->error($e);
        return redirect()->route('start.clientes.edit',$id);
    }
    
  }


  /*
  |--------------------------------------------------------------------------
  | actualizarClienteSinCodeudor 
  |--------------------------------------------------------------------------
  |
  | Permite actualizar un cliente sin codeudor
  | recibe el $request del formulario con info del 
  | cliente sin codeudor para ser actualizado
  |
  */

  public function actualizarClienteSinCodeudor($request, $id)
  {
    DB::beginTransaction();
      try{

          $cliente = Cliente::find($id);

          if($cliente->codeudor->codeudor == "no"){

              // ACTUALIZAR CLIENTE      

              $cliente->codeudor_id = 100;
              $cliente->save();

              $this->update_cliente($cliente,$cliente->codeudor,$request);

              $this->editConyuge($cliente,'cliente',$request);

              // ACTUALIZAR SOAT
              if($request->soat){ 
                  $this->updateSoat($cliente, 'cliente', $request); }
          }
          elseif($cliente->codeudor->codeudor == "si"){

              if( $cliente->codeudor->estudio != null )
              {
                  $exestudio = Estudio::find($cliente->codeudor->estudio->id);
                  $exestudio->delete();
              }

              if( $cliente->codeudor->conyuge )
              {
                  $conyuge = Conyuge::find($cliente->codeudor->conyuge->id);
              }

              //se crea un codeudor con id '100' que es un codeudor vacio por defecto
              $codeudor = Codeudor::find(100);
              $codeudor->save();

              // SE ACTUALIZA EL CLIENTE
              $this->update_cliente($cliente,$codeudor,$request);

              // SE ACTUALIZA EL CONYUGE
              $this->editConyuge($cliente,'cliente',$request);

              //se elimina el codeudor existente
              $excodeudor = Codeudor::find($cliente->codeudor->id);
              
              if($excodeudor->soat){
                  $excodeudor->soat->delete();
              }
              $excodeudor->delete();

              if($conyuge){
                  $conyuge->delete();
              }
          }//.elseif($request->codeudor == 'no')

          DB::commit();
          flash()->info('El cliente ('.$cliente->id.') '.$cliente->nombre. ' se editó con éxito!');
          return redirect()->route('start.clientes.show',$cliente->id);
      }//.try

      catch(\Exception $e)
      {
          flash()->info($e->getMessage());
          DB::rollback();
          return redirect()->route('start.clientes.show',$id);
      }
  }



	public function consultar_codeudor($id){
        $codeudor = Codeudor::find($id);
        return response()->json($codeudor);
    }


    /**
     * PERMITE CREAR REGISTRO DE SOAT
     * RECIBE UN OBJETO CLIENTE O CODEUDOR
     *        UN TIPO 'cliente' o 'codeudor'
     *        UN REQUEST CON LA DATA ENRANTE
     */


    private function createSoat($obj, $tipo, $request)
    {
      $soat = new Soat();
      
      if($tipo == 'cliente'){ 
          $soat->cliente_id   = $obj->id;
          $soat->tipo         = 'cliente';
          $soat->placa        = $request->placa;
          $soat->vencimiento  = $request->soat;

      }
      else if($tipo == 'codeudor'){

          $soat->codeudor_id = $obj->id;
          $soat->tipo        = 'codeudor';
          $soat->placa       = $request->placac;
          $soat->vencimiento = $request->soatc;
      }
      $soat->user_create_id   = Auth::user()->id; 
      $soat->user_update_id   = Auth::user()->id; 
      $soat->save();

    } //.createSoat

        /**
     * PERMITE ACTUSLIZAR REGISTRO DE SOAT
     * RECIBE UN OBJETO CLIENTE O CODEUDOR
     *        UN TIPO 'cliente' o 'codeudor'
     *        UN REQUEST CON LA DATA ENRANTE
     */

    private function updateSoat($obj, $tipo, $request)
    {
        $soat = $obj->soat;

        //SI EL CLIENTE TIENE UN SOAT ASOCIADO
        if($soat){
            if($tipo == 'cliente'){ 
                $soat->cliente_id = $obj->id;
                $soat->tipo       = 'cliente';
                $soat->placa            = $request->input('placa');
                $soat->vencimiento      = $request->input('soat');
    
    
            }
            else if($tipo == 'codeudor'){
                $soat->codeudor_id = $obj->id;
                $soat->tipo        = 'codeudor';
                $soat->placa       = $request->input('placac');
                $soat->vencimiento = $request->input('soatc');
            }
            $soat->user_update_id   = Auth::user()->id;
            $soat->save();
        }
        //SI EL CLIENTE NO TIENE SOAT ASOCIADO
        else{
            $this->createSoat($obj,$tipo,$request);
        }
    } //.updateSoat


    /**
     * Permite crear un conyuge tanto para cliente como codeudor
     * @input $obj, puede ser de tipo cliente o tipo codeudor
     * @input $tipo, puede tomar dos 
     */

    private function createConyuge($obj, $tipo, $request)
    {
      if( $tipo == 'cliente' ){

        $conyuge = new Conyuge();

        $conyuge->fill($request->all());

        if( $conyuge->isDirty() ){

          $conyuge->save();

          DB::table('clientes')
            ->where('id',$obj->id)
            ->update(['conyuge_id'=> $conyuge->id]);
        }
      }
      elseif( $tipo == 'codeudor' ){

        $conyuge = new Conyuge();

        $conyuge->nombrey     = $request->nombreyc;
        $conyuge->p_nombrey   = $request->p_nombreyc;
        $conyuge->s_nombrey   = $request->s_nombreyc;
        $conyuge->p_apellidoy = $request->p_apellidoyc;
        $conyuge->s_apellidoy = $request->s_apellidoyc;
        $conyuge->tipo_docy   = $request->tipo_docyc;
        $conyuge->num_docy    = $request->num_docyc;
        $conyuge->diry        = $request->diryc;
        $conyuge->movily      = $request->movilyc;
        $conyuge->fijoy       = $request->fijoyc;

        if($conyuge->isDirty()){

          $conyuge->save();

          DB::table('codeudores')
            ->where('id',$obj->id)
            ->update(['conyuge_id' => $conyuge->id]);
        }
      }//.elseif
    }//.function


    /**
     * Permite crear un conyuge tanto para cliente como codeudor
     * @input $obj, puede ser de tipo cliente o tipo codeudor
     * @input $tipo, puede tomar dos 
     */

    private function editConyuge($obj, $tipo, $request)
    {
      if( $tipo == 'cliente' ){

        $conyuge = Conyuge::find($obj->conyuge->id);

        $conyuge->fill($request->all());

        if( $conyuge->isDirty() ){

          $conyuge->save();

          DB::table('clientes')
            ->where('id',$obj->id)
            ->update(['conyuge_id'=> $conyuge->id]);
        }
      }
      elseif( $tipo == 'codeudor' ){

        $conyuge = Conyuge::find($obj->conyuge->id);
        $conyuge->nombrey     = $request->nombreyc;
        $conyuge->p_nombrey   = $request->p_nombreyc;
        $conyuge->s_nombrey   = $request->s_nombreyc;
        $conyuge->p_apellidoy = $request->p_apellidoyc;
        $conyuge->s_apellidoy = $request->s_apellidoyc;
        $conyuge->tipo_docy   = $request->tipo_docyc;
        $conyuge->num_docy    = $request->num_docyc;
        $conyuge->diry        = $request->diryc;
        $conyuge->movily      = $request->movilyc;
        $conyuge->fijoy       = $request->fijoyc;

        if($conyuge->isDirty()){

          $conyuge->save();

          DB::table('codeudores')
            ->where('id',$obj->id)
            ->update(['conyuge_id' => $conyuge->id]);
        }
      }//.elseif
    }//.function
	 /**
	 * Permite actualizar un cliente
	 * @input $cliente = objeto tipo cliente
	 * @input $codeudor , objeto de tipo codeudor
	 * @input $request , data del formualrio de creación de cliente y codeudor
	 */

    public function update_cliente($cliente,$codeudor,$request)
    {
      $values = $request->except(['tipo_docc']);
      $cliente->fill($values); 
      $cliente->codeudor_id     = $codeudor->id;
      $cliente->user_update_id  = Auth::user()->id;
      $cliente->save();
    }

    public function rules_cliente($opcion)
    {
    	if( $opcion == 'crear' )
    	{
    		$num_doc = 'required|max:15|unique:clientes';
    	}
    	elseif( $opcion == 'editar' ) 
    	{
    		$num_doc = 'required|max:15|unique:clientes,'.'id';
    	}
    	else
    	{
    		dd('error en rules cliente'.$opcion);
    	}

		return array(
            'primer_nombre'             => ['required','max:60','regex:/^[a-zA-ZñÑ[:space:]]*$/'],
            'segundo_nombre'            => ['max:30','regex:/^[a-zA-ZñÑ[:space:]]*$/'],
            'primer_apellido'           => ['required','max:30','regex:/^[a-zA-ZñÑ[:space:]]*$/'],
            'segundo_apellido'          => ['max:30','regex:/^[a-zA-ZñÑ[:space:]]*$/'],
            'tipo_doc'                  => 'required',
            'num_doc'                   => $num_doc,
            'fecha_nacimiento'          => 'required',
            'direccion'                 => ['required','max:100', 'regex:/^[a-zA-ZñÑ0-9#\-\.[:space:]]*$/'],
            'barrio'                    => 'required',
            'municipio_id'              => 'required',
            'movil'                     => 'required|max:20|alpha_num',
            'fijo'                      => 'max:20|alpha_num',
            'ocupacion'                 => 'required',
            'tipo_actividad'            => 'required',
            'email'                     => 'required|max:60'
            );
    }

    public function messages_cliente($opcion)
    {
    	// if( $opcion == 'crear' ){}
    	// elseif( $opcion == 'editar' ){}
    	// else{}
		return array(
           'primer_nombre.required'     => 'EL primer nombre del cliente es requerido',
           'primer_nombre.max'          => 'El primer nombre del cliente excede los 60 caracteres permitidos',
           'primer_nombre.regex'        => 'El formato del primer nombre del cliente no es permitido',
           'segundo_nombre.max'         => 'El segundo nombre del cliente excede los 30 caracteres',
           'segundo_nombre.regex'       => 'El formato del segundo nombre no es permitido',
           'primer_apellido.required'   => 'EL primer apellido del cliente es requerido',
           'primer_apellido.max'        => 'El primer apellido del cliente excede los 30 caracteres permitidos',
           'primer_apellido.regex'      => 'El formato del primer apellido no es permitido',
           'segundo_apellido.max'       => 'El segundo apellido del cliente excede los 30 caracteres permitidos',
           'segundo_apellido.regex'     => 'El formato del segundo apellido no es permitido',
           'tipo_doc.required'          => 'El tipo de documento  del cliente es requerido',
           'num_doc.unique'             => 'EL número de documento del cliente ya esta en uso',
           'num_doc.max'                => 'El número de documento excede los 8 digitos permitidos',
           'num_doc.required'           => 'El número de documento del cliente es requerido',
           'fecha_nacimiento.required'  => "La fecha de nacimiento del cliente es requerida",
           'direccion.required'         => 'La dirección del cliente es requerida',
           'direccion.max'              => 'La dirección del cliente excede los 100 caracteres permitidos',
           'direccion.regex'            => 'El formato de la dirección del cliente no es permitido',
           'barrio.required'            => 'El barrio del cliente es requerido',
           'municipio_id.required'      => 'El municipio del cliente es requerido' ,
           'movil.required'             => "El celular del cliente es requrido",
           'movil.max'                  => 'El número celular del cliente excede los 20 dígitos permitidos',
           'movil.alpha_num'            => 'No se puede introducir espacios en el movil',
           'fijo.alpha_num'             => 'No se puede introducir espacios en el teléfono',
           'fijo.max'                   => 'El número de teléfono del cliente excede los 20 dígitos permitidos',
           'ocupacion.required'         => 'La ocupación del cliente es requerida',
           'tipo_actividad.required'    => 'El tipo de actividad del cliente es requerida',
           'email.required'             => 'El email es requerido',
           'email.max'                  => 'El email del cliente excede los 60 caracteres permitidos'
            );
    }

    public function rules_codeudor($opcion)
    {
    	// if( $opcion == 'crear' ){}
    	// elseif( $opcion == 'editar' ) {}
    	// else{}

		return array(
            'primer_nombrec'            => ['required','max:60','regex:/^[a-zA-ZñÑ[:space:]]*$/'],
            'segundo_nombrec'           => ['max:30','regex:/^[a-zA-ZñÑ[:space:]]*$/'],
            'primer_apellidoc'          => ['required','max:30','regex:/^[a-zA-ZñÑ[:space:]]*$/'],
            'segundo_apellidoc'         => ['max:30','regex:/^[a-zA-ZñÑ[:space:]]*$/'],
            'tipo_docc'                 => 'required',
            'num_docc'                  => 'required|max:15',
            'fecha_nacimientoc'         => 'required',
            'direccionc'                => ['required','max:100','regex:/^[a-zA-ZñÑ0-9#\-\.[:space:]]*$/'],
            'barrioc'                   => 'required',
            'municipioc_id'             => 'required',
            'movilc'                    => 'required|max:20|alpha_num',
            'fijoc'                     => 'max:20|alpha_num',
            'ocupacionc'                => 'required',
            'tipo_actividadc'           => 'required',
            'emailc'                    => 'required|max:60'
            );
    }

    public function messages_codeudor($opciones)
    {
    	    // if( $opcion == 'crear' ){}
	    	// elseif( $opcion == 'editar' ) {}
	    	// else{}

		return array(
           'primer_nombrec.required'    => 'EL primer nombre del codeudor es requerido',
           'primer_nombrec.max'         => 'El primer nombre del codeudor excede los 60 caracteres permitidos',
           'primer_nombrec.regex'       => 'El formato del primer nombre del codeudor no es permitido',
           'segundo_nombrec.max'        => 'El segundo nombre del codeudor excede los 30 caracteres permitidos',
           'segundo_nombrec.regex'      => 'El formato del segundo nombre del codeudor no es permitido',
           'primer_apellidoc.required'  => 'El primer apellido del codeudor es requerido',
           'primer_apellidoc.max'       => 'El primer apellido del codeudor excede los 30 caracteres',
           'primer_apellidoc.regex'     => 'El formato del primer apellido del codeudor no es permitido',
           'segundo_apellidoc.max'      => 'El segundo apellido del codeudor excede los 30 caracteres',
           'segundo_apellidoc.regex'    => 'El formato del segundo apellido del codeudor no es permitido',
           'tipo_docc.required'         => 'El tipo de documento del codeudor es requerido',    
           'num_docc.required'          => 'El número de documento del codeudor es requerido',
           'num_docc.max'               => 'El número de documento del codeudor excede los 8 digitos permitidos',
           'fecha_nacimientoc.required' => 'La fecha de nacimiento del codeudor es requerida',
           'direccionc.required'        => 'La dirección del codeudor es requerida',
           'direccionc.max'             => 'La dirección del codeudor excede los 100 caracteres permitidos',
           'direccionc.regex'           => 'El formato de la dirección del codeudor no es permitido',
           'barrioc.required'           => 'El barrio del codeudor es requerido',
           'municipioc_id.required'     => 'El municipio del codeudor es requerido',
           'movilc.required'            => 'El número celular del codeudor es requerido',
           'movilc.max'                 => 'El número celular del codeudor excede los 20 dígitos permitidos',   
           'movilc.alpha_num'           => 'No se puede introducir espacios en el movil',
           'fijoc.alpha_num'            => 'No se puede introducir espacios en el teléfono',
           'fijoc.max'                  => 'El número de teléfono del codeudor excede los 20 dígitos permitidos',
           'ocupacionc.required'        => 'La ocupación del codeudor es requerida',
           'tipo_actividadc.required'   => 'El tipo de actividad del codeudor es requerida',
           'emailc.required'            => 'El email del codeudor es requerido',
           'emailc.max'                 => 'El correo electronico del codeudor excede los 60 caracteres permitidos'
        );    	
    }


}