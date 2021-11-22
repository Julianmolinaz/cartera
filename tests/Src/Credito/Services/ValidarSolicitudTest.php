<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Credito\Services\ValidarSolicitudService;

class ValidarSolicitudTest extends TestCase
{
    public function testMakeValidarSolicitud()
    {
        $data = $this->mockSolicitud();
        $validator = ValidarSolicitudService::make($data, 'create');

        $this->assertInstanceOf(
            'Src\Credito\Services\ValidarSolicitudService', 
            $validator
        );

        if ($validator->fails()) {
            dd($validator->errors());
        } 
        
        $this->assertTrue(true);
    }

    public function mockSolicitud()
    {
        return [
            "id"                => "",
            "num_fact"          => "G",
            "fecha"             => "2021-11-10",
            "cartera_id"        => 48,
            "funcionario_id"    => 34,
            "cliente_id"        => "",
            "producto_id"       => "",
            "punto_id"          => 121,
            "productos"         => "",
            "vlr_fin"           => 1000,
            "periodo"           => "Quincenal",
            "meses"             => 1,
            "cuotas"            => 2,
            "vlr_cuota"         => 600,
            "vlr_asistencia"    => 0,
            "p_fecha"           => 1,
            "s_fecha"           => 16,
            "estudio"           => "Tipico",
            "cuota_inicial"     => 0,
            "aprobado"          => "En estudio",
            "observaciones"     => ""
        ];
    }
}
