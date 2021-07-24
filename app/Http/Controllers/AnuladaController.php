<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Factura;
use App\Anulada;
use App\Credito;
use App\Sancion;
use App\FechaCobro;
use App\Pago;
use App\Extra;
use Auth;
use DB;

class AnuladaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*
    |--------------------------------------------------------------------------
    | index
    |--------------------------------------------------------------------------
    | 
    | Retorna un listado de todas las facturas anuladas
    | 
    |
    */

    public function index()
    {
        $anuladas = Anulada::paginate(100);
        return view('start.facturas.index_anuladas')
            ->with('anuladas',$anuladas);
    }


    public function create(){}


    /*
    |--------------------------------------------------------------------------
    | store
    |--------------------------------------------------------------------------
    | 
    | Recibe el request con la info de la factura a eliminar
    | Retorna un mensaje si la factura se eliminó con exito 
    |  de lo contrario mostrará un mensaje de error
    |
    */

    public function store(Request $request)
    {

        $rules = ['motivo_anulacion' => 'required'];
        $messages = ['motivo_anulacion.required' => 'El Motivo de la anulación de la factura número '.$request->input('num_factura').' es requerido'];

        $this->validate($request, $rules, $messages);
            
        $id         = $request->input('factura_id');
        $factura    = Factura::find($id);
        $credito    = Credito::find($factura->credito_id);
        $flat_cta_parcial = false;

        //Consulta la ultima factura de ese credito
        $ultima_factura = DB::table('facturas')
            ->where('credito_id',$factura->credito_id)
            ->orderBy('id','desc')
            ->first();

        DB::beginTransaction();
          
        try {  

            // se valida si la factura a eliminar es la ultima realizada para ese crédito  
            if ( $ultima_factura->id == $factura->id ) {

                $anulada                    = new Anulada();
                $anulada->cliente_id        = $factura->credito->precredito->cliente->id;
                $anulada->factura_id        = $factura->id;
                $anulada->precredito_id     = $factura->credito->precredito->id;
                $anulada->credito_id        = $factura->credito_id;
                $anulada->num_fact          = $factura->num_fact;
                $anulada->fecha             = $factura->fecha;
                $anulada->total             = $factura->total;
                $anulada->pagos             = "";
                $anulada->motivo_anulacion  = $request->input('motivo_anulacion');
                $anulada->user_anula        = Auth::user()->id;
                $anulada->user_create_id    = $factura->user_create_id;

                // dd(strtolower($factura->pagos[2]->concepto) == 'saldo a favor');

                //loop que itera sobre los pagos de una factura

                foreach ($factura->pagos as $pago) {

                    //se crea string con toda la informacion de los pagos que se guardarán en la tabla anuladas.pagos
                    
                    $detalle_del_pago = '[ ID='.$pago->id.',CONCEPTO='.$pago->concepto.',ABONO='.$pago->abono.',DEBE='.$pago->debe.',ESTADO='.$pago->estado.',DESDE='.$pago->pago_desde.',HASTA='.$pago->pago_hasta.',ABONO PAGO ID='.$pago->abono_pago_id.']';

                    $anulada->pagos = $anulada->pagos.$detalle_del_pago;

                    //PAGO POR CUOTA PARCIAL

                    if ($pago->concepto == 'Cuota Parcial') {

                        $credito->saldo = $credito->saldo + $pago->abono;

                        if($pago->estado ==  'Ok') $credito->cuotas_faltantes = $credito->cuotas_faltantes + 1;

                        //SI EL PAGO TIENE REFERENCIA OTRO PAGO, PARA ÉL EL ESTADO DEBE CAMBIAR A DEBE
                    
                        if ($pago->abono_pago_id > 0) {

                            $pago_anterior          = Pago::find($pago->abono_pago_id);
                            $pago_anterior->estado  = 'Debe';
                            $pago_anterior->save();
                        }
                    } 

                    //PAGO POR CUOTA

                    else if ($pago->concepto == 'Cuota') {
                        $credito->saldo = $credito->saldo + $pago->abono; 

                        if ($pago->estado ==  'Ok') {   
                            $cuotas_que_faltan = $credito->cuotas_faltantes;
                            $credito->cuotas_faltantes = $cuotas_que_faltan + (int)($pago->abono / $credito->precredito->vlr_cuota);  
                        }
                    }

                    //PAGO POR MORA

                    else if ($pago->concepto == 'Mora') {

                        $moras_diarias = DB::table('sanciones')->where('pago_id',$pago->id)->get();

                        foreach($moras_diarias as $mora){

                            $mora_a_modificar = Sancion::find($mora->id);
                            $mora_a_modificar->estado = 'Debe';
                            $mora_a_modificar->pago_id = NULL; // se borrra la referencia del pago_id
                            $credito->saldo = $credito->saldo + $mora->valor;
                            $mora_a_modificar->save();
                        }

                    }
                
                    //PAGO POR PREJURIDICO

                    else if ($pago->concepto == 'Juridico' || $pago->concepto == 'Prejuridico') {
                    
                        $cadena = $pago->abono_pago_id;
                        $multa_id = "";
                        $bandera = 0;

                        for ($i = 0; $i < strlen($cadena); $i++) {

                            if ($cadena[$i] == '.' || $bandera == 1) {
                                
                                if($bandera==0){$i = $i+2;}
                                $multa_id .= $cadena[$i];
                                $bandera = 1;
                            }
                        }

                        $multas_vigentes = DB::table('extras')->where([['credito_id','=',$credito->id],['estado','=','Debe']])->get();

                        // trae el pago anterior para cambiarlo de estado ok a debe    
                        $pago_a_modificar_id  = ""; 

                        for ($i = 1; $i < strlen($cadena); $i++) {
                            if ($cadena[$i] == '.') $i = strlen($cadena);
                            else $pago_a_modificar_id = $pago_a_modificar_id.$cadena[$i];
                        }    
                    
                        //si existen multas vigentes     

                        if (count($multas_vigentes) > 0) {
                            
                            if ($multas_vigentes[0]->id == $multa_id) {

                                $credito->saldo = $credito->saldo + $pago->abono;

                                $pago_a_modificar = Pago::find($pago_a_modificar_id);

                                if ($pago_a_modificar != null) {
                                    $pago_a_modificar->estado = 'Debe';
                                    $pago_a_modificar->save();
                                }
                            } 
                            //si hay una multa vigente diferente a la referencia del pago
                            else {

                                DB::rollback();
                                flash()->error('Exíste una multa en "Debe" diferente de la que se quiere anular, se recomienda saldar la multa en "Debe" temporalmente para poder hacer la transacción de anulación deseada.');
                                return redirect()->route('start.facturas.index');                            
                            }
                        } 

                        //si no existen multas vigentes
                        else {
                            $credito->saldo = $credito->saldo + $pago->abono;
                            $credito->save();

                            $pago_a_modificar = Pago::find($pago_a_modificar_id);

                            if($pago_a_modificar != null){
                                $pago_a_modificar->estado = 'Debe';
                                $pago_a_modificar->save();
                            }
                            $multa = Extra::find($multa_id);
                            $multa->estado = 'Debe';
                            $multa->save();
                        }

                    }//end else if juridico
                    
                    //PAGO POR SALDO A FAVOR
                    else if ($pago->concepto == 'Saldo a Favor') {
                        $credito->saldo_favor -= $pago->abono;
                        $credito->save();
                    }

                
                $pago->delete();
            }//end foreach
            
            $credito->save();
            $anulada->pagos = $anulada->pagos.' ** Factura creada: '.$factura->created_at.' por '.$factura->user_create->name.' **';
            $anulada->save();
            $factura->delete();

            log(Auth::user()->id,'eliminar',"Se anula recibo {$anulada->num_fact}",0,'App\\Anulada',$anulada->id);

            //busca la ultima factura vigente

            $ultima_factura = DB::table('facturas')
                ->where('credito_id',$factura->credito_id)
                ->orderBy('created_at','desc')
                ->first();

            /**
             * al anular la ultima factura se debe modificar tambien la fecha de pago en la tabla fecha_cobros.
             * fecha_pago esta se fecha se extrae de la ultima factura vigente. 
             */
            

            if ($ultima_factura) {

                $fecha_cobro = FechaCobro::where('credito_id',$credito->id)->get();
                $fecha_cobro[0]->fecha_pago = $ultima_factura->fecha_proximo_pago;
                $fecha_cobro[0]->save();

            } else{

                // se genera la fecha limite del primer pago del crédito.

                $fecha_pago = calcularFecha($credito->precredito->fecha,$credito->precredito->periodo, 1, $credito->precredito->p_fecha, $credito->precredito->s_fecha, true);

                $fecha_cobro = FechaCobro::where('credito_id',$credito->id)->get();
                $fecha_cobro[0]->fecha_pago = inv_fech($fecha_pago['fecha_ini']);
                $fecha_cobro[0]->save();
            }

            DB::commit();
            flash()->success('Se eliminó la factura número '.$factura->num_fact.' con Éxito!!!!, *** consulte facturas anuladas en el menu "Pagos" para verificar la anulación ***');
            return redirect()->route('start.facturas.index');

          } //END DEL IF PRINCIPAL

          else {
            
            flash()->error('No se puede eliminar la factura con numero: '.$factura->num_fact.', recuerde que puede eliminar en orden descendente de la mas actual a la mas antigua. Gracias!!!');
            return redirect()->route('start.facturas.index');
          }  
      }//END DEL TRY
      catch(\Exception $e){
            DB::rollback();
            flash()->error('ERROR'.$e->getMessage());
            return redirect()->route('start.facturas.index');
      }

    }



}
