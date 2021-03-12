<?php

namespace Database\Factories;

use App\Zip;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZipFactory extends Factory
{
    protected $model = Zip::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'zip_code'   => $this->faker->postcode,
            'city'     => $this->faker->city,
            'state'    => $this->faker->state,
            'abbr' => $this->faker->stateAbbr,
        ];
    }
}
