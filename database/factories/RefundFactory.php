<?php

namespace Database\Factories;

use App\Refund;
use Illuminate\Database\Eloquent\Factories\Factory;

class RefundFactory extends Factory
{
    protected $model = Refund::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'     => $this->faker->name,
            'email'    => $this->faker->safeEmail,
            'district' => $this->faker->company,
            'order_number'  => $this->generate_string(),
            'rma_number'  => $this->generate_string(),
            'reason' => $this->faker->paragraph,
        ];
    }

    protected function generate_string($length = 8): string
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }
}
