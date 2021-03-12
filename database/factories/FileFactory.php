<?php

namespace Database\Factories;

use App\Contact;
use App\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'contact_id'   => 1,
            'file'     => $this->faker->imageUrl,
        ];
    }
}
