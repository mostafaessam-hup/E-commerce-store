<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'mostafa',
        //     'email' => 'mostafa@gmail.com',
        //     'type' => 'admin',
        // ]);
        // \App\Models\Category::factory(10)->create();
        Product::factory(10)->create();
    }
    
}
