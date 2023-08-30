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
            'name' => 'Hospital '.$i,
            'address' => 'Avenida '.$i,
            'phone' => '555-555-5555',
            'email' => 'hospital'.$i.'@example.com',
            'image_path'=>'imagen'.$i.'.png',
            'contact_name' => 'Contacto '.$i,
            'contact_phone' => '111-111-1111',
            'contact_email' => 'contacto'.$i.'@example.com',
        ]);
    }
    }
}
