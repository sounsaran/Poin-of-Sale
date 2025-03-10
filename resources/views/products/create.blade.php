@extends('Layouts.app')
@section('title', 'Products')
@section('content')
<div class="mx-auto p-4">
    <div class="grid grid-cols-1">
        <div class="w-full">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-lg font-semibold">Add Product</h4>
                </div>
                <div>
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- begin: Input Data -->
                            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="product_name" class="block text-sm font-medium text-gray-700">Product Name <span class="text-red-500">*</span></label>
                                    <input type="text" class="w-full p-2 border rounded-lg" id="product_name" name="product_name" value="{{ old('product_name') }}" required>
                                    @error('product_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category <span class="text-red-500">*</span></label>
                                    <select class="w-full p-2 border rounded-lg" name="category_id" required>
                                        <option disabled selected>-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="supplier_id" class="block text-sm font-medium text-gray-700">Supplier <span class="text-red-500">*</span></label>
                                    <select class="w-full p-2 border rounded-lg" name="supplier_id" required>
                                        <option disabled selected>-- Select Supplier --</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="product_garage" class="block text-sm font-medium text-gray-700">Product Garage <span class="text-red-500">*</span></label>
                                    <input type="text" class="w-full p-2 border rounded-lg" id="product_garage" name="product_garage" value="{{ old('product_garage') }}" required>
                                    @error('product_garage')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="product_store" class="block text-sm font-medium text-gray-700">Product Store <span class="text-red-500">*</span></label>
                                    <input type="text" class="w-full p-2 border rounded-lg" id="product_store" name="product_store" value="{{ old('product_store') }}" required>
                                    @error('product_store')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
    
                                <div>
                                    <label for="product_code" class="block text-sm font-medium text-gray-700">Product Code <span class="text-red-500">*</span></label>
                                    <input type="text" class="w-full p-2 border rounded-lg" id="product_code" name="product_code" value="{{ old('product_code') }}" required>
                                    @error('product_code')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
    
                                <div>
                                    <label for="buying_date" class="block text-sm font-medium text-gray-700">Buying Date <span class="text-red-500">*</span></label>
                                    <input type="date" class="w-full p-2 border rounded-lg" id="buying_date" name="buying_date" value="{{ old('buying_date') }}" required>
                                    @error('buying_date')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="expire_date" class="block text-sm font-medium text-gray-700">Expire Date <span class="text-red-500">*</span></label>
                                    <input type="date" class="w-full p-2 border rounded-lg" id="expire_date" name="expire_date" value="{{ old('expire_date') }}" required>
                                    @error('expire_date')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
    
    
                                <div>
                                    <label for="buying_price" class="block text-sm font-medium text-gray-700">Buying Price <span class="text-red-500">*</span></label>
                                    <input type="text" class="w-full p-2 border rounded-lg" id="buying_price" name="buying_price" value="{{ old('buying_price') }}" required>
                                    @error('buying_price')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="selling_price" class="block text-sm font-medium text-gray-700">Selling Price <span class="text-red-500">*</span></label>
                                    <input type="text" class="w-full p-2 border rounded-lg" id="selling_price" name="selling_price" value="{{ old('selling_price') }}" required>
                                    @error('selling_price')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <!-- end: Input Data -->
                            <div class="flex flex-col items-center justify-center p-4 border border-gray-300 rounded-lg">
                                <!-- begin: Input Image -->
                                <div class="w-52 h-52 rounded-lg overflow-hidden">
                                    <img id="image-preview" class="w-full h-full object-cover" src="{{ asset('images/images.png') }}" alt="profile-pic">
                                </div>
                                <label for="image" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">
                                    Choose File
                                </label>
                                <input type="file" class="hidden" id="image" name="product_image" accept="image/*" onchange="previewImage();">
                                <!-- end: Input Image -->
                            </div>
                        </div>
                        <div class="mt-4 flex gap-2">
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg">Save</button>
                            <a class="bg-red-500 text-white py-2 px-4 rounded-lg" href="{{ route('products.index') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage() {
        const file = document.getElementById('image').files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection