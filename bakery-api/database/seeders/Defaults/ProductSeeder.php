<?php

namespace Database\Seeders\Defaults;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $productsData = require database_path('seeders/Defaults/Data/products.php');

        foreach ($productsData as $productData) {
            Product::create([
                'category_id' => $productData['category_id'],
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'image' => $productData['image'],
                'is_available' => $productData['is_available'],
            ]);
        }
    }
}
