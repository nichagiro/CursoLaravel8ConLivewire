<?php

namespace Database\Seeders;

use App\Models\anime;
use Illuminate\Database\Seeder;

class AnimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        anime::factory(50)->create();
    }
}
