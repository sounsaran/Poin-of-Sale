@extends('Layouts.app')
@section('title', 'Products')
@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-lg rounded-lg p-4">
        <div class="flex justify-between items-center border-b pb-4">
            <h2 class="text-xl font-bold">Edit Product</h2>
        </div>
        <div class="mt-6">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('put')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Product Name -->
                        <div>
                            <label class="block font-medium">Product Name <span class="text-red-500">*</span></label>
                            <input type="text" class="border rounded-lg px-4 py-2 w-full" id="product_name" name="product_name" value="{{ old('product_name', $product->product_name) }}" required>
                        </div>
                        
                        <!-- Category -->
                        <div>
                            <label class="block font-medium">Category <span class="text-red-500">*</span></label>
                            <select class="border rounded-lg px-4 py-2 w-full" name="category_id" required>
                                <option selected disabled>-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Supplier -->
                        <div>
                            <label class="block font-medium">Supplier <span class="text-red-500">*</span></label>
                            <select class="border rounded-lg px-4 py-2 w-full" name="supplier_id" required>
                                <option selected disabled>-- Select Supplier --</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium">Product Garage <span class="text-red-500">*</span></label>
                            <input type="text" class="border rounded-lg px-4 py-2 w-full" id="product_garage" name="product_garage" value="{{ old('product_garage', $product->product_garage) }}" required>
                        </div>

                        <div>
                            <label class="block font-medium">Product Store <span class="text-red-500">*</span></label>
                            <input type="text" class="border rounded-lg px-4 py-2 w-full" id="product_store" name="product_store" value="{{ old('product_store', $product->product_store) }}" required>
                        </div>

                        <div>
                            <label class="block font-medium">Buying Date <span class="text-red-500">*</span></label>
                            <input type="text" class="border rounded-lg px-4 py-2 w-full" id="buying_date" name="buying_date" value="{{ old('buying_date', $product->buying_date) }}" required>
                        </div>

                        <div>
                            <label class="block font-medium">Expire Date <span class="text-red-500">*</span></label>
                            <input type="text" class="border rounded-lg px-4 py-2 w-full" id="expire_date" name="expire_date" value="{{ old('expire_date', $product->expire_date) }}" required>
                        </div>
                        
                        <!-- Buying & Selling Price -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium">Buying Price <span class="text-red-500">*</span></label>
                                <input type="text" class="border rounded-lg px-4 py-2 w-full" id="buying_price" name="buying_price" value="{{ old('buying_price', $product->buying_price) }}" required>
                            </div>
                            <div>
                                <label class="block font-medium">Selling Price <span class="text-red-500">*</span></label>
                                <input type="text" class="border rounded-lg px-4 py-2 w-full" id="selling_price" name="selling_price" value="{{ old('selling_price', $product->selling_price) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-center justify-center p-4 border border-gray-300 rounded-lg">
                        <!-- Image Preview -->
                        <div class="w-52 h-52 rounded-lg overflow-hidden">
                            <img class="w-full h-full object-cover" id="image-preview" 
                                src="{{ $product->product_image ? asset('images/products/'.$product->product_image) : asset('images/images.png') }}" 
                                alt="profile-pic">
                        </div>
                        <!-- Image Upload -->
                        <label for="image" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">Product Image</label>
                        <input type="file" class="hidden" id="image" name="product_image" accept="image/*" onchange="previewImage();">
                    </div>
                </div>
                
                
                <!-- Buttons -->
                <div class="flex space-x-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Save</button>
                    <a class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700" href="{{ route('products.index') }}">Cancel</a>
                </div>
            </form>
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
        };
        reader.readAsDataURL(file);
    }
}
</script>

@endsection