<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Devices and gadgets'],
            ['name' => 'Fashion', 'description' => 'Clothing and accessories'],
            ['name' => 'Books', 'description' => 'Educational and fictional books'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['name' => $category['name']], // Condition
                ['description' => $category['description'], 'updated_at' => now()]
            );
        }
    }
}
