<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Traits\MorososTrait;
use App\Traits\Cartera\ReportCarteraTrait;
use App\Traits\Cartera\StructTrait;
use App\Http\Requests;
use App\Cartera;
use Filter;
use DB;

class GestionCarteraController extends Controller
{
    use MorososTrait;
    use StructTrait;
    use ReportCarteraTrait;
    protected $struct;
    protected $report = [];

    public function __construct()
    {
        $this->middleware('auth');
        $this->struct = $this->getStructTr();
    }

    /**
     * Muestra la vista principal de los
     * reportes de cartera
     */

    public function index()
    {
        //MIDDLEWARE
        if ( Filter::in(['Administrador']) ){
            return Filter::out();
        } 
        return view('admin.gestion_cartera.index');
    }

    /**
     * Muestra el reporte de cartera con la opcion de 
     * seleccionar la cartera
     */

    public function getInfoCarteras()
    {
        return view('admin.gestion_cartera.info_carteras.index');
    }

    public function getCartera($carteraId)
    {  
        //MIDDLEWARE
        if ( Filter::in(['Administrador']) ){
            return Filter::outJson();
        }  
          
        try {     
            $cartera = Cartera::find($carteraId);

            //prepara la estructura del reporte
            $this->setStructTr($cartera);

            //se genera el reporte por tipo moroso
            $this->analizarCartera($carteraId);

            $res = ['error' => false, 'dat' => $this->report];
        }
        catch (\Exception $e) {
            $res = ['error' => true, 'message' => $e->getMessage()];
        }
        finally {
            return response()->json($res);
        }
    }

    public function analizarCartera($carteraId)
    {
        $creditos = DB::table('creditos')
            ->join('precreditos','creditos.precredito_id','=','precreditos.id')
            ->join('users','precreditos.user_create_id','=','users.id')
            ->where('precreditos.cartera_id',$carteraId)
            ->whereIn('creditos.estado',['Al dia','Mora','Prejuridico','Juridico'])
            ->select('creditos.*',
                        'precreditos.*',
                        'creditos.id as credito_id',
                        'precreditos.id as precredito_id',
                        'users.punto_id as punto_id')
            ->get();

        foreach($creditos as $credito){
            $this->agregarSaldoTr($credito);
        }

        $this->totalizarPorPuntoTr();

        $this->generarIndicadoresTr();

        $this->totalizarTodaLaCarteraTr();
    }


    public function getPuntos()
    {
        //MIDDLEWARE
        if ( Filter::in(['Administrador']) ){
            return Filter::out();
        }  
        $this->setPuntosStructTr();

        $creditos = DB::table('creditos')
            ->join('precreditos','creditos.precredito_id','=','precreditos.id')
            ->join('users','precreditos.user_create_id','=','users.id')
            ->whereIn('creditos.estado',['Al dia','Mora','Prejuridico','Juridico'])
            ->select('creditos.*',
                        'precreditos.*',
                        'creditos.id as credito_id',
                        'precreditos.id as precredito_id',
                        'users.punto_id as punto_id')
            ->get();

        foreach($creditos as $credito){
            $this->agregarSaldoTr($credito);
        }

        $this->totalizarPorPuntoTr();

        $this->generarIndicadoresTr();

        $this->totalizarTodaLaCarteraTr();

        return view('admin.gestion_cartera.info_puntos.index')
            ->with('report',$this->report);
    }


}
