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
    protected $fecha_final;
    protected $fecha_inicial;
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
            $this->fecha_inicial = new Carbon($request->fecha_inicial);
            $this->fecha_final   = new Carbon($request->fecha_final);

            $ids_carteras = $this->getCarterasChecked($request->carteras);

            $creditos = $this->credRepo->activos($ids_carteras, $this->fecha_inicial, $this->fecha_final);
//*** */
            foreach ( $creditos as $credito) {
                $this->credito = $credito;
                $this->calcularRecaudo();
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

    public function calcularRecaudo()
    {
        try{
            $jocker     = true; // false cuando la fecha este fuera del rango
            $cts_faltantes  = $this->credito->cts_faltantes; // cuotas faltantes del credito
            $orden      = false; // true para primera fecha, false para segunda fecha (N/A para pago mensual)
            $day        = ''; // toma el valor del día de pago
            $modelo     = 1; // impar para cambio de mes
            $contador   = 1; 
            $now        = Carbon::now(); 
            $date       = new Carbon($this->credito->proxima_f_pago);

            $this->sanciones += $this->credito->sanciones * Variable::find(1)->vlr_dia_sancion;

            if ($date->day == $this->credito->p_fecha && $this->credito->periodo == 'Quincenal') {
                $orden = false;
            } else {
                $orden = true;
                $contador = 2;
            }

            while ($cts_faltantes > 0 && $jocker && $contador < 1000) 
            {
                if ($this->credito->periodo == 'Quincenal') {
                    $orden = ! $orden;
                    $modelo = 2;
                } else {
                    $orden = true;
                    $modelo = 1;
                }

                $day = $this->generar_dia($orden, $date);

                $date->day($day);

                \Log::info($date);

                if ( $date->gte($now) ) {
                    if ( $date->lt($this->fecha_inicial) ) {
                        $cts_faltantes --;
                    } else {
                        if ( $date->lte($this->fecha_final) ){
                            $this->sumar();
                            $cts_faltantes --;
                        } else {
                            $jocker = false;
                        }
                    }
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

    public function sumar()
    {
        if ($this->credito->estado == 'Al dia') {
            $this->sumatoria_minima += $this->credito->cuota;
        } else if($this->credito->estado == 'Mora') {
            $this->sumatoria_media += $this->credito->cuota;
        } else {
            $this->sumatoria_maxima += $this->credito->cuota;
        }
    }

    public function generar_dia($orden, $date)
    {
        $day = '';
        if ($orden) {
            $day = $this->credito->p_fecha;
        } else {
            $day = $this->credito->s_fecha;
        }
        if ($date->month == 2 && ($day == 29 || $day == 30)){
            $day = 28;
        } 

        return $day;
    }
}
