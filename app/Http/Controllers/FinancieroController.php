<?php

namespace App\Http\Controllers;

use App\Repositories\EgresosRepository;
use App\Traits\DetalleClientesTrait;
use App\Traits\Financierotrait;
use Illuminate\Http\Request;
use App\Traits\EgresoTrait;
use App\Http\Requests;
use Carbon\Carbon;
use App\Credito;
use App\Punto;
use Excel;

class FinancieroController extends Controller
{
    use Financierotrait, EgresoTrait, DetalleClientesTrait;

    public function __construct(EgresosRepository $egresos_repo)
    {
        $this->middleware('auth');
        $this->egresos_repo = $egresos_repo;
    }

    public function index()
    {
        $sucursales = Punto::orderBy('nombre')->get();
        $anios = array();
        $now = Carbon::now();

        for ($i=$now->year; $i >= 2017  ; $i--) { 
            array_push($anios, $i);
        }

        return view('admin.reportes.financiero.index')
            ->with('sucursales',$sucursales)
            ->with('anios',$anios);
    }

    public function general($rango)
    {
        try{
            $f = $this->generar_fechas($rango);
          
            $data = $this->financiero($f['ini'], $f['fin']);

            if($data['info'] == '0 creditos') {
                flash()->error('No hay créditos en este periodo');
                return redirect()->route('reporte.financiero');
            }
    
            return view('admin.reportes.financiero.financiero_operativo')
                ->with('rango',$f['rango'])
                ->with('info', $data['info'])
                ->with('total_egresos', $data['total_egresos'])
                ->with('egresos_por_concepto', $data['egresos_por_concepto'])
                ->with('iniciales',$data['iniciales'])
                ->with('estudios', $data['estudios'])
                ->with('sucursal',null);

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }


    public function financiero_sucursales($rango,$sucursal_id)
    {
        $f = $this->generar_fechas($rango);

        if($sucursal_id == -1 )
        {
            $sucursales = Punto::all();
            $array = [];
            
            foreach ($sucursales as $sucursal) 
            {
                $resp = $this->financiero_por_sucursales($f['ini'], $f['fin'], $sucursal->id);
                $total_egresos = $this->egresos_repo->get_egresos_punto($f['ini'], $f['fin'], $sucursal->id);

                if( $resp != '0 creditos'){
                    $temp =  [ 
                        'info'           => $resp,
                        'num_creditos'   => $resp['num_creditos'], 
                        'total_egresos'  => $total_egresos,
                        'sucursal'       => $sucursal
                    ];
                    array_push($array, $temp);
                }
            }   

            $array = collect($array)->sortByDesc('num_creditos');

            return view('admin.reportes.financiero.sucursales.index')
                ->with('sucursales', $array)
                ->with('rango',$f['rango']);
        }
        else
        {
            $sucursal = Punto::find($sucursal_id);

            $data = $this->financiero_sucursal($f['ini'], $f['fin'],$sucursal_id);

            if($data['info'] == '0 creditos') {
                flash()->error('No hay créditos en este periodo');
                return redirect()->route('reporte.financiero');
            }

            return view('admin.reportes.financiero.financiero_operativo')
                ->with('rango',$f['rango'])
                ->with('info', $data['info'])
                ->with('total_egresos', $data['total_egresos'])
                ->with('egresos_por_concepto', $data['egresos_por_concepto'])
                ->with('sucursal',$sucursal->nombre);
        }
        
    }

    public function generar_fechas($rango)
    {
        $fecha_1 = substr($rango,0,10);
        $fecha_2 = substr($rango,13,22);
        $ini     = Carbon::create(ano($fecha_1),mes($fecha_1),dia($fecha_1),00,00,00);
        $fin     = Carbon::create(ano($fecha_2),mes($fecha_2),dia($fecha_2),23,59,59);
        $rango   = array('ini' => $ini->format('d-m-Y'), 'fin' => $fin->format('d-m-Y')); 

        return [
            'ini'   => $ini,
            'fin'   => $fin,
            'rango' => $rango
        ];
    }

    public function financiero_comparativo($year)
    {
        $quarts     = $this->quarts($year);
        $sucursales = Punto::all();
        $trimestres = [];

        foreach($quarts as $quart)
        {
            $array = [];
            $total_creditos = 0;

            $empresa = $this->financiero($quart['ini'],$quart['fin']);

            foreach ($sucursales as $sucursal) 
            {
                $res = $this->financiero_por_sucursales($quart['ini'], $quart['fin'], $sucursal->id); 

                if($res == "0 creditos"){
                    // flash()->error('No hay creditos en el rango');
                    // return redirect()->route('reporte.financiero');
                }
                else{
                    $financiero_sucursal = $res;
                    $num_creditos        = $financiero_sucursal['num_creditos'];
                    $total_creditos      += $num_creditos;

                    $temp =  [ 
                               'info'           => $financiero_sucursal,
                               'num_creditos'   => $num_creditos, 
                               'sucursal'       => $sucursal 
                           ];
                    array_push($array, $temp);
                }
            }


            $array = collect($array)->sortByDesc('num_creditos');
            array_push($trimestres, 
                [ 'data'            => $array, //info financiero de las sucursales
                  'total_creditos'  => $total_creditos,
                  'empresa'         => $empresa
                ]);   
            //dd($trimestres);            
        }

        return view('admin.reportes.financiero.sucursales.comparativa_tipos')
            ->with('quarts',$trimestres)
            ->with('year',$year);

    }

    public function detalle(Request $request)
    {
        $fecha              = Carbon::now()->toDateTimeString();
        $ids                = explode( ',', str_replace(']', "",str_replace('[', "", $request->data)) );
        $creditos           = Credito::find($ids);
        $arreglo_creditos   = [];

        $header = [
            'credito',
            'creado',
            'cliente',
            'documento',
            'celular',
            'telefono',
            'tipo_actividad',
            'ocupacion',
            'empresa',
            'numero_creditos',
            'producto',
            'vlr_financiar',
            'periodo',
            'plazo',
            'punto'
        ];

        array_push($arreglo_creditos, $header);

        foreach ($creditos as $credito) {
            $temp = [
                'credito'   => $credito->id,
                'crecion'   => $credito->created_at,
                'cliente'   => $credito->precredito->cliente->nombre,
                'documento' => $credito->precredito->cliente->num_doc,
                'celular'   => $credito->precredito->cliente->movil,
                'telefono'  => $credito->precredito->cliente->telefono,
                'tipo_actividad' => $credito->precredito->cliente->tipo_actividad,
                'cupacion'  => $credito->precredito->cliente->ocupacion,
                'empresa'   => $credito->precredito->cliente->empresa,
                'num_creditos' => $credito->precredito->cliente->numero_de_creditos,
                'producto'  => $credito->precredito->producto->nombre,
                'vlr_fin'   => $credito->precredito->vlr_fin,
                'periodo'   => $credito->precredito->periodo,   
                'plazo'     => $credito->precredito->cuotas,
                'punto'     => $credito->precredito->user_create->punto->nombre
            ];

            array_push($arreglo_creditos, $temp);
        }
        ob_clean();
        Excel::create($request->tipo.'-'.$fecha,function($excel) use ($arreglo_creditos){
            
            $excel->sheet('Sheetname',function($sheet) use ($arreglo_creditos){       
                
            $sheet->fromArray($arreglo_creditos,null,'A1',false,false);
            });
        })->download('xls');

    }
}
