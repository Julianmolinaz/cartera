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
        $this->call('ConyugesTableSeeder');
        $this->call('CodeudoresTableSeeder');
        $this->call('ClientesTableSeeder');
        $this->call('ProductosTableSeeder');
        $this->call('VariablesTableSeeder');
        $this->call('PrecreditosTableSeeder');
        $this->call('EstLaboralesTableSeeder');
        $this->call('EstDatacreditosTableSeeder');
        $this->call('EstViviendasTableSeeder');
        $this->call('EstReferenciasTableSeeder');
        $this->call('EstudiosTableSeeder');
        $this->call('CreditosTableSeeder');
        $this->call('FacturasTableSeeder');
        $this->call('PagosTableSeeder');
        $this->call('ExtrasTableSeeder');
        $this->call('CriteriosTableSeeder');
        $this->call('FechaCobrosTableSeeder');
        $this->call('EgresosTableSeeder');
        $this->call('OtrosPagosTableSeeder');
        $this->call('CallBusquedasTableSeeder');
        $this->call('AnuladasTableSeeder');
        $this->call('CastigadasTableSeeder');        
        $this->call('PermissionsTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('RoleUserTableSeeder');
        $this->call('PermissionRoleTableSeeder');
        $this->call('BancosTableSeeder');
    }
}
