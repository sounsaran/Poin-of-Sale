@extends('Layouts.app')
@section('title', 'Products')
@section('content')
<div class="grid grid-cols-1 gap-0 bg-gray-300 md:grid-cols-4">
    <div class="col-span-3 p-4 h-[581px] overflow-y-scroll no-scrollbar">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-5">
            {{-- start item --}}
            @foreach ($products as $product)
            <div class="col-span-1 p-2 bg-white rounded-lg product-card">
                <div class="bg-blue-500 w-[135px] h-[135px] border-2 border-blue-800">
                    <img src="images/{{ $product['img'] }}" alt="Car 1">
                </div>
                <div class="pt-2">
                    <p class="text-lg font-semibold text-gray-700">{{ $product['name'] }}</p>
                    <p class="text-lg font-semibold text-gray-700">$ {{ $product['price'] }}</p>
                    <button class="w-full px-3 py-1 bg-green-500 rounded-md add-button">Add</button>
                </div>
            </div>
            @endforeach
            {{-- end item --}}
        </div>
    </div>
    <div class="h-full col-span-1 p-4 bg-white">
        <h3 class="mb-3 text-lg font-semibold text-gray-700">List Items</h3>
        <div class="w-full overflow-y-scroll bg-gray-300 border-2 border-blue-800 rounded-lg h-72 no-scrollbar">
            {{-- start list items for order --}}
            <ul class="order-list">
                {{-- Item in here --}}
            </ul>
            {{-- end list items for order --}}
        </div>
        <div class="">
            <ul>
                <li class="flex items-center justify-between w-full py-1">
                    <div class=""><span class="font-semibold">Sub Total</span></div>
                    <div class="subtotal"><span class="font-semibold">$ 0</span></div>
                </li>
                <li class="flex items-center justify-between w-full py-1">
                    <div class="taxperson"><span class="font-semibold">Tax 0%</span></div>
                    <div class="tax"><span class="font-semibold">$ 0</span></div>
                </li>
                <li class="flex items-center justify-between w-full py-1">
                    <div class=""><span class="font-semibold">Total Payment</span></div>
                    <div class="total"><span class="font-semibold">$ 0</span></div>
                </li>
            </ul>
        </div>
        <button class="w-full p-2 mt-2 font-bold text-white bg-green-500 rounded-lg">CHECK OUT</button>
        <button class="w-full p-2 mt-2 font-bold text-white bg-green-500 rounded-lg">PENDING</button>
    </div>
</div>
@endsection
