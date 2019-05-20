<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\EgresosRepository;
use Carbon\Carbon;
use App\Proveedor;
use App\Cartera;
use App\Egreso;
use App\Punto;
use App\User;
use Auth;
use DB;


class EgresoController extends Controller
{
    protected $paginate;
    protected $string;
    protected $repo;

    public function __construct(EgresosRepository $repo)
    {
        $this->middleware('auth');
        $this->repo  = $repo; 
        $this->paginate = 10;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('start.egresos.index')
            ->with('rol',Auth::user()->rol);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $conceptos = getEnumValues('egresos','concepto');
        $carteras  = Cartera::where('estado','Activo')->get();
        $puntos    = Punto::where('estado','Activo')->orderBy('nombre','asc')->get();
        $egreso    = new Egreso();

        return view('start.egresos.create')
            ->with('conceptos',$conceptos)
            ->with('carteras',$carteras)
            ->with('puntos',$puntos)
            ->with('egreso',$egreso);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return response()->json($request->all());
        // $rules_egreso = array(
        //     'fecha'                 => 'required',
        //     'comprobante_egreso'    => 'required|unique:egresos',
        //     'cartera_id'               => 'required',
        //     'concepto'              => 'required',
        //     'valor'                 => 'required|numeric',
        //     'punto_id'              => 'required'
        //     );
        // $rules_message = array(
        //     'fecha.required'                => 'La Fecha es requerida',
        //     'comprobante_egreso.required'   => 'El # Comprobande de Egreso es requerido',
        //     'cartera_id.required'           => 'La Cartera es requerida',  
        //     'comprobante_egreso.unique'     => 'El # Comprobante de Egreso ya existe',    
        //     'concepto.required'             => 'El Concepto es requerido',
        //     'valor.required'                => 'El Valor es requerido',
        //     'valor.numeric'                 => 'El Valor debe ser un numero',
        //     'punto_id.required'             => 'El punto es requerido'
        //     );

        // $this->validate($request,$rules_egreso,$rules_message); 

        DB::beginTransaction();

        try {

            $prefijo =  DB::table('consecutivos')->select('prefijo')->get();
            $consecutivo = DB::table('consecutivos')->select('incrementable')->get();

            $comprobrante = $prefijo[0]->prefijo.$consecutivo[0]->incrementable;

            // $egreso->comprobante = 
            $egreso = new Egreso( $request->egreso );
            $egreso->comprobante_egreso = $comprobrante;
            $egreso->user_create_id = Auth::user()->id;
            $egreso->user_update_id = Auth::user()->id;
            $egreso->save();

            DB::table('consecutivos')
                ->where('componente','egresos')
                ->update(['incrementable' => $consecutivo[0]->incrementable + 1]);

            DB::commit();

            $res = ['error' => false, 'dat' => $egreso, 'message'=>'egreso creado exitosamente !!!'];
            return response()->json($res);

        } catch(\Exception $e){
            
            DB::rollback();
            
            $res = ['error' => true, 'message'=>$e->getMessage()];
            return response()->json($res);

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
        $egreso     = Egreso::find($id);
        $conceptos  = getEnumValues('egresos','concepto');
        $carteras   = Cartera::all();
        $puntos     = Punto::where('estado','Activo')->orderBy('nombre','asc')->get();

        return view('start.egresos.edit')
            ->with('egreso',$egreso)
            ->with('conceptos',$conceptos)
            ->with('carteras',$carteras)
            ->with('puntos',$puntos);
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
        $rules_egreso = array(
            'fecha'                 => 'required',
            'comprobante_egreso'    => "required|unique:egresos,comprobante_egreso,$id,id",
            'cartera_id'               => 'required',
            'concepto'              => 'required',
            'valor'                 => 'required|numeric',
            'punto_id'              => 'required'
            );
        $rules_message = array(
            'fecha.required'                => 'La Fecha es requerida',
            'comprobante_egreso.required'   => 'El # Comprobande de Egreso es requerido',
            'comprobante_egreso.unique'     => 'El # Comprobante de Egreso ya existe',
            'cartera_id.required'              => 'La Cartera es requerida',
            'concepto.required'             => 'El Concepto es requerido',
            'valor.required'                => 'El Valor es requerido',
            'valor.numeric'                 => 'El Valor debe ser un numero',
            'punto_id.required'             => 'El punto es requerido'
            );

        $this->validate($request,$rules_egreso,$rules_message); 

        $egreso = Egreso::find($id);
        $egreso->fill($request->all());
        $egreso->user_update_id = Auth::user()->id;
        $egreso->save();

        flash()->success($egreso->comprobante_egreso.' -El egreso se edito con éxito!');
        return redirect()->route('start.egresos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $egreso = Egreso::find($id);
        $egreso->delete();
        flash()->error('El Egreso con comprobante '.$egreso->comprobante_egreso. ' se eliminó éxitosamente!');
        return redirect()->route('start.egresos.index');
    }

    public function get_data()
    {
        try {
            $bancos = getEnumValues('facturas', 'banco');
            $proveedores   = Proveedor::where('estado','Activo')->orderBy('nombre')->get();
            $puntos = Punto::where('estado','Activo')->orderBy('nombre')->get();
            $auth = Auth::user();
            $carteras = Cartera::where('estado','Activo')->orderBy('nombre')->get();
            $now = Carbon::now();

            if(auth::user()->rol == 'Administrador')
                $conceptos = getEnumValues('egresos', 'concepto');
            else 
                $conceptos = [
                    'Gastos',
                    'Compras',
                    'Consignacion',
                    'Pago a proveedores'
                ];

            $res = [
                'error' => false,
                'dat'   => [
                    'bancos'        => $bancos,
                    'conceptos'     => $conceptos,
                    'proveedores'   => $proveedores,
                    'puntos'        => $puntos,
                    'auth'          => $auth,
                    'carteras'      => $carteras,
                    'now'           => $now->format('Y-m-d')
                ]
            ];
        }
        catch(\Exception $e){
            $res = [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
        finally {
            return response()->json($res);
        }

    }//.get_data()

    public function get_egresos()
    {
        if(Auth::user()->rol == 'Administrador'){

            $egresos = Egreso::orderBy('updated_at','desc')
                ->with('punto')
                ->with('cartera')
                ->with('proveedor')
                ->paginate($this->paginate);
        } else {
            $egresos = Egreso::where('punto_id',Auth::user()->punto_id)
                ->orderBy('updated_at','desc')
                ->with('punto')
                ->with('cartera')
                ->with('proveedor')
                ->paginate($this->paginate);
        }

        $res = [
            'error' => false, 
            'dat' => $egresos,
            'pagination' => [
                'total'         => $egresos->total(),
                'current_page'  => $egresos->currentPage(),
                'per_page'      => $egresos->perPage(),
                'last_page'     => $egresos->lastPage(), 
                'from'          => $egresos->firstItem(),
                'total'         => $egresos->total(),
                'to'            => $egresos->lastPage()
            ],
        ];

        return response()->json($res);
    }

    public function search($string = null)
    {
        $this->string = $string;
        if(strlen($string) <= 0){
            $egresos = Egreso::where('punto_id',Auth::user()->punto_id)
                ->orderBy('updated_at','desc')
                ->with('punto')
                ->with('cartera')
                ->with('proveedor')
                ->paginate($this->paginate);
        } 
        else {

            $egresos = $this->repo->filter($string, $this->paginate);

            // $egresos = Egreso::find($ids)
            //     ->orderBy('updated_at','desc')
            //     ->with('proveedor')
            //     ->with('cartera')
            //     ->with('punto')
            //     ->paginate($this->paginate);  

            // $egresos = Egreso::where('punto_id',Auth::user()->punto_id)
            //         ->where(function($query){
            //             $query->where('comprobante_egreso','like','%'.$this->string.'%')
            //             ->orWhere('fecha','like','%'.$this->string.'%')
            //             ->orWhere('concepto','like','%'.$this->string.'%');
            //         })
            //     ->orderBy('updated_at','desc')
            //     ->with('punto')
            //     ->with('cartera')
            //     ->with('proveedor')
            //     ->paginate($this->paginate);
    
            if (count($egresos) <= 0 ){
                $egresos = Egreso::orderBy('updated_at','desc')->paginate($this->paginate);
            }
        }

        $res = [
            'error' => false,
            'dat'   => $egresos,
            'pagination' => [
                'total'         => $egresos->total(),
                'current_page'  => $egresos->currentPage(),
                'per_page'      => $egresos->perPage(),
                'last_page'     => $egresos->lastPage(), 
                'from'          => $egresos->firstItem(),
                'total'         => $egresos->total(),
                'to'            => $egresos->lastPage()
            ]
        ];

        return response()->json($res);
        
    }

    public function get_info()
    {
        $now = Carbon::now()->format('Y-m-d');
        $start_week = Carbon::now()->startOfWeek()->format('Y-m-d 00:00:00');
        $end_week   = Carbon::now()->endOfWeek()->format('Y-m-d 11:59:59');
        $start_month = Carbon::now()->format('Y-m-1 00:00:00');
        $month = Carbon::now();
        $end_month = Carbon::now()->format('Y-m-'. $month->daysInMonth. ' 11:59:59');

        $day = Egreso::where('created_at','like',$now.'%')->sum('valor');
        $week = Egreso::whereBetween('created_at',[$start_week,$end_week])->sum('valor');
        $month = Egreso::whereBetween('created_at',[$start_month,$end_month])->sum('valor');
        

        $res = [
            'dat'   => [
                'day' => $day,
                'week' => $week,
                'month' => $month
            ]
        ];

        return response()->json($res);

    }


    public function get_solicitudes()
    {
        $solicitudes = DB::table('precreditos')
            ->leftJoin('creditos','precreditos.id','=','creditos.precredito_id')
            ->join('users','precreditos.user_create_id','=','users.id')
            ->where('users.punto_id',Auth::user()->punto_id)
            ->whereNull('creditos.id')
            ->where('aprobado','si')
            ->get();

        
        dd($solicitudes);
    }
}
