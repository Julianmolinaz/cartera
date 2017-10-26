<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Punto;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id','<>','1')->get();
        return view('admin.users.index')
            ->with('users',$users);
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = getEnumValues('users', 'rol');


        $puntos = Punto::where('id','>',0)
                    ->where('estado','Activo')
                    ->orderBy('nombre')->get();


            return view('admin.users.create')
                ->with('roles',$roles)
                ->with('puntos',$puntos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules_user = array(
            'name'      => 'required',
            'rol'       => 'required',
            'email'     => 'required|email|unique:users',
            'punto_id'  => 'required',
            );
        $rules_message = array(
            'name.required'     => 'El Nombre es requerido',
            'rol.required'      => 'El Rol es requerido',
            'email.required'    => 'El Email es requerido',
            'email.email'       => 'El Email no tiene el formato esperado',
            'email.unique'      => 'El Email ya existe',
            'punto.required'    =>'El Punto es requerido',
            );

        $this->validate($request,$rules_user,$rules_message); 


        $user           = new User($request->all());
        $user->name     = strtoupper($request->input('name'));
        $user->password = bcrypt($request->password);
        $user->save();

        flash()->success($user->id.' -El usuario '.$user->name. ' se creo con éxito!');
        return redirect()->route('admin.users.index');


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
        $user = User::find($id);
        $roles = getEnumValues('users', 'rol');
        $puntos = Punto::where('id','>',0)
                    ->where('estado','Activo')
                    ->orderBy('nombre')
                    ->get();

        return view('admin.users.edit')
            ->with('puntos',$puntos)
            ->with('user',$user)
            ->with('roles',$roles);
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
        $rules_user = array(
            'name'      => 'required',
            'estado'    =>'required',
            'rol'       => 'required',
            'email'     => 'required|email|unique:users,email,'.$id,
            'password'  => 'required',
            );
        $rules_message = array(
            'name.required'     => 'El Nombre es requerido',
            'rol.required'      => 'El Rol es requerido',
            'email.required'    => 'El Email es requerido',
            'email.email'       => 'El Email no tiene el formato esperado',
            'email.unique'      => 'El Email ya existe',
            'password.required' => 'La Contraseña es requerida',
            );

        $this->validate($request,$rules_user,$rules_message); 

        $user = User::find($id);


        if($request->input('password') != $user->password ){
            $user->name     = strtoupper($request->input('name'));
            $user->estado   = $request->input('estado');
            $user->rol      = $request->input('rol');
            $user->email    = $request->input('email');
            $user->punto_id = $request->input('punto_id');
            $user->password = bcrypt($request->password); 
        } else{
            $user->name     = strtoupper($request->input('name'));
            $user->estado   = $request->input('estado');
            $user->rol      = $request->input('rol');
            $user->email    = $request->input('email');
            $user->punto_id = $request->input('punto_id');
        }

        $user->save();

        flash()->success($user->id.' -El usuario '.$user->name. ' se editó con éxito!');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        flash()->error('El usuario '.$user->name. ' se eliminó éxitosamente!');
        return redirect()->route('admin.users.index');
    }
}
