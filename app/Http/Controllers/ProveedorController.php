<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Proveedor;
use Auth;
use DB;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_doc = getEnumValues('proveedores', 'tipo_doc');
        $estados  = getEnumValues('proveedores', 'estado');

        return view('admin.proveedores.index')
            ->with('tipo_doc', $tipo_doc)
            ->with('estados', $estados);
    }

    public function list()
    {
        $proveedores = Proveedor::orderBy('created_at','desc')->get();
        $res = ['error' => false, 'dat' => $proveedores];

        return response()->json($res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedor = new Proveedor();

        return response()->json($proveedor);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $proveedor = new Proveedor();
            $proveedor->fill($request->proveedor);
            $proveedor->user_create_id = Auth::user()->id;
            $proveedor->estado = 'Activo';
            $proveedor->save();

            DB::commit();
            $res = ['error' => false, 'message' => 'Se creó el registro exitosamente !!!'];
        } catch (\Exception $e) {
            DB::rollback();
            $res = ['error' => true, 'message' => $e->getMessage()];
        }

        return response()->json($res);
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
        try {
            $proveedor = Proveedor::find($id);
            $res = ['error' => false, 'dat' => $proveedor ];

        } catch (\Exception $e) {
            $res = ['error' => true, 'message' => $e->getMessage()];
        } finally {
            return response()->json($res);
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
}
