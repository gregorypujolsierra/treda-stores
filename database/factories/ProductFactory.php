<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->words(2, true);
        $name_arr = explode(' ', trim($name));

        return [
            'name' => $name,
            'sku' => substr($name_arr[0], 0, 4).$this->faker->randomNumber(4),
            'description' => $this->faker->text(200),
            'price' => $this->faker->randomFloat(2, 5, 1000),
            'store_id' => $this->faker->numberBetween(1, config('app.max_number_of_stores', 5)),
            'image' => $this->faker->imageUrl(480, 360, 'technics'),
        ];
    }
}
