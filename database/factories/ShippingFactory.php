<?php

namespace Database\Factories;

use App\Models\Shipping;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class ShippingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shipping::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->paragraph(),
            'shipment_number' => Str::random(10),
            'status' => $this->faker->randomElement(array_keys(config('enums.ship_status_enum'))),
            'address' => $this->faker->address()
        ];
    }
}
