@extends('Layouts.app')
@section('title', 'Dashboard')
@section('content')

@php
    $orders = [
        ['no' => 1, 'name' => 'Mr. Phaktra', 'item' => 'Mouses', 'price' => '350$', 'action' => 'Proccess'],
        ['no' => 2, 'name' => 'Mr. Chatra', 'item' => 'Keyboard', 'price' => '750$', 'action' => 'Success'],
        ['no' => 3, 'name' => 'Ms. Sophasa', 'item' => 'Monitor', 'price' => '1150$', 'action' => 'Cancel'],
        ['no' => 4, 'name' => 'Ms. Sophasa', 'item' => 'Monitor', 'price' => '1150$', 'action' => 'Cancel'],
        ['no' => 5, 'name' => 'Ms. Sophasa', 'item' => 'Monitor', 'price' => '1150$', 'action' => 'Cancel'],
        ['no' => 6, 'name' => 'Ms. Sophasa', 'item' => 'Monitor', 'price' => '1150$', 'action' => 'Cancel'],
        ['no' => 7, 'name' => 'Ms. Sophasa', 'item' => 'Monitor', 'price' => '1150$', 'action' => 'Success'],
        ['no' => 8, 'name' => 'Ms. Sophasa', 'item' => 'Monitor', 'price' => '1150$', 'action' => 'Cancel'],
        ['no' => 9, 'name' => 'Ms. Sophasa', 'item' => 'Monitor', 'price' => '1150$', 'action' => 'Cancel'],
        ['no' => 10, 'name' => 'Ms. Sophasa', 'item' => 'Monitor', 'price' => '1150$', 'action' => 'Cancel'],
        ['no' => 11, 'name' => 'Ms. Sophasa', 'item' => 'Monitor', 'price' => '1150$', 'action' => 'Cancel'],
    ];
@endphp
<div class="px-4">
    <div class="grid w-full max-w-6xl grid-cols-2 gap-5 mt-4 md:grid-cols-4">
        <div class="flex items-center justify-between px-6 py-4 bg-white shadow-md rounded-2xl">
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Total Order</h3>
                <p class="text-4xl font-bold text-blue-600">{{ number_format(40876) }}</p>
                <p class="flex items-center mt-1 text-sm text-green-600">
                    <i class="mr-1 fas fa-arrow-up"></i>
                    Up From Yesterday
                </p>
            </div>
            <div class="w-16 h-16 p-4 text-2xl text-center text-blue-600 bg-blue-100 rounded-lg">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>

        <div class="flex items-center justify-between px-6 py-4 bg-white shadow-md rounded-2xl">
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Total Order</h3>
                <p class="text-4xl font-bold text-blue-600">{{ number_format(40876) }}</p>
                <p class="flex items-center mt-1 text-sm text-green-600">
                    <i class="mr-1 fas fa-arrow-up"></i>
                    Up From Yesterday
                </p>
            </div>
            <div class="w-16 h-16 p-4 text-2xl text-center text-green-600 bg-green-100 rounded-lg">
                <i class="fas fa-cart-plus"></i>
            </div>
        </div>

        <div class="flex items-center justify-between px-6 py-4 bg-white shadow-md rounded-2xl">
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Total Order</h3>
                <p class="text-4xl font-bold text-blue-600">{{ number_format(40876) }}</p>
                <p class="flex items-center mt-1 text-sm text-green-600">
                    <i class="mr-1 fas fa-arrow-up"></i>
                    Up From Yesterday
                </p>
            </div>
            <div class="w-16 h-16 p-4 text-2xl text-center text-orange-600 bg-orange-100 rounded-lg">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>

        <div class="flex items-center justify-between px-6 py-4 bg-white shadow-md rounded-2xl">
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Total Order</h3>
                <p class="text-4xl font-bold text-blue-600">{{ number_format(10876) }}</p>
                <p class="flex items-center mt-1 text-sm text-red-600">
                    <i class="mr-1 fas fa-arrow-down"></i>
                    Down From Today
                </p>
            </div>
            <div class="w-16 h-16 p-4 text-2xl text-center text-red-600 bg-red-100 rounded-lg">
                <i class="fas fa-cart-arrow-down"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-5 mt-6 md:grid-cols-6">
        <!-- Recent Sales Table (3/4 width) -->
        <div class="col-span-4 p-6 bg-white shadow-md rounded-2xl">
            <h3 class="mb-4 text-lg font-semibold text-gray-700">Recent Sales</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-center">
                    <thead>
                        <tr class="border-b">
                            <th class="px-4 py-2">No.</th>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Customer</th>
                            <th class="px-4 py-2">Sales</th>
                            <th class="px-4 py-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (array_slice($recentSales, 0, 5) as $sale)
                            <tr class="border-b">
                                <td class="w-2 px-4 py-2">{{ $sale['id'] }}</td>
                                <td class="px-4 py-2">{{ $sale['date'] }}</td>
                                <td class="px-4 py-2">{{ $sale['customer'] }}</td>
                                <td class="py-2 px-4 {{ $sale['sales'] == 'Delivered' ? 'text-green-600' : ($sale['sales'] == 'Pending' ? 'text-yellow-600' : 'text-red-600') }}">
                                    {{ $sale['sales'] }}
                                </td>
                                <td class="px-4 py-2">${{ number_format($sale['total'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button class="px-4 py-2 mt-4 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                See All
            </button>
        </div>

        <!-- Top Selling Products List (1/4 width) -->
        <div class="col-span-2 p-6 bg-white shadow-md rounded-2xl">
            <h3 class="mb-4 text-lg font-semibold text-gray-700">Top Selling Products</h3>
            <ul>
                @foreach (array_slice($topSellingProducts, 0, 5) as $product)
                    <li class="flex items-center w-full py-2">
                        <div class="w-10 h-10 mr-4 rounded-md shadow-xl"><img src="images/{{ $product['img'] }}.jpg" alt="" class="rounded-md shadow-lg"></div>
                        <div class="flex-1"><span>{{ $product['name'] }}</span></div>
                        <div class="text-right"><span class="font-semibold">$ {{ number_format($product['total'], 2) }}</span></div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection