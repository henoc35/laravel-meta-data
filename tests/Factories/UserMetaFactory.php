<?php

namespace CityHunter\LaravelMetaData\Tests\Factories;

use CityHunter\LaravelMetaData\Tests\Models\UserMeta;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserMetaFactory extends Factory
{
    protected $model = UserMeta::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'meta_key' => fake()->name(),
            'meta_value' => fake()->text(rand(10, 150))
        ];
    }
}
