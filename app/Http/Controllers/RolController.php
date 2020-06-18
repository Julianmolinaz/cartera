<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Role;
use DB;

class RolController extends Controller
{
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

        $roles    = \App\Role::orderBy('display_name')->get();
        
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
        $rules = [
            'name' => 'required|unique:roles',
            'descripcion' => 'required'
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'descripcion.required' => 'La descripción es requerida'
        ];

        $validator = Validator::make( $request->all() , $rules, $messages);

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
            $rol->name = $request->name;
            $rol->display_name = $request->name;
            $rol->description = $request->description; 
            $rol->save();

            foreach($request->categorias as $categoria) {

                foreach ($categoria['permisos'] as $permiso) {

                    if (isset($permiso['checked']) && $permiso['checked']) {

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
        //
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

    public function getCategorias()
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
                    $temp = [
                        'id'           => $permiso->id,
                        'name'         => $permiso->name,
                        'display_name' => $permiso->display_name,
                        'description'  => $permiso->description,
                        'status'       => $permiso->status,
                        'selected'     => false,
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
}
