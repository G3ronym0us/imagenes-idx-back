<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
    }
}
