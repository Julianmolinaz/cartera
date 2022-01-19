<?php

namespace Src\Certificados\PreavisoCentrales;

use Src\Libs\Time;
use App\Repositories as Repo;

class GetDataPreavisoCentralesService
{
    public $credito;
    public $solicitud;
    public $ventas;
    public $cliente;
    public $fecha;
    public $data;

    private function __construct($creditoId, $tipo)
    {   
        $this->execute($creditoId, $tipo);
    }

    public static function make($creditoId, $tipo)
    {
        return new self($creditoId, $tipo);
    }

    protected function execute($creditoId, $tipo)
    {
        $this->fecha = Time::now()->format("d-m-Y");
        $this->credito = Repo\CreditoRepository::find($creditoId);

        $this->ventas = Repo\VentasRepository::findBySolicitud($this->credito->precredito_id);
        $this->solicitud = Repo\SolicitudRepository::find($this->credito->precredito_id);
        $this->cliente = Repo\ClientesRepository::find($this->solicitud->cliente_id);

        if ($tipo === 'cliente') {
            $this->data = $this->getDataCliente();
        } else {
            $this->data = $this->getDataCodeudor();
        }

        return $this->data;
    }

    protected function getDataCliente()
    {
        return (object)[
            'fecha' => $this->fecha,
            'credito_id' => $this->credito->id,
            'nombre' => $this->cliente->nombre,
            'tipo_documento' => $this->cliente->tipo_doc,
            'numero_documento' => $this->cliente->num_doc,
            'telefono' => $this->cliente->movil,
            'municipio' => $this->cliente->municipio,
            'departamento' => $this->cliente->departamento,
            'producto' => $this->getProductos(),
            'sanciones' => $this->credito->sanciones_debe,
            'saldo' => $this->credito->saldo,
        ];
    }

    protected function getDataCodeudor()
    {
        $codeudor = Repo\CodeudoresRepository::findByCliente($this->cliente->id);

        return (object)[
            'fecha' => $this->fecha,
            'credito_id' => $this->credito->id,
            'nombre' => $codeudor->nombre,
            'tipo_documento' => $codeudor->tipo_doc,
            'numero_documento' => $codeudor->num_doc,
            'telefono' => $codeudor->movil,
            'municipio' => $codeudor->municipio,
            'departamento' => $codeudor->departamento,
            'producto' => $this->getProductos(),
            'sanciones' => $this->credito->sanciones_debe,
            'saldo' => $this->credito->saldo,
        ];
    }

    protected function getProductos()
    {

        if ($this->solicitud->producto_id) return $this->solicitud->producto_nombre;

        $str = '';
        $countVentas = count($this->ventas);
        
        for ($i = 0; $i < $countVentas; $i++) {
            $str .= $this->ventas[$i]['producto']['nombre']; 

            if ( $i !== $countVentas - 1 ) {
                $str .= " + ";
            }
        }

        return $str;
    }
}