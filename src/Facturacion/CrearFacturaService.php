<?php

namespace Src\Facturacion;

use Src\Facturacion\ValidacionFacturaService;

use App\Repositories as Repo;
use DB;

class CrearFacturaService
{
    public $factura;

    public function __construct($factura)
    {
        $this->factura = $factura;
    }

    public function execute()
    {
        $this->validarDataFactura();

        DB::beginTransaction();

        try {
            $factura = $this->salvarFactura();
            $this->modificarFechaVencimiento($factura);

            DB::commit();

            return $factura;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage(), 400);
        }
        
    }

    protected function validarDataFactura()
    {
        $validator = ValidacionFacturaService::make($this->factura);
        
        if ($validator->fails()) {
            throw new \Exception('**' . json_encode($validator->errors), 400);
        }
    }

    protected function salvarFactura()
    {
        $factura = Repo\FacturasRepository::saveFactura($this->factura);

        return $factura;
    }

    protected function modificarFechaVencimiento($factura)
    {
        $useCase = new ActualizarVencimientoProductoService($factura->id);
        $useCase->execute();
    }
}