<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Lista de categorías con múltiples palabras clave
        $categorias = [
            [
                'name' => 'Lácteos',
                'palabra_clave' => 'leche,crema,queso,yogurt,leche deslactosada,crema baja en grasa',
                'status' => 1,
            ],
            [
                'name' => 'Verduras',
                'palabra_clave' => 'verduras,vegetales,lechuga,tomate,zanahoria,brocoli,cebolla',
                'status' => 1,
            ],
            [
                'name' => 'Frutas',
                'palabra_clave' => 'frutas,manzana,pera,uva,platano,naranja,kiwi',
                'status' => 1,
            ],
            [
                'name' => 'Aceites',
                'palabra_clave' => 'aceite,canola,maíz,oliva,aceite en spray,aceite de oliva',
                'status' => 1,
            ],
        ];

        // Inserta las categorías en la tabla
        foreach ($categorias as $categoria) {
            DB::table('categories')->insert([
                'name' => $categoria['name'],
                'palabra_clave' => $categoria['palabra_clave'],
                'created_at' => now(),
                'updated_at' => now(),
                'status' => $categoria['status'],
            ]);
        }
    }
}
