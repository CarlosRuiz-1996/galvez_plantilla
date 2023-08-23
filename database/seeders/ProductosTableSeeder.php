<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {

            Producto::create([
                'nombre' => 'Producto ' . $i,
                'descripcion' => 'Descripcion del producto ' . $i,
                'stock' => '10' . $i,
                'precio'=> 10*$i
            ]);
        }
    }
}
