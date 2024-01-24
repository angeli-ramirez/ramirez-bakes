<?php

namespace Database\Seeders\Defaults;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categoriesData = require database_path('seeders/Defaults/Data/categories.php');

        foreach ($categoriesData as $categoryData) {
            Category::create([
                'name' => $categoryData['name'],
            ]);
        }
    }
}
