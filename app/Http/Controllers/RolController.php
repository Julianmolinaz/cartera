<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Role;
use DB;

class RolController extends Controller
{

    public function __constructor()
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
        try {
            $roles    = \App\Role::orderBy('display_name')->get();
    
            return response()->json([
                'success' => true,
                'dat' => $roles
            ]);

        } catch (\Exception $e) {
            return respose()->json([
                'success' => false,
                'message' => 'Ocurrió un error '.$e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr_categorias = []; 

        $roles = \App\Role::orderBy('display_name')->get();
        
        $categorias = $this->getCategorias();

        return view('admin.roles.create')
            ->with('categorias',$categorias)
            ->with('roles', $roles);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Log::info($request->all());

        $validator = $this->validationRole($request->role);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación',
                'dat'     => $validator->errors()
            ]);
        }

        DB::beginTransaction();

        try {
            $rol = new Role();
            $rol->display_name = $request->role['name'];
            $rol->name = str_replace(' ', '_', $request->role['name']);
            $rol->description = $request->role['description']; 
            $rol->save();

            foreach($request->categorias as $categoria) {

                foreach ($categoria['permisos'] as $permiso) {

                    if ( $permiso['selected'] ) {

                        DB::table('permission_role')->insert([
                            'role_id' => $rol->id,
                            'permission_id' => $permiso['id']
                        ]);
                    }
                }


            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transacción exitosa !!!'
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            \Log::error($e);

            return response()->json([
                'success' => false,
                'message' => 'Sucedió un problema: '.$e->getMessage()
            ]);
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
        $role = Role::find($id);

        $permissions = \DB::table('permission_role')->where('role_id',$role->id)->get();

        $categorias = $this->getCategorias($permissions);

        return response()->json([
            'error' => false,
            'dat'   => [ 
                'role'       => $role, 
                'categorias' => $categorias 
                ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        DB::beginTransaction();

        try {

            $rol = Role::find($id);
            $rol->display_name = $request->role['name'];
            $rol->name = str_replace(' ', '_', $request->role['name']);
            $rol->description = $request->role['description']; 
            $rol->save();
    
            DB::table('permission_role')->where('role_id', $id)->delete();
    
            foreach($request->categorias as $categoria) {
    
                foreach ($categoria['permisos'] as $permiso) {
    
                    if ( $permiso['selected'] ) {
    
                        DB::table('permission_role')->insert([
                            'role_id' => $rol->id,
                            'permission_id' => $permiso['id']
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json([
                'error'   => false, 
                'message' => 'Se actualizo el Rol y sus permisos'
            ]);
        } catch (\Exception $e) {

            DB::rollback();

            return response()->json([
                'error'   => true, 
                'message' => 'Se presentó un error: '.$e->getMessage()
            ]);

        }
 



        \Log::info( $request->all() );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCategorias($permissions = null)
    {
        $permisos =  \App\Permission::orderBy('category')->get();
        $categorias = \DB::table('permissions')
            ->select('category')
            ->groupBy('category')
            ->get();

        foreach ($categorias as $categoria) {
            $categoria->permisos = [];
            $categoria->show     = true;
        }


        foreach ($permisos as $permiso) {

            for ($i = 0; $i < count($categorias); $i++) {

                if ($categorias[$i]->category == $permiso->category) {

                    $selected = $this->asignarPermiso($permissions, $permiso->id);

                    $temp = [
                        'id'           => $permiso->id,
                        'name'         => $permiso->name,
                        'display_name' => $permiso->display_name,
                        'description'  => $permiso->description,
                        'status'       => $permiso->status,
                        'selected'     => $selected,
                        'show'         => true
                    ];

                    $categorias[$i]->permisos[] = $temp;
                }

            }

        }//.foreach

        return $categorias;

    }

    public function categorias_con_permisos()
    {
        return response()->json([
            'success' => true,
            'dat'     => $this->getCategorias()
        ]);
    }

    public function asignarPermiso($permissions, $permiso_id)
    {
        $selected = false;

        if ($permissions) {
            foreach ( $permissions as $permission ) {
       
                if ($permission->permission_id == $permiso_id) {

                    $selected = true;
                }
            }
        }

        return $selected;
    }

    public function validationRole($data_role){
        $rules = [
            'name' => 'required|unique:roles',
            'description' => 'required'
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'description.required' => 'La descripción es requerida'
        ];

        $validator = Validator::make( $data_role , $rules, $messages);

        return $validator;
    }
}
