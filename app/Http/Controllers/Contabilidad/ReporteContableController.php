<?php

namespace App\Http\Controllers\Contabilidad;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes\Contabilidad\Reportes;
use \App\Http\Controllers as ctrl;
use Src\Contabilidad\Reportes as Report;
use Carbon\Carbon;
use Excel;
use File;
use Input;

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
    }


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
        ob_clean();
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

        ob_clean();
        Excel::create('facturas_proveedor ('.$request->daterange.')',
        
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
        $rango = $this->getRango($request->daterange);
        $useCase = new Report\ComprobanteVentasService(
            $rango->ini,
            $rango->end,
            $request->consecutivo
        );
        $useCase->execute(false);
        $data = $useCase->reporte;
        
        $this->validate($request, ['consecutivo' => 'required']);

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
        $useCase = new Report\ComprobanteVentasService(
            $rango->ini,
            $rango->end,
            $request->consecutivo
        );
        $useCase->execute(true);
        $data = $useCase->reporte;

        if (!count($data)) {
            flash()->error('No existen registros para esta busqueda =(');
            return redirect()->back();
        }

        ob_clean();
        Excel::create('facturas_de_venta_'.$request->daterange,
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
        $this->validate($request, ['consecutivo' => 'required']);

        $rango = $this->getRango($request->daterange);

        $useCase = new Report\ComprasService(
            $rango->ini, $rango->end, $request->consecutivo
        );
        $useCase->execute(false);
        $data = $useCase->reporte;

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
        $useCase = new Report\ComprasService(
            $rango->ini, $rango->end, $request->consecutivo
        );
        $useCase->execute(true);
        $data = $useCase->reporte;


        ob_clean();
        Excel::create('compras_'.$request->daterange,
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
        $clientes = $this->load($request);
        $rango = $this->getRango($request->daterange);

        $this->validate($request, ['consecutivo' => 'required']);
        $this->validate($request, ['archivo'=>'file']);

        if ($rango->ini->diffInMonths($rango->end) >= 1) {
            flash()->error('La consulta excede el tamaño permitido, solo se permite el rango de un mes');
            return redirect()->back()
                ->withInput($request->input());
        }

        $repor_caja = new Reportes\ComprobantesDePago(
            $rango->ini, 
            $rango->end, 
            $request->consecutivo, 
            $clientes
        );
        $data = [];
        $data = collect($repor_caja->make(false))->toArray();

        if (!count($data)) {
            flash()->error('No existen registros para esta busqueda =(');
            return redirect()->back()
                ->withInput($request->input());
        }

        return view('contabilidad.reportes.recibos_caja.list')
            ->with('data', $data)
            ->with('rango', $rango);

    }

    public function expRecibosCaja(Request $request)
    {
        $clientes = $this->load($request);
        $rango = $this->getRango($request->daterange);
        
        $this->validate($request, ['consecutivo' => 'required']);
        $this->validate($request, ['archivo'=>'file']);
        
        $repor_caja = new Reportes\ComprobantesDePago(
            $rango->ini, 
            $rango->end, 
            $request->consecutivo, 
            $clientes
        );
        
        $data = [];
        $data = $repor_caja->make(true);

        if (!count($data)) {
            flash()->error('No existen registros para esta busqueda =(');
            return redirect()->back()
                ->withInput($request->input());
        }
        
        ob_clean();
        Excel::create('recibos_de_caja_'.$request->daterange,
            function($excel) use($data){
                $excel->sheet('Sheetname',function($sheet) use($data){
                    
                    $sheet->fromArray($data, null, 'A1', false, false);
                });
            })->download('xls');
    }

    public function load(Request $request)
    {
        try {
            if ($request->hasFile('archivo'))
            {
                $filename = $request->archivo->getClientOriginalName();
                $extension = File::extension($request->archivo->getClientOriginalName());
    
                //  Valid format file
    
                if ($extension != "xlsx" && $extension != "xls" && $extension != "csv") {
                    throw new Exception("Formato inválido.", 500);
                }
              
                $path = $request->archivo->getRealPath();   
                $data = collect(Excel::load($path, function($reader){})->get());
    
                return $data->pluck('clientes')->toArray();
            }
        } catch (\Exception $e) {
            throw new Exception('Error', 500);          
        }
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
                'descripcion' => 'Genera la información necesaria para la creación de clientes',
            ],
            [
                'id' => 'comprobantes_de_pago',
                'name' => 'Recibos de caja',
                'route' => 'contabilidad.reportes.recibos_caja.index',
                'descripcion' => 'Muestra los abonos de las obligaciones relacionas.',   
            ],
            [
                'id' => 'comprobante_ventas',
                'name' => 'Facturas de venta',
                'route' => 'contabilidad.reportes.facturas_venta.index',
                'descripcion' => 'Permite crear la obligación al cliente y el ingreso para la empresa.',
            ],
            [
                'id' => 'compras_soat_rtm',
                'name' => 'Compras',
                'route' => 'contabilidad.reportes.compras.index',
                'descripcion' => 'Genera el costo de la venta (Se utilizan las facturas registradas, una por cada producto de la obligación).',
            ],
            [
                'id' => 'facturas_proveedor',
                'name' => 'Facturas proveedor',
                'route' => 'contabilidad.reportes.facturas_proveedor.index',
                'descripcion' => 'Genera toda la información de la compra del producto, como valor del producto, a quien se factura, fecha de expedición proveedor, etc.',
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
