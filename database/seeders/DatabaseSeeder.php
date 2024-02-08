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
        // Create regular users
        \App\Models\User::factory(5)->create();

        // Check if YUKIHIRO user already exists
        $yukihiroUser = \App\Models\User::where('name', 'YUKIHIRO')->first();

        // Create YUKIHIRO user only if it doesn't exist
        if (!$yukihiroUser) {
            \App\Models\User::factory()->create([
                'name' => 'YUKIHIRO',
                'email' => 'yukihiro@gmail.com', // Specify a unique email address
                'password' => bcrypt('password'), // Use bcrypt to hash the password
                'roles' => 'admin',
            ]);
        }

        // Create types and associated products
        $types = Type::factory()->count(3)->create();

        $types->each(function ($type) {
            $productCount = rand(1, 5); // Adjust the range based on your preference
            Product::factory()->count($productCount)->create(['type_id' => $type->id]);
        });
    }
}
