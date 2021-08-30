<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Domain\VoProducto;

class ProductoVoTest extends TestCase
{
    public function testId()
    {
        $valueId = 2;
        $id = VoProducto\Id::create($valueId);

        $this->assertInstanceOf(VoProducto\id::class, $id);        
        $this->assertEquals($valueId, $id->get());
    }

    public function testNombre()
    {
        $valueNombre = 'SOAT';
        $nombre = VoProducto\Nombre::create($valueNombre);

        $this->assertInstanceOf(VoProducto\nombre::class, $nombre);        
        $this->assertEquals($valueNombre, $nombre->get());
    }

    public function testMinimoVehiculos()
    {
        $valueMinimoVehiculos = 1;
        $minimoVehiculos = VoProducto\MinimoVehiculos::create($valueMinimoVehiculos);

        $this->assertInstanceOf(VoProducto\MinimoVehiculos::class, $minimoVehiculos);        
        $this->assertEquals($valueMinimoVehiculos, $minimoVehiculos->get());
    }

    public function testDescripcion()
    {
        $valueDescripcion = 'Prueba producto';
        $descripcion = VoProducto\Descripcion::create($valueDescripcion);

        $this->assertInstanceOf(VoProducto\Descripcion::class, $descripcion);        
        $this->assertEquals($valueDescripcion, $descripcion->get());
    }
}
