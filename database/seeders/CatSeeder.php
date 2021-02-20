<?php

namespace Database\Seeders;

use App\Models\cat;
use Illuminate\Database\Seeder;

class CatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        cat::factory(50)->create();
    }
}
