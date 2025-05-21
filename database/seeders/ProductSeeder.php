<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Product 1',
            'price' => 29.99,
            'image_url' => 'https://via.placeholder.com/250',
            'description' => 'Description for Product 1'
        ]);

        Product::create([
            'name' => 'Product 2',
            'price' => 49.99,
            'image_url' => 'https://via.placeholder.com/250',
            'description' => 'Description for Product 2'
        ]);

        Product::create([
            'name' => 'Product 3',
            'price' => 19.99,
            'image_url' => 'https://via.placeholder.com/250',
            'description' => 'Description for Product 3'
        ]);
    }
}
