<?php

namespace Database\Seeders;

use App\Models\personaje;
use Illuminate\Database\Seeder;

class PersonajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        personaje::factory(50)->create();
    }
}
