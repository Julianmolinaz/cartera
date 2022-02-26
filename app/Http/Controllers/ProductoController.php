<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Producto;
use Src\Productos\UseCases\EliminarProductoUseCase;
use Datatables;

class ProductoController extends Controller
{
    protected $estados;

    public function __construct()
    {
        $this->estados = [
            ['code' => 1, 'label' => 'Activo'],
            ['code' => 0, 'label' => 'Inactivo'],
        ];
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::orderBy('updated_at')->get();
        return view('admin.productos.index')
            ->with('productos',$productos);
    }

    public function list()
    {
        $query = \DB::table("productos")
            ->orderBy("updated_at", "desc");

        return Datatables::of($query)
            ->make(true);
    }


    public function create()
    {
        $insumos = [
            'estados' => $this->estados
        ];
        return view('admin.productos.create')
            ->with("insumos", $insumos);
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre' => 'required|unique:productos'],[
            'nombre.required' => 'El Nombre del producto es requerido',
            'nombre.unique'   => 'El Producto ya existe'
        ]);

        $producto = new Producto();
        $data = $request->all();
        $data['valores'] = json_encode($request->valores);
        $producto->fill($data);

        $producto->save();

        flash()->success('El Producto '.$producto->nombre.' se creó con Éxito!!');
        return redirect()->route('admin.productos.index');
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
        $producto = Producto::find($id);
        $insumos = [
            'estados' => $this->estados
        ];

        return view('admin.productos.edit')
            ->with('producto',$producto)
            ->with('insumos', $insumos);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nombre' => 'required|unique:productos,nombre,'.$id],[
            'nombre.required' => 'El Nombre del producto es requerido',
            'nombre.unique'   => 'El Producto ya existe'
        ]);

        $producto = Producto::find($id);
        $data = $request->all();
        $data['valores'] = json_encode($request->valores);
        $producto->fill($data);
        $producto->save();

        flash()->success('El Producto '.$producto->nombre.' se editó con Éxito!!');
        return redirect()->route('admin.productos.index');
    }

    public function destroy($productoId)
    {
        try {
            $case = new EliminarProductoUseCase($productoId);
            $case->execute();
            flash()->success("El producto fue eliminado");
            return redirect()->route("admin.productos.index");
        } catch (\Exception $e) {
            flash()->error($e->getMessage());
            return redirect()->route("admin.productos.index");
        }
    }

}
