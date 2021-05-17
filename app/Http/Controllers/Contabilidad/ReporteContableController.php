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

        } else if ($request->report == 'compras_soat_rtm') {

            $this->validate($request, ['consecutivo' => 'required']);

            $repor_compras = new Reportes\ComprasRtmSoat($ini, $end, $request->consecutivo);

            $data = $repor_compras->make();

            Excel::create('compras_soat_rtm'.$request->daterange,
                function($excel) use($data){
                    $excel->sheet('Sheetname',function($sheet) use($data){
                        
                        $sheet->fromArray($data, null, 'A1', false, false);
                    });
                })->download('xls');

        } else if ($request->report == 'comprobante_ventas') {

            $this->validate($request, ['consecutivo' => 'required']);

            $repor_ventas = new Reportes\ComprobanteVentas($ini, $end, $request->consecutivo);

            $data = $repor_ventas->make();

            Excel::create('comprobante_ventas'.$request->daterange,
                function($excel) use($data){
                    $excel->sheet('Sheetname',function($sheet) use($data){
                        
                        $sheet->fromArray($data, null, 'A1', false, false);
                    });
                })->download('xls');
        } else if ($request->report == 'facturas_proveedor') {

            $repor_facturas_proveedor = Reportes\FacturasProveedor::getFacturas($ini, $end);
          
            return view('contabilidad/reportes/factura_proveedor')
                ->with('facturas',$repor_facturas_proveedor)
                ->with('rango',['ini'=>$ini,'end'=>$end]);

        } else if ($request->report == 'terceros') {

            $repor_ventas = new Reportes\Terceros($ini, $end);

            $data = $repor_ventas->make();

            Excel::create('terceros'.$request->daterange,
                function($excel) use($data){
                    $excel->sheet('Sheetname',function($sheet) use($data){
                        
                        $sheet->fromArray($data, null, 'A1', false, false);
                    });
                })->download('xls');
        }    
    }

    public function getTerceros()
    {
        return view('contabilidad.reportes.terceros.index');
    }

    public function getRecibosCaja()
    {
        return view('contabilidad.reportes.recibos_caja.index');
    }

    public function getFacturasVenta()
    {
        return view('contabilidad.reportes.facturas_venta.index');
    }

    public function getCompras()
    {
        return view('contabilidad.reportes.compras.index');
    }
    
    public function getFacturasProveedor()
    {
        return view('contabilidad.reportes.facturas_proveedor.index');
    }

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

    
}
