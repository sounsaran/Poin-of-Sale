@extends('Layouts.app')
@section('title', 'Products')
@section('content')
    <div class="p-4">
        <div class="bg-white shadow-md rounded-2xl w-full p-6">
            <h2 class="mb-4 text-lg font-semibold text-gray-700 underline">List of Products</h2>
            <table class="min-w-full text-sm text-center">
                <thead>
                    <tr class="border-b">
                        <th class="px-4 py-2 w-10">ID</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2">Supplier</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Stock</th>
                        <th class="px-4 py-2">Barcode</th>
                        <th class="px-4 py-2">Image</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                            <td class="px-4 py-2">01</td>
                            <td class="px-4 py-2">Utility Tractors</td>
                            <td class="px-4 py-2">Tractors</td> <!-- Assuming a relation with category -->
                            <td class="px-4 py-2">Jonh Deer</td> <!-- Assuming a relation with supplier -->
                            <td class="px-4 py-2">$ 53,000</td>
                            <td class="px-4 py-2">100</td>
                            <td class="px-4 py-2">810607023094</td>
                            <td class="px-4 py-2 w-32">
                                <div class="w-full mr-4 flex justify-center"><img src="images/user1.jpg" alt="" class="w-14 h-14"></div>
                            </td>
                        </tr>
                    @foreach ($products as $product)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $product->id }}</td>
                            <td class="px-4 py-2">{{ $product->name }}</td>
                            <td class="px-4 py-2">{{ $product->category->name ?? 'N/A' }}</td> <!-- Assuming a relation with category -->
                            <td class="px-4 py-2">{{ $product->supplier->name ?? 'N/A' }}</td> <!-- Assuming a relation with supplier -->
                            <td class="px-4 py-2">${{ number_format($product->price, 2) }}</td>
                            <td class="px-4 py-2">{{ $product->stock_quantity }}</td>
                            <td class="px-4 py-2">{{ $product->barcode }}</td>
                            <td class="px-4 py-2">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        width="100">
                                @else
                                    No image available
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
