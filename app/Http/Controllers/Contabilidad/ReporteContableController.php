<?php

namespace App\Http\Controllers\Contabilidad;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes\Contabilidad\Reportes;
use \App\Http\Controllers as ctrl;
use Carbon\Carbon;
use Excel;

class ReporteContableController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('contabilidad.reportes.index')
            ->with('reports', $this->reports());
    }

    public function store(Request $request) 
    {     
        $ini = '';
        $fin = '';

        if ($request->daterange) {
            $ini_temp = substr($request->daterange,0,10);
            $fin_temp = substr($request->daterange,13,22);
            $ini   = Carbon::create(ctrl\ano($ini_temp),ctrl\mes($ini_temp),ctrl\dia($ini_temp),00,00,00);
            $end   = Carbon::create(ctrl\ano($fin_temp),ctrl\mes($fin_temp),ctrl\dia($fin_temp),23,59,59);
        }

        // dd($request->all());

        if ($request->report == 'comprobantes_de_pago') {

            $data = [];
            $repor_caja = new Reportes\ComprobantesDePago($ini, $end);

            
            $data = $repor_caja->make();


            Excel::create('comprobantes_de_pago_cont_'.$request->daterange,
                function($excel) use($data){
                    $excel->sheet('Sheetname',function($sheet) use($data){
                        
                        $sheet->fromArray($data, null, 'A1', false, false);
                    });
                })->download('xls');

        } 
    }

    /**
     * Terceros
     */
    public function getTerceros()
    {
        return view('contabilidad.reportes.terceros.index');
    }


    public function listTerceros(Request $request)
    {
        $rango = $this->getRango($request->daterange);

        $repor_ventas = new Reportes\Terceros($rango->ini, $rango->end);

        $data = collect($repor_ventas->make(false))->toArray();


        if (!count($data)) {
            flash()->error('No existen registros para esta busqueda =(');
            return redirect()->back();
        }

        return view('contabilidad.reportes.terceros.list')
            ->with('data', $data)
            ->with('rango', $rango);
    }


    public function expTerceros(Request $request)
    {
        $rango = $this->getRango($request->daterange);

        $repor_ventas = new Reportes\Terceros($rango->ini, $rango->end);

        $data = $repor_ventas->make(true);

        Excel::create('terceros'.$request->daterange,
            function($excel) use($data){
                $excel->sheet('Sheetname',function($sheet) use($data){
                    
                    $sheet->fromArray($data, null, 'A1', false, false);
                });
            })->download('xls');
    }

    /**
     * Facturas proveedor
     */
    public function getFacturasProveedor()
    {
        return view('contabilidad.reportes.facturas_proveedor.index');
    }

    public function listFacturasProveedor(Request $request)
    {
        $rango = $this->getRango($request->daterange);

        $repor_facturas_proveedor = Reportes\FacturasProveedor::getFacturas($rango->ini, $rango->end);
          
            return view('contabilidad/reportes/facturas_proveedor/list')
                ->with('facturas',$repor_facturas_proveedor)
                ->with('rango',$rango);
    }

    public function expFacturasProveedor(Request $request)
    {
        $rango = $this->getRango($request->daterange);
        $data_ = Reportes\FacturasProveedor::getFacturas($rango->ini, $rango->end);
        $header = Reportes\FacturasProveedor::header();
        $data = [];

        $data[] = $header;

        foreach($data_ as $item) {
            $data[] = collect($item)->toArray();
        }
          
        Excel::create('facturas_proveedor'.$request->daterange,
        
            function($excel) use($data){
                
                $excel->sheet('Sheetname',function($sheet) use($data){
                    $sheet->fromArray($data, null, 'A1', false, false);
                });
            })->download('xls');
            
    }


    /**
     * Ventas
     */

    public function getFacturasVenta()
    {
        return view('contabilidad.reportes.facturas_venta.index');
    }

    public function listFacturasVenta(Request $request)
    {
        // $this->validate($request, ['consecutivo' => 'required']);

        $rango = $this->getRango($request->daterange);
        $repor_ventas = new Reportes\ComprobanteVentas($rango->ini, $rango->end,$request->consecutivo);
        $data = collect($repor_ventas->make(false))->toArray();
        

        if (!count($data)) {
            flash()->error('No existen registros para esta busqueda =(');
            return redirect()->back();
        }

        return view('contabilidad.reportes.facturas_venta.list')
            ->with('data', $data)
            ->with('rango', $rango);
    }

    public function expFacturasVenta(Request $request)
    {
        $this->validate($request, ['consecutivo' => 'required']);

        $rango = $this->getRango($request->daterange);

        $repor_ventas = new Reportes\ComprobanteVentas($rango->ini, $rango->end, $request->consecutivo);

        $data = $repor_ventas->make(true);

            if (!count($data)) {
            flash()->error('No existen registros para esta busqueda =(');
            return redirect()->back();
        }

            Excel::create('comprobante_ventas'.$request->daterange,
                function($excel) use($data){
                    $excel->sheet('Sheetname',function($sheet) use($data){
                        
                        $sheet->fromArray($data, null, 'A1', false, false);
                    });
                })->download('xls');
    }

    /**
     * Compras
     */

    public function getCompras()
    {
        return view('contabilidad.reportes.compras.index');
    }

    public function listCompras(Request $request)
    {
        dd($request->clientes);
        $this->validate($request, ['consecutivo' => 'required']);
        $this->validate($request, ['clientes' => 'required']);

        $rango = $this->getRango($request->daterange);
        $repor_compras = new Reportes\ComprasRtmSoat($rango->ini, $rango->end, $request->consecutivo);
        $data = collect($repor_compras->make(false))->toArray();

        if (!count($data)) {
            flash()->error('No existen registros para esta busqueda =(');
            return redirect()->back();
        }

        return view('contabilidad.reportes.compras.list')
            ->with('data', $data)
            ->with('rango', $rango);
    }

    public function expCompras(Request $request)
    {
        $this->validate($request, ['consecutivo' => 'required']);

        $rango = $this->getRango($request->daterange);

        $repor_compras = new Reportes\ComprasRtmSoat($rango->ini, $rango->end, $request->consecutivo);

        $data = $repor_compras->make(true);

            Excel::create('compras_soat_rtm'.$request->daterange,
                function($excel) use($data){
                    $excel->sheet('Sheetname',function($sheet) use($data){
                        
                        $sheet->fromArray($data, null, 'A1', false, false);
                    });
                })->download('xls');
    }
    
    /**
     * Recibos de Caja
     */
    public function getRecibosCaja()
    {
        return view('contabilidad.reportes.recibos_caja.index');
    }

    public function listRecibosCaja(Request $request)
    {
        $this->validate($request, ['consecutivo' => 'required']);

        $rango = $this->getRango($request->daterange);
        $repor_caja = new Reportes\ComprobantesDePago($rango->ini, $rango->end, $request->consecutivo, $request->clientes);
        $data = [];
        $data = collect($repor_caja->make(false))->toArray();

        if (!count($data)) {
            flash()->error('No existen registros para esta busqueda =(');
            return redirect()->back();
        }

        return view('contabilidad.reportes.compras.list')
            ->with('data', $data)
            ->with('rango', $rango);
    }

    public function expRecibosCaja(Request $request)
    {
        $this->validate($request, ['consecutivo' => 'required']);

        $rango = $this->getRango($request->daterange);
        $data = [];

        $repor_caja = new Reportes\ComprobantesDePago(
            $rango->ini, 
            $rango->end, 
            $request->consecutivo,
            []
        );

        $data = $repor_caja->make(true);
        
        Excel::create('comprobantes_de_pago_cont_'.$request->daterange,
            function($excel) use($data){
                $excel->sheet('Sheetname',function($sheet) use($data){
                    
                    $sheet->fromArray($data, null, 'A1', false, false);
                });
            })->download('xls');
    }

    /**
     * Reportes
     */
    public function reports()
    {
        return [
            [
                'id' => 'terceros',
                'name' => 'Terceros',
                'route' => 'contabilidad.reportes.terceros.index',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis eros in urna vulputate gravida tristique id nisi. Maecenas mollis lorem id efficitur consectetur. In faucibus nulla sed nisl cursus.',
            ],
            [
                'id' => 'comprobantes_de_pago',
                'name' => 'Recibos de caja',
                'route' => 'contabilidad.reportes.recibos_caja.index',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis eros in urna vulputate gravida tristique id nisi. Maecenas mollis lorem id efficitur consectetur. In faucibus nulla sed nisl cursus.',   
            ],
            [
                'id' => 'comprobante_ventas',
                'name' => 'Facturas de venta',
                'route' => 'contabilidad.reportes.facturas_venta.index',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis eros in urna vulputate gravida tristique id nisi. Maecenas mollis lorem id efficitur consectetur. In faucibus nulla sed nisl cursus.',
            ],
            [
                'id' => 'compras_soat_rtm',
                'name' => 'Compras',
                'route' => 'contabilidad.reportes.compras.index',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis eros in urna vulputate gravida tristique id nisi. Maecenas mollis lorem id efficitur consectetur. In faucibus nulla sed nisl cursus.',
            ],
            [
                'id' => 'facturas_proveedor',
                'name' => 'Facturas proveedor',
                'route' => 'contabilidad.reportes.facturas_proveedor.index',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis eros in urna vulputate gravida tristique id nisi. Maecenas mollis lorem id efficitur consectetur. In faucibus nulla sed nisl cursus.',
            ],

        ];
    }

    
    public function getRango($rango)
    {
        $ini = '';
        $fin = '';

        if ($rango) {
            $ini_temp = substr($rango,0,10);
            $fin_temp = substr($rango,13,22);
            $ini   = Carbon::create(ctrl\ano($ini_temp),ctrl\mes($ini_temp),ctrl\dia($ini_temp),00,00,00);
            $end   = Carbon::create(ctrl\ano($fin_temp),ctrl\mes($fin_temp),ctrl\dia($fin_temp),23,59,59);

            return (Object) [
                'ini' => $ini,
                'end' => $end
            ];
        }

        throw new Exception("No se encuentra un rango válido =(", 500);
        
    }

}
