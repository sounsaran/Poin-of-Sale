<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuppliersTableSeeder extends Seeder
{
    public function run()
    {
        $suppliers = [
            ['name' => 'Supplier A', 'email' => 'sounsaran2@gmail.com', 'phone' => '012345678'],
            ['name' => 'Supplier B', 'email' => 'sounsaran4@gmail.com', 'phone' => '098765432'],
            ['name' => 'Supplier C', 'email' => 'sarankonkhmer@gmail.com', 'phone' => '011223344'],
        ];

        foreach ($suppliers as $supplier) {
            DB::table('suppliers')->insert($supplier);
        }
    }
}
