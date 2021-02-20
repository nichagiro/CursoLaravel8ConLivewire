<?php

namespace Database\Factories;

use App\Models\cat;
use Illuminate\Database\Eloquent\Factories\Factory;

class CatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = cat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'img' => $this->faker->imageUrl(640, 480, 'cats'),
            'slug' => $this->faker->firstNameFemale
        ];
    }
}
