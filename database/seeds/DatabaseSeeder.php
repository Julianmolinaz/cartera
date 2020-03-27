<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call('MunicipiosTableSeeder');
        $this->call('PuntosTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('ConyugesTableSeeder');
        $this->call('CodeudoresTableSeeder');
        $this->call('ClientesTableSeeder');
        $this->call('ProductosTableSeeder');
        $this->call('VariablesTableSeeder');
        $this->call('CarterasTableSeeder');
        $this->call('PrecreditosTableSeeder');
        $this->call('EstLaboralesTableSeeder');
        $this->call('EstDatacreditosTableSeeder');
        $this->call('EstViviendasTableSeeder');
        $this->call('EstReferenciasTableSeeder');
        $this->call('EstudiosTableSeeder');
        $this->call('CreditosTableSeeder');
        $this->call('ExtrasTableSeeder');
        $this->call('FacturasTableSeeder');
        $this->call('PagosTableSeeder');
        $this->call('SancionesTableSeeder');
        $this->call('CriteriosTableSeeder');
        $this->call('LlamadasTableSeeder');
        $this->call('FechaCobrosTableSeeder');
        $this->call('AuditoriasTableSeeder');
        $this->call('OtrosPagosTableSeeder');
        $this->call('AnuladasTableSeeder');
        $this->call('CastigadasTableSeeder');
        $this->call('SoatTableSeeder');
        $this->call('MensajesTableSeeder');
        $this->call('FactPrecredConceptosTableSeeder');
        $this->call('FactPrecreditosTableSeeder');
        $this->call('PrecredPagosTableSeeder');
        $this->call('DocumentosTableSeeder');
        $this->call('BancosTableSeeder');
        $this->call('ProcesosTableSeeder');
        $this->call('CallBusquedasTableSeeder');
        $this->call('ConsecutivosTableSeeder');
        $this->call('ProveedoresTableSeeder');
        $this->call('EgresosTableSeeder');
        $this->call('NegociosTableSeeder');
        $this->call('ZonasTableSeeder');
        $this->call('TercerosTableSeeder');
        $this->call('RefProductosTableSeeder');
    }
}
