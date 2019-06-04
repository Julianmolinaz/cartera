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
use App\Banco;
use App\User;
use Filter;
use Excel;
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
        //MIDDLEWARE
        if ( Filter::in(['Administrador','Asesor','Asesor VIP','Cartera','Recaudador','Call']) ){
            return Filter::out();
        } 

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
        //MIDDLEWARE
        if ( Filter::in(['Administrador','Asesor','Asesor VIP','Cartera']) ){
            return Filter::out();
        } 

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
        //MIDDLEWARE
        if ( Filter::in(['Administrador','Asesor','Asesor VIP','Cartera']) ){
            return Filter::outJson();
        } 
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
        //MIDDLEWARE
        if ( Filter::in(['Administrador','Asesor','Asesor VIP','Cartera']) ){
            return Filter::out();
        } 
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
        //MIDDLEWARE
        if ( Filter::in(['Administrador','Asesor','Asesor VIP','Cartera']) ){
            return Filter::out();
        } 

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
        //MIDDLEWARE
        if ( Filter::in(['Administrador','Asesor','Asesor VIP','Cartera']) ){
            return Filter::out();
        } 

        try {
            $egreso = Egreso::find($id);
            $now = Carbon::now();

            if (Auth::user()->rol != 'Administrador') {
                if ($now->toDateString() == $egreso->created_at->format('Y-m-d') ) {

                    $egreso->delete();

                    $res = [
                        'error'  => false,
                        'message'=> 'Registro borrado exitosamente' 
                    ];
                } else {
                    $res = [
                        'error'  => true,
                        'message'=> 'No puede borrar el registro' 
                    ];
                }

            } 
            if (Auth::user()->rol == 'Administrador'){

                $egreso->delete();

                $res = [
                    'error'  => false,
                    'message'=> 'Registro borrado exitosamente' 
                ];
            }

        } catch (\Exception $e) {
            $res = [
                'error' => true,
                'message' => $e->getMessage()
            ];
        } finally {
            return response()->json($res);
        }

      
        
    }

    public function get_data()
    {
        try {
            $bancos = Banco::where('estado','Activo')->orderBy('nombre')->get();
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

        if (strlen($string) <= 0) {
            $egresos = Egreso::where('punto_id',Auth::user()->punto_id)
                ->orderBy('updated_at','desc')
                ->with('punto')
                ->with('cartera')
                ->with('proveedor')
                ->paginate($this->paginate);
        } 
        else {

            $egresos = $this->repo->filter($string, $this->paginate);
    
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

    public function report()
    {

        $egresos = DB::table('egresos')
            ->leftJoin('bancos','egresos.banco_id','=','bancos.id')
            ->leftJoin('proveedores','egresos.proveedor_id','=','proveedores.nombre')
            ->join('users as user_create','egresos.user_create_id','=','user_create.id')
            ->join('carteras','egresos.cartera_id','=','carteras.id')
            ->join('puntos','egresos.punto_id','=','puntos.id')
            ->leftJoin('users as user_nomina','egresos.user_nomina_id','=','user_nomina.id')
            ->select('egresos.*',
                     'bancos.nombre as banco',
                     'user_create.name as user_create',
                     'carteras.nombre as cartera',
                     'puntos.nombre as punto',
                     'proveedores.nombre as proveedor',
                     'user_nomina.name as user_nomina')
            ->get();
        
        // Egreso::where('created_at','like','2019%')->get();

        $array_egresos  = [];

        $header = [
                'fecha'              ,'comprobante_egreso',
                'concepto'           ,'tipo',
                'banco'              ,'num_consignacion',
                'valor'              ,'creó',
                'observaciones'      ,'cartera',       
                'punto'              ,'proveedor',     
                'funcionario nomina'   
        ];

        array_push($array_egresos, $header);

        foreach($egresos as $egreso){

            $temp = [
                'fecha'         => $egreso->fecha,
                'comprobante_egreso' => $egreso->comprobante_egreso,
                'concepto'      => $egreso->concepto,
                'tipo'          => $egreso->tipo,
                'banco'         => $egreso->banco,
                'num_consignacion'  =>  $egreso->num_consignacion,
                'valor'         => $egreso->valor,
                'user_create'   => $egreso->user_create,
                'observaciones' => $egreso->observaciones,
                'cartera'       => $egreso->cartera,
                'punto'         => $egreso->punto,
                'proveedor'     => $egreso->proveedor,
                'user_nomina'   => $egreso->user_nomina
            ];

            array_push($array_egresos, $temp);
        }

        Excel::create('report',function($excel) use($array_egresos){
            $excel->sheet('Sheetname',function($sheet)use($array_egresos){
                $sheet->fromArray($array_egresos,null,'A1',false,false);
            });
        })->download('xls');
    }
}
