<?php

use Illuminate\Database\Seeder;
use App\RazonSocial;

class razon_social_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RazonSocial::create([
            'codigo' => 'E0001',
            'nombre' => 'EMPRESA PRUEBA',
            'alias' => 'CP',
            'ciudad' => 'LA PAZ',
            'dir' => 'ZONA LOS OLIVOS CALLE 3 #3232',
            'nro_aut' => '10000055566',
            'fono' => '21134568',
            'cel' => '78945612',
            'casilla' => '',
            'correo' => '',
            'logo' => 'logo.png',
            'actividad_economica' => 'ACTIVIDAD ECONOMICA',
        ]);
    }
}
