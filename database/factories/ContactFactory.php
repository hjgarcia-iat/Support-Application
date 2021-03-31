<?php

namespace Database\Factories;

use App\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

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
