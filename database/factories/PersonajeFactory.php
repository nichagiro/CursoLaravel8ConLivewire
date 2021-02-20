<?php

namespace Database\Factories;

use App\Models\anime;
use App\Models\personaje;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonajeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = personaje::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstNameFemale,
            'color' => $this->faker->hexcolor,
            'anime_id' => anime::all()->random()->id
        ];
    }
}
