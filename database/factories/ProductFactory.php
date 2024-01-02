<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name'=>$this->faker->word(),
            'description'=>$this->faker->word(),
            'image'=>$this->faker->word.'.jpg',
            'price'=>$this->faker->randomNumber(5, false),
            'discount_price'=>$this->faker->randomNumber(5, false),
            'category_id'=>39
        ];
    }
}
