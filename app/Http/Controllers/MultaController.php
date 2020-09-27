<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Credito;
use App\Extra;
use App\Pago;
use DB;
use Auth;
class MultaController extends Controller
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
        
        $extras = Extra::where('id','>',0)->orderBy('updated_at','desc')->get();

        return view('admin.multas.index')
            ->with('extras',$extras);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        try{

            if($request->ajax()){

                $credito = Credito::find($request->credito_id);

                $multa = new Extra($request->all());
                $multa->estado = 'Debe'; 
                $multa->user_create_id = Auth::user()->id;
                $multa->user_update_id = Auth::user()->id;
                $multa->save();

                $credito->saldo = $credito->saldo + $multa->valor;
                $credito->save();

                DB::commit();

                if($multa){
                    return response()->json(['success' => 'true']);
                }else{
                    return response()->json(['success' => 'false']);    
                }
            }
        } catch(\Exception $e){
            DB::rollback();
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
        $conceptos = getEnumValues('extras', 'concepto');
        $estados   = getEnumValues('extras', 'estado');

        return view('admin.multas.show')
         ->with('credito',Credito::find($id))
         ->with('conceptos',$conceptos)
         ->with('estados',$estados);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $multa = Extra::find($id);
        
        $pago  = Pago::where('credito_id',$multa->credito_id)->where('estado','Debe')->get();

        if($multa->estado == 'Ok' || $multa->estado == 'Finalizado'){
            $pago  = array('debe' => null,'id' => null);
        }
        else if(count($pago) == 0){
            $pago  = array('debe' => $multa->valor,'id' => null);
        }
        else{
            $pago = $pago[0];
        }

        
        return response()->json(['multa' => $multa, 'pago' => $pago]);
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

       Try{

        if($request->ajax()){
            $multa = Extra::find($id);
            $credito = Credito::find($request->credito_id);
            $sumar = $request->sumar;
            $restar = $request->restar;
            if($sumar == null){ $sumar = 0; }
            if($restar == null){ $restar = 0; }


             if($request->estado == 'Debe'){

                $multa->valor = $multa->valor + $sumar - $restar;
                $multa->fecha = $request->fecha;
                $multa->descripcion = $request->descripcion;
                $multa->save();

                $credito->saldo = $credito->saldo + $sumar - $restar;
                $credito->save();

                if($request->pago_id <> null){
                    $pago = Pago::find($request->pago_id);
                    $pago->debe = $pago->debe  + $sumar - $restar;
                    $pago->save();  
                    if($pago->debe <= 0){
                        $pago->estado  = 'Finalizado';
                        $pago->save();
                        $multa->estado = 'Finalizado';
                        $multa->save();
                    }         
                }else{
                    if($multa->valor <= 0){
                        $multa->estado = 'Finalizado';
                        $multa->save();
                    }
                }
             }else{
                $multa->descripcion = $request->descripcion;
                $multa->save();
             }

             if($multa){ $boolean = 'true'; }
             else{ $boolean = 'false';}

             DB::commit();

            return response()->json(['success' => $boolean, 'res' => '']);
        }
      } catch(\Exception $e){
        DB::rollback();

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
        //
    }
    public function concepto(Request $request){
        if($request->ajax()){
            $res = 'false';
            if($request->concepto == 'Juridico' || $request->concepto == 'Prejuridico'){
                $extras = DB::table('extras')
                            ->where([['credito_id','=',$request->credito_id],
                                     ['concepto','=','Juridico'],
                                     ['estado','=','Debe']])
                            ->orWhere([['credito_id','=',$request->credito_id],
                                     ['concepto','=','Prejuridico'],
                                     ['estado','=','Debe']])
                            ->count();

                if($extras > 0){
                    $res = 'true';
                }else{
                    $res = 'false';
                }
            }                

            return response()->json(['success' => $res]);
        }
    }
}
