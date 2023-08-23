<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hospital;
class HospitalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i =1; $i<=20; $i++){

        Hospital::create([
            'nombre' => 'Hospital '.$i,
            'direccion' => 'Avenida '.$i,
            'telefono' => '555-555-5555',
            'correo' => 'hospital'.$i.'@example.com',
            'image_path'=>'imagen'.$i.'.png',
            'contacto_nombre' => 'Contacto '.$i,
            'contacto_telefono' => '111-111-1111',
            'contacto_correo' => 'contacto'.$i.'@example.com',
        ]);
    }
    }
}
