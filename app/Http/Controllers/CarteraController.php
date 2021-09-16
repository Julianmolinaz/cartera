<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\FechaCobro;
use Carbon\Carbon;
use App\Variable;
use App\Cartera;
use App\Sancion;
use App\Factura;
use App\Credito;
use App\Extra;
use App\Pago;
use Auth;
use DB;


class CarteraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.carteras.index')
            ->with('carteras',Cartera::all()
            ->sortBy('id'));
    }

    public function create()
    {
        return view('admin.carteras.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'nombre' => 'required|unique:carteras'
            ],
            [
                'nombre.required' => 'El Nombre es requerido',
                'nombre.unique' => 'El Nombre ya existe'
            ]
        );

       DB::beginTransaction();

       try{

           $cartera = new Cartera($request->all());
           $cartera->save();

           DB::commit();

           flash()->success('Se creo la cartera "'.$cartera->nombre.'" con Éxito!');
           return redirect()->route('admin.carteras.index');

       } catch(\Exception $e){

           DB::rollback();

           flash()->error('Se presento un error, intentalo de nuevo.');
           return redirect()->route('admin.carteras.index');

       }
   }


    public function show($id)
    {
        $factura = Factura::find($id);

        $ultima_factura = DB::table('facturas')
            ->where('descuento', false)
            ->where('credito_id',$factura->credito_id)
            ->orderBy('created_at','desc')
            ->first();

        if ( $ultima_factura->id == $factura->id ) {
            echo 'si es la ultima facura';
        } else {
            echo 'no es la ultima factura';
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cartera = Cartera::find($id);
        $estados = getEnumValues('carteras','estado');

        return view('admin.carteras.edit')
        ->with('cartera',$cartera)
        ->with('estados',$estados);
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
        $this->validate($request,
            [
                'nombre' => 'required|unique:carteras,nombre,'.$id
            ],
            [
                'nombre.required' => 'El Nombre es requerido',
                'nombre.unique' => 'El Nombre ya existe'
            ]
        );

        DB::beginTransaction();

        try{

            $cartera = Cartera::find($id);
            $cartera->fill($request->all());
            $cartera->save();

            DB::commit();

            flash()->success('La cartera "'.$cartera->nombre.'" se editó con Éxito!');
            return redirect()->route('admin.carteras.index');

        } catch (\Exception $e){
            DB::rollback();

            flash()->error('Se presento un error, intentalo de nuevo.');
            return redirect()->route('admin.carteras.index');
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
            $cartera = Cartera::find($id);
            $cartera->delete();

            DB::commit();

            flash()->success('La cartera "'.$cartera->nombre.'" se eliminó con Éxito!');
            return redirect()->route('admin.carteras.index');

        } catch(\Exception $e){
            DB::rollback();

            flash()->error('Se presento un error.');
            return redirect()->route('admin.carteras.index');
        }
    }

    public function getCarteras()
    {
        try {
            $carteras = Cartera::orderBy('nombre')->get();
            $res = ['error' => false, 'dat' => $carteras];
        } catch (\Exception $e) {
            $res = ['error' => false, 'message' => $e->getMessage()];
        }

        return response()->json($res);
    }
}
