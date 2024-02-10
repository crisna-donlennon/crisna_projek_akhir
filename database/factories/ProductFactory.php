<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

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
        $imageDirectory = storage_path('app/public/assets/PRODUK');
        $images = File::files($imageDirectory);

        return [
            'nama_product' => $this->faker->word(),
            'deskripsi' => $this->faker->text(),
            'stok' => $this->faker->numberBetween(1, 900),
            'berat' => $this->faker->numberBetween(1, 900),
            'harga' => $this->faker->numberBetween(2000, 20000),
            'gambar' => 'assets/PRODUK/' . $this->faker->randomElement(['keset.jpg', 'mop-pel.webp', 'sapu.jpg', 'sapu2.webp', 'sikat.jpg', 'sikat2.webp']),
            'type_id' => Type::factory(),
        ];
    }
}
