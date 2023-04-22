<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name' => 'Asignación de Citas',
            'visible_name' => 'Asignación de Citas',
            'order' => 1
        ]);

        Status::create([
            'name' => 'Adminisión de Pacientes',
            'visible_name' => 'Adminisión de Pacientes',
            'order' => 2
        ]);

        Status::create([
            'name' => 'Atención de paciente para la toma del examen',
            'visible_name' => 'Atención de paciente para la toma del examen',
            'order' => 3
        ]);

        Status::create([
            'name' => 'Interpretación del Especialista',
            'visible_name' => 'Interpretación del Especialista',
            'order' => 4
        ]);

        Status::create([
            'name' => 'Transcripción',
            'visible_name' => 'Transcripción',
            'order' => 5
        ]);

        Status::create([
            'name' => 'Carga y Entrega de Resultados',
            'visible_name' => 'Carga y Entrega de Resultados',
            'order' => 6
        ]);

        $role = Role::create(['name' => 'Administrator']);
        $role = Role::create(['name' => 'Recepcionista']);
        $role = Role::create(['name' => 'Especialista']);
        $role = Role::create(['name' => 'Transcriptor']);
        $role = Role::create(['name' => 'Tecnólogo']);
        $role = Role::create(['name' => 'Call Center']);

        $user = User::create(
            [
                'firstname' => 'Administrador',
                'lastname' => 'Principal',
                'email' => 'admin@idx.com',
                'password' => Hash::make('password'),
            ]
        );

        $user->assignRole('Administrator');

    }
}
