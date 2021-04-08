<?php

namespace Database\Factories;

use App\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reason'   => $this->faker->sentence,
            'name'     => $this->faker->name,
            'email'    => $this->faker->safeEmail,
            'district' => $this->faker->company,
            'subject'  => $this->faker->sentence,
            'details'  => $this->faker->sentence,
        ];
    }
}
