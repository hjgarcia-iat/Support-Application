<?php

namespace Database\Factories;

use App\File;
use App\Ticket;
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
            'ticket_id' => function () {
                return Ticket::factory()->create()->id;
            },
            'file'      => $this->faker->imageUrl,
        ];
    }
}
