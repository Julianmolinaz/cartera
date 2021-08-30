<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Domain\Entities\SolicitudEntity;
use Src\Domain\Vo;

class SolicitudTest extends TestCase
{   
    public function testInstaceNewSolicitudEntity()
    {
        $solicitudEntity = $this->getSolicitudEntity();
        $this->assertInstanceOf(SolicitudEntity::class, $solicitudEntity);
    }

    public function testsSolicitudEntityToArray()
    {
        $solicitudEntity = $this->getSolicitudEntity();

        $arrSolicitud = $solicitudEntity->toArray();

        $this->assertEquals($arrSolicitud['aprobado'], $this->mockSolicitud()['aprobado']);
    }


    private function mockSolicitud()
    {
        return [
            'aprobado'          => 'Si',
            'vlr_fin'           => 500000,
            'num_fact'          => 'G1234',
            'estudio'           => 'Tipico',
            'fecha'             => '2021-08-26',
            'meses'             => 1,
            'cuotas'            => 2,
            'observaciones'     => 'prueba entities',
            'periodo'           => 'Quincenal',
            'p_fecha'           => 1,
            's_fecha'           => 16,
            'vlr_cuota'         => 100000,
            'cliente_id'        => 12,
            'producto_id'       => 10,
            'cartera_id'        => 8,
            'funcionario_id'    => 1,
        ];
    }

    private function getSolicitudEntity()
    {
        $data = $this->mockSolicitud();

        $solicitudEntity = new SolicitudEntity(
            Vo\Id::create(null),
            Vo\Aprobado::create($data['aprobado']),
            Vo\CentroCostos::create($data['vlr_fin']),
            Vo\Consecutivo::create($data['num_fact']),
            Vo\Estudio::create($data['estudio']),
            Vo\FechaSolicitud::create($data['fecha']),
            Vo\Meses::create($data['meses']),
            Vo\NumeroCuotas::create($data['cuotas']),
            Vo\Observaciones::create($data['observaciones']),
            Vo\Periodo::create($data['periodo']),
            Vo\PrimerFecha::create($data['p_fecha']),
            Vo\SegundaFecha::create($data['s_fecha']),
            Vo\ValorCuota::create($data['vlr_cuota']),
            Vo\Id::create($data['cliente_id']),
            Vo\Id::create($data['producto_id']),
            Vo\Id::create($data['cartera_id']),
            Vo\Id::create($data['funcionario_id']),
            
        );

        return $solicitudEntity;
    }
}
