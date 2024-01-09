<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\Type;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        
        \App\Models\User::factory()->create([
            'name' => 'sandroardhi',
            'email' => 'sandro@gmail.com',
        ]);

        $types = \App\Models\Type::factory()->count(5)->create();

        $types->each(function ($types) {
            Product::factory()->count(1)->create(['type_id' => $types->id]);
        });
    }
}
