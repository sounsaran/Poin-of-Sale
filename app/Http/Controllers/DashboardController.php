<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $metrics = [
            'totalOrders' => 40876,
            'totalSales' => 38876,
            'totalProfit' => 12876,
            'totalReturn' => 11086,
        ];

        $recentSales = [
            ['id' => '1', 'date' => '02 Jan 2021', 'customer' => 'Alex Doe', 'sales' => 'Delivered', 'total' => 204.98],
            ['id' => '2', 'date' => '02 Jan 2021', 'customer' => 'David Mart', 'sales' => 'Pending', 'total' => 24.55],
            ['id' => '3', 'date' => '02 Jan 2021', 'customer' => 'Roe Parter', 'sales' => 'Returned', 'total' => 25.88],
            ['id' => '4', 'date' => '02 Jan 2021', 'customer' => 'Diana Penty', 'sales' => 'Delivered', 'total' => 170.66],
            ['id' => '5', 'date' => '02 Jan 2021', 'customer' => 'Martin Paw', 'sales' => 'Pending', 'total' => 56.56],
        ];

        $topSellingProducts = [
            ['img' => 'user1', 'name' => 'Vuitton Sunglasses', 'total' => 1142],
            ['img' => 'user2', 'name' => 'Hourglass Jeans', 'total' => 1567],
            ['img' => 'user3', 'name' => 'Nike Sport Shoe', 'total' => 1234],
            ['img' => 'user4', 'name' => 'Hermes Silk Scarves', 'total' => 2312],
            ['img' => 'user5', 'name' => 'Gucci Women\'s Bags', 'total' => 2345],
            ['img' => 'user5', 'name' => 'Gucci Women\'s Bags', 'total' => 2345],
            ['img' => 'user5', 'name' => 'Gucci Women\'s Bags', 'total' => 2345],
        ];

        return view('welcome', compact('metrics', 'recentSales', 'topSellingProducts'));
    }
}
