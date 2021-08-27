<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Solicitud\Domain\Vo;

class SolicitudVoTest extends TestCase
{
    public function testConsecutivo()
    {
        $valueConsecutivo = 'G10001938';
        $consecutivo = Vo\Consecutivo::create($valueConsecutivo);
        
        $this->assertInstanceOf(Vo\Consecutivo::class, $consecutivo);        
        $this->assertEquals($valueConsecutivo, $consecutivo->get());
    }
    
    public function testFechaSolicitud()
    {
        $valueFechaSolicitud = '2021-12-25';
        $fechaSolicitud = Vo\FechaSolicitud::create($valueFechaSolicitud);
        
        $this->assertInstanceOf(Vo\FechaSolicitud::class, $fechaSolicitud);        
        $this->assertEquals($valueFechaSolicitud, $fechaSolicitud->get());
    }

    public function testCentroCostos()
    {
        $valueCentroCostos = 1000000;
        $centroCostos = Vo\CentroCostos::create($valueCentroCostos);

        $this->assertInstanceOf(Vo\CentroCostos::class, $centroCostos);        
        $this->assertEquals($valueCentroCostos, $centroCostos->get());
    }

    public function testPeriodo()
    {
        $valuePeriodo = 'Quincenal';
        $periodo = Vo\Periodo::create($valuePeriodo);

        $this->assertInstanceOf(Vo\Periodo::class, $periodo);        
        $this->assertEquals($valuePeriodo, $periodo->get());
    }

    public function testMeses()
    {
        $valueMeses = 3;
        $meses = Vo\Meses::create($valueMeses);

        $this->assertInstanceOf(Vo\Meses::class, $meses);        
        $this->assertEquals($valueMeses, $meses->get());
    }

    public function testNumeroCuotas()
    {
        $valueNumeroCuotas = 12;
        $numeroCuotas = Vo\NumeroCuotas::create($valueNumeroCuotas);

        $this->assertInstanceOf(Vo\NumeroCuotas::class, $numeroCuotas);        
        $this->assertEquals($valueNumeroCuotas, $numeroCuotas->get());
    }

    public function testValorCuota()
    {
        $valueValorCuota = 30000;
        $valorCuota = Vo\ValorCuota::create($valueValorCuota);

        $this->assertInstanceOf(Vo\ValorCuota::class, $valorCuota);        
        $this->assertEquals($valueValorCuota, $valorCuota->get());
    }

    public function testPrimerFecha()
    {
        $valuePrimerFecha = 2;
        $primerFecha = Vo\PrimerFecha::create($valuePrimerFecha);

        $this->assertInstanceOf(Vo\primerFecha::class, $primerFecha);        
        $this->assertEquals($valuePrimerFecha, $primerFecha->get());
    }

    public function testSegundaFecha()
    {
        $valueSegundaFecha = 17;
        $segundaFecha = Vo\SegundaFecha::create($valueSegundaFecha);

        $this->assertInstanceOf(Vo\SegundaFecha::class, $segundaFecha);        
        $this->assertEquals($valueSegundaFecha, $segundaFecha->get());
    }

    public function testEstudio()
    {
        $valueEstudio = 'Tipico';
        $estudio = Vo\Estudio::create($valueEstudio);

        $this->assertInstanceOf(Vo\Estudio::class, $estudio);        
        $this->assertEquals($valueEstudio, $estudio->get());
    }

    public function testCuotaInicial()
    {
        $valueCuotaInicial = 60000;
        $cuotaInicial = Vo\CuotaInicial::create($valueCuotaInicial);

        $this->assertInstanceOf(Vo\CuotaInicial::class, $cuotaInicial);        
        $this->assertEquals($valueCuotaInicial, $cuotaInicial->get());
    }

    public function testAprobado()
    {
        $valueAprobado = 'Si';
        $aprobado = Vo\Aprobado::create($valueAprobado);

        $this->assertInstanceOf(Vo\Aprobado::class, $aprobado);        
        $this->assertEquals($valueAprobado, $aprobado->get());
    }

    public function testObservaciones()
    {
        $valueObservaciones = 'Prueba de validación';
        $observaciones = Vo\Observaciones::create($valueObservaciones);

        $this->assertInstanceOf(Vo\Observaciones::class, $observaciones);        
        $this->assertEquals($valueObservaciones, $observaciones->get());
    }

    public function testId()
    {
        $valueId = 2;
        $id = Vo\Id::create($valueId);

        $this->assertInstanceOf(Vo\id::class, $id);        
        $this->assertEquals($valueId, $id->get());
    }
}
