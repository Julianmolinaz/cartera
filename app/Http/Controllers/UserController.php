<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Punto;
use App\User;
use App\Banco;

class UserController extends Controller
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
        $users = User::where('id','<>','1')
            ->orderBy('updated_at','DESC')
            ->get();

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
        $roles = \App\Role::orderBy('name')->get();
        $bancos = Banco::orderBy('nombre')->get();

        $puntos = Punto::where('id','>',0)
                ->where('estado','Activo')
                ->orderBy('nombre')
                ->get();

            return view('admin.users.create')
                ->with('bancos',$bancos)
                ->with('puntos',$puntos)
                ->with('roles',$roles);
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
            'rol_id'       => 'required',
            'email'     => 'required|email|unique:users',
            'punto_id'  => 'required',
            );
        $rules_message = array(
            'name.required'     => 'El Nombre es requerido',
            'rol_id.required'      => 'El Rol es requerido',
            'email.required'    => 'El Email es requerido',
            'email.email'       => 'El Email no tiene el formato esperado',
            'email.unique'      => 'El Email ya existe',
            'punto.required'    =>'El Punto es requerido',
            );               

        $this->validate($request,$rules_user,$rules_message);
        
        \DB::beginTransaction();

        try {

            $user           = new User( $request->all() );
            $user->name     = strtoupper($request->input('name'));
            $user->password = bcrypt($request->password);
            $user->save();

            $role_user = \DB::table('role_user')->insert([
                'user_id' => $user->id,
                'role_id' => $request->rol_id
            ]);
            
            \DB::commit();

            flash()->success($user->id.' -El usuario '.$user->name. ' se creo con éxito!');
            return redirect()->route('admin.users.index');

        } catch (\Exception $e) {

            \DB::rollback();

            flash()->success('Error: '.$e->getMessage());
            return redirect()->route('admin.users.create');
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
        $user = User::find($id);
        $roles = \DB::table('roles')->orderBy('display_name')->get();
        $puntos = Punto::where('id','>',0)
                    ->where('estado','Activo')
                    ->orderBy('nombre')
                    ->get();
        $bancos = Banco::orderBy('nombre')->get();

        return view('admin.users.edit')
            ->with('puntos',$puntos)
            ->with('bancos',$bancos)
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
            'rol_id'       => 'required',
            'email'     => 'required|email|unique:users,email,'.$id,
            'password'  => 'required',
        );

        $rules_message = array(
            'name.required'     => 'El Nombre es requerido',
            'rol_id.required'      => 'El Rol es requerido',
            'email.required'    => 'El Email es requerido',
            'email.email'       => 'El Email no tiene el formato esperado',
            'email.unique'      => 'El Email ya existe',
            'password.required' => 'La Contraseña es requerida',
        );

        $this->validate($request,$rules_user,$rules_message); 


        \DB::beginTransaction();

        try {

            $user = User::find($id);
            $user->name     = strtoupper($request->input('name'));
            $user->estado   = $request->input('estado');
            $user->rol_id      = $request->input('rol_id');
            $user->email    = $request->input('email');
            $user->punto_id = $request->input('punto_id');
            $user->banco_id = $request->input('banco_id');
            $user->num_cuenta = $request->input('num_cuenta');
    
            if ($request->input('password') != $user->password ) {
                $user->password = bcrypt($request->password); 
            }

            $role_user = \DB::table('role_user')->where('user_id',$user->id)->get();

            if ($role_user) {

                \DB::table('role_user')->update([
                    'user_id' => $user->id,
                    'role_id' => $request->rol_id
                ])->where('user_id',$user->id);        

            } else {
                $role_user = \DB::table('role_user')->insert([
                    'user_id' => $user->id,
                    'role_id' => $request->rol_id
                ]);
                
            }
    
    
            $user->save();

            \DB::commit();
    
            flash()->success($user->id.' -El usuario '.$user->name. ' se editó con éxito!');
            return redirect()->route('admin.users.index');
        
        } catch (\Exception $e) {
            \DB::rollback();

            flash()->success('Error: '.$e->getMessage());
            return redirect()->route('admin.users.edit', $user->id);
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
        $user = User::find($id);
        $user->delete();
        flash()->error('El usuario '.$user->name. ' se eliminó éxitosamente!');
        return redirect()->route('admin.users.index');
    }

    public function getUsers()
    {
        try {
            $users = User::where('estado','Activo')
                        ->with('banco')
                        ->orderBy('name')
                        ->get();
    
            $res = ['error' => false, 'dat' => $users];
        } catch (\Exception $e) {
            $res = ['error' => true, 'message' => $e->getMessage()];
        }

        return response()->json($res);

    }   
}
