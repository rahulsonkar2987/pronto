<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'main_category_id' => \App\Models\MainCategory::all()->random()->id,
            'sub_category_name'=>$this->faker->word(),
            'status'=>$this->faker->randomElement(['1','0']),
        ];
    }
}
