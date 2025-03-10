@extends('Layouts.app')
@section('title', 'Products')
@section('content')
<div class="container mx-auto p-4">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h4 class="text-xl font-semibold mb-2">Images Product</h4>
            <div class="flex flex-col items-center justify-center p-4 border border-gray-300 rounded-lg mb-2">
                <!-- Image Preview -->
                <div class="w-52 h-52 rounded-lg overflow-hidden">
                    <img class="w-full h-full object-cover" id="image-preview" 
                        src="{{ $product->product_image ? asset('images/products/'.$product->product_image) : asset('images/images.png') }}" 
                        alt="profile-pic">
                </div>
            </div>
            <h4 class="text-xl font-semibold">Barcode</h4>
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-gray-700">Product Code</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-lg bg-gray-100" value="{{  $product->product_code }}" readonly>
                </div>
                <div>
                    <label class="block text-gray-700">Product Barcode</label>
                    <div class="w-full flex justify-center">
                        {!! $barcode !!}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 col-span-2">
            <h4 class="text-xl font-semibold mb-2">Information Product</h4>
            {{-- <div class="flex justify-center mb-4">
                <img class="w-24 h-24 rounded-full border" id="image-preview" 
                src="{{ $product->product_image ? asset('images/products/'.$product->product_image) : asset('assets/images/product/default.webp') }}"
                alt="profile-pic">
            </div> --}}
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700">Product Name</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-lg bg-gray-100" value="{{ $product->product_name }}" readonly>
                </div>
                <div>
                    <label class="block text-gray-700">Category</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-lg bg-gray-100" value="{{  $product->category->name }}" readonly>
                </div>
                <div>
                    <label class="block text-gray-700">Supplier</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-lg bg-gray-100" value="{{  $product->supplier->name }}" readonly>
                </div>
                <div>
                    <label class="block text-gray-700">Product Garage</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-lg bg-gray-100" value="{{  $product->product_garage }}" readonly>
                </div>
                <div>
                    <label class="block text-gray-700">Product Store</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-lg bg-gray-100" value="{{  $product->product_store }}" readonly>
                </div>
                <div>
                    <label class="block text-gray-700">Buying Date</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-lg bg-gray-100" value="{{ $product->buying_date }}" readonly>
                </div>
                <div>
                    <label class="block text-gray-700">Expire Date</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-lg bg-gray-100" value="{{ $product->expire_date }}" readonly>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700">Buying Price</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-lg bg-gray-100" value="{{  $product->buying_price }}" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-700">Selling Price</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-lg bg-gray-100" value="{{  $product->selling_price }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection