<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {
            DB::table('products')->insert([
                'product_name' => 'Product ' . $i,
                'category_id' => rand(1, 3),
                'supplier_id' => rand(1, 3),
                'product_code' => strtoupper(Str::random(10)),
                'product_garage' => 'Garage ' . rand(1, 10),
                'product_image' => '',
                'product_store' => rand(10, 100),
                'buying_date' => now()->subDays(rand(1, 365)),
                'expire_date' => now()->addDays(rand(30, 365))->format('Y-m-d'),
                'buying_price' => rand(100, 1000),
                'selling_price' => rand(1100, 2000),
            ]);
        }
    }
}
