<?php

use Illuminate\Database\Seeder;

use App\User;

class users_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'tipo' => 'ADMINISTRADOR',
            'foto' => 'user_default.png',
            'estado' => 1
        ]);
    }
}
