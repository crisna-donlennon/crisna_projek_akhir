<?php

namespace Database\Factories;

use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_product' => fake()->word(),
            'deskripsi' => fake()->text(),
            'stok' => mt_rand(1, 900),
            'harga' => mt_rand(2000, 20000),
            'gambar' => 'assets/paus.jpg',
            'type_id' => Type::factory()
        ];
    }
}
