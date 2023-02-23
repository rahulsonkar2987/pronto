<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>\App\Models\User::where('user_type','user')->get()->random()->id,
            'provider_id'=>\App\Models\User::where('user_type','provider')->get()->random()->id,
            'order_id'=>rand(),
        ];
    }
}
