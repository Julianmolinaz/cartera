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
        ini_set('memory_limit', '4000M');

        $this->call('MunicipiosTableSeeder');
        $this->call('PuntosTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('CarterasTableSeeder');
        $this->call('ProductosTableSeeder');
        $this->call('VariablesTableSeeder');
        $this->call('EstLaboralesTableSeeder');
        $this->call('EstDatacreditosTableSeeder');
        $this->call('EstViviendasTableSeeder');
        $this->call('EstReferenciasTableSeeder');
        $this->call('CriteriosTableSeeder');
        $this->call('CallBusquedasTableSeeder');
        $this->call('PermissionsTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('RoleUserTableSeeder');
        $this->call('PermissionRoleTableSeeder');
        $this->call('BancosTableSeeder');
        $this->call('TipoVehiculosTableSeeder');
        $this->call('TarifasTableSeeder');
        $this->call('OficiosTableSeeder');
        $this->call('ClientesTableSeeder');
        $this->call('TercerosTableSeeder');
        $this->call('PrecreditosTableSeeder');
        // $this->call('FechaCobrosTableSeeder');
        // $this->call('VehiculosTableSeeder');
        // $this->call('RefProductosTableSeeder');
        $this->call('FactPrecredConceptosTableSeeder');
    }
}
