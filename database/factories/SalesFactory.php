<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SalesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => mt_rand(1, 10),
            'barang' => $this->faker->word(),
            'jenis' => collect(['Elektronik', 'ATK'])->random(1)[0],
            'harga' => $this->faker->numberBetween(1000, 10000000),
        ];
    }
}
