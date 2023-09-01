<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Brand;
use App\Models\Ieps;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->call(RoleSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(PresentationSeeder::class);
        $this->call(IvaSeeder::class);
        $this->call(IpesSeeder::class);
        $this->call(GrammageSeeder::class);
        $this->call(HospitalesTableSeeder::class);

        //creo un usuario de prueba para la base
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.com',
        ])->assignRole('Admin');

    }
}
