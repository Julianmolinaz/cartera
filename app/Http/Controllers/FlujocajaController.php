<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\CreditoRepository;
use App\Http\Requests;
use Carbon\Carbon;
use App\Negocio;
use App\Cartera;
use App\Credito;
use App\Variable;
use DB;

class FlujocajaController extends Controller
{
    protected $credRepo;
    protected $sumatoria_minima;
    protected $sumatoria_media;
    protected $sumatoria_maxima;
    protected $fecha;
    protected $sanciones;

    public function __construct(CreditoRepository $creditos)
    {
      $this->credRepo = $creditos;
      $this->middleware('auth');
      $this->sumatoria_minima = 0.0;
      $this->sumatoria_media  = 0.0;
      $this->sumatoria_maxima = 0.0;
      $this->sanciones = 0.0;
    }


    public function index()
    {
        return view('admin.gestion_cartera.flujo_de_caja.index');
    }

    public function getDataFlujo()
    {
        $negocios = Negocio::all();
        $negocios->map( function($negocio){
            $negocio->carteras;
        });

        $carteras = Cartera::orderBy('nombre')->get();
        $carteras->map( function($cartera){
            $cartera->checked = false;
        });

        return response()->json([
            'success' => true,
            'message' => 'Transaction successfully',
            'dat'     => [
                'negocios' => $negocios,
                'carteras' => $carteras
            ]
        ]);
    }

    public function getFlujoDeCaja(Request $request)
    {
        try {

            $this->fecha = new Carbon($request->fecha);
            $ids_carteras = $this->getCarterasChecked($request->carteras);

            $creditos = $this->credRepo->activos($ids_carteras, $this->fecha);
     
            \Log::info($creditos);
            foreach ( $creditos as $credito) {
                $this->calcularRecaudo($credito);
            }

            return response()->json([
                'success' => true,
                'message' => 'ok',
                'dat'     => [
                    'minimo' => $this->sumatoria_minima,
                    'medio'  => $this->sumatoria_media,
                    'maximo' => $this->sumatoria_maxima,
                    'sanciones' => $this->sanciones
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ],400);
        }
    }

    public function calcularRecaudo($credito)
    {

        try{
            $jocker = true;
            $cts_faltantes = $credito->cts_faltantes;
            $orden = false;
            $now = Carbon::now();
            $day = '';
            $modelo = 1;
            $contador = 1;
            $month = $now->month;
            $year = $now->year;
            $date = Carbon::create($year, $month, $credito->p_fecha,23, 59, 00);

            $this->sanciones += $credito->sanciones * Variable::find(1)->vlr_dia_sancion;

            while ($cts_faltantes > 0 && $jocker) {

                if ($credito->periodo == 'Quincenal') {
                    $orden = ! $orden;
                    $modelo = 2;
                } else {
                    $orden = true;
                }

                if ($orden) {
                    $day = $credito->p_fecha;
                } else {
                    $day = $credito->s_fecha;
                }
                $date->day($day);

                \Log::info($date);

                if ($date->gte($now) && $date->lte($this->fecha)) {
                    if ($credito->estado == 'Al dia') {
                        $this->sumatoria_minima += $credito->cuota;
                    } else if($credito->estado == 'Mora') {
                        $this->sumatoria_media += $credito->cuota;
                    }
                    else {
                        $this->sumatoria_maxima += $credito->cuota;
                    }
                    $cts_faltantes --;
                } else if($date->gt($this->fecha)){
                    $jocker = false;
                }  

                if (! ($contador % $modelo) ) {
                    $date->addMonth(1);
                } 

                $contador ++;

            }


        } catch (\Exception $e){
            \Log::info($e);
            return $e->getMessage();
        }

    }

    public function getCarterasChecked($carteras)
    {
        $ids = [];

        foreach ($carteras as $cartera) {
            if ($cartera['checked']) {
                array_push($ids, $cartera['id']);
            }
        }
        
        return $ids;
    }
}
