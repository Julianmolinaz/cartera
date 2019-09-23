<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\CarteraNegocio;
use App\Negocio;
use App\Cartera;
use Auth;
use DB;

class NegocioController extends Controller
{

    protected $negocio;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $negocios = Negocio::orderBy('id','desc')->get();

        return view('admin.negocios.index')
            ->with('negocios', $negocios);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carteras = Cartera::orderBy('nombre')->get();
        $negocio = new Negocio();
        $negocio->carteras = [];
        $status = 'crear';
        
        return view('admin.negocios.create')
            ->with('carteras', $carteras)
            ->with('negocio', $negocio)
            ->with('status', $status);
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
            $negocio = new Negocio();
            $negocio->fill($request->only(['nombre','descripcion']));
            $negocio->save();

            if($request->carteras){
                foreach($request->carteras as $cartera){
                    DB::table('cartera_negocio')
                        ->insert([
                            'negocio_id' => $negocio->id,
                            'cartera_id' => $cartera['id']
                        ]);
                }
            }
            
            $res = [
                'success' => true,
                'message' => 'Negocio creado exitosamente !!!'
            ];

            DB::commit();

            return response()->json($res, 200);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage(),
                'message' => 'Ocurrió un error en el servidor'
            ], 400);
        }

        $res = [
            'success' => true,
            'dat'     => $request->all()
        ];

        return response()->json($res, 200);
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
        $carteras = Cartera::orderBy('nombre')->get();
        $negocio = Negocio::find($id);
        $negocio->carteras;
        $status = 'editar';

        return view('admin.negocios.create')
            ->with('carteras', $carteras)
            ->with('negocio', $negocio)
            ->with('status', $status);

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

            //actualizar negocio

            $this->negocio = Negocio::find($id);
            $this->negocio->fill($request->only(['nombre', 'descripcion']));
            $this->negocio->save();

            //actualizar carteras
            DB::table('cartera_negocio')->where('negocio_id',$this->negocio->id)->delete();
            
            if($request->carteras){
                foreach($request->carteras as $cartera){
                    DB::table('cartera_negocio')
                        ->insert([
                            'negocio_id' => $this->negocio->id,
                            'cartera_id' => $cartera['id']
                        ]);
                }
            }

            $res = [
                'success' => true,
                'dat'     => $request->all(),
                'message' => 'Se actualizó el registro exitosamente !!!'
            ];

            DB::commit();
            return response()->json($res, 200);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage(),
                'message' => 'Se ha presenta un error en el servidor !!!'
            ]);
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

        try {
            $negocio = Negocio::find($id);

            if($negocio->carteras){
                foreach($negocio->carteras as $cartera){
                    DB::table('cartera_negocio')->where('cartera_id',$cartera->id)->delete();
                }
            }

            $negocio->delete();


            DB::commit();

            flash()->success('Se eliminó el registro Exitosamente!');
            
            return redirect()->route('admin.negocios.index');

        } catch (\Exception $e) {
            DB::rollback();

            flash()->error('Ocurrio un error, no se pudo borrar el registro!');
            return redirect()->route('admin.negocios.index');
        }

    }
}
