@extends('Layouts.app')
@section('title', 'Products')
@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h4 class="text-lg font-semibold">Add Supplier</h4>
        </div>

        <div>
            <form action="{{ route('suppliers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- begin: Input Data -->
                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Supplier Name <span class="text-red-500">*</span></label>
                            <input type="text" class="w-full p-2 border rounded-lg" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Shop Name <span class="text-red-500">*</span></label>
                            <input type="text" class="w-full p-2 border rounded-lg" id="shopname" name="shopname" value="{{ old('shopname') }}" required>
                            @error('shopname') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Supplier Email <span class="text-red-500">*</span></label>
                            <input type="email" class="w-full p-2 border rounded-lg" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Supplier Phone <span class="text-red-500">*</span></label>
                            <input type="text" class="w-full p-2 border rounded-lg" id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="account_holder" class="block text-sm font-medium text-gray-700">Account Holder</label>
                            <input type="text" class="w-full p-2 border rounded-lg" id="account_holder" name="account_holder" value="{{ old('account_holder') }}">
                            @error('account_holder')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Bank Name</label>
                            <select class="w-full p-2 border rounded-lg" name="bank_name">
                                <option disabled selected>-- Select Supplier --</option>
                                <option value="ABA">ABA</option>
                                <option value="Wing">Wing</option>
                                <option value="ACLida">AC Lida</option>
                                <option value="AMK">AMK</option>
                            </select>
                            @error('bank_name') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="account_number" class="block text-sm font-medium text-gray-700">Account Number</label>
                            <input type="text" class="w-full p-2 border rounded-lg" id="account_number" name="account_number" value="{{ old('account_number') }}">
                            @error('account_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="bank_branch" class="block text-sm font-medium text-gray-700">Bank Branch</label>
                            <input type="text" class="w-full p-2 border rounded-lg" id="bank_branch" name="bank_branch" value="{{ old('bank_branch') }}">
                            @error('bank_branch')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Supplier City <span class="text-red-500">*</span></label>
                            <input type="text" class="w-full p-2 border rounded-lg" id="city" name="city" value="{{ old('city') }}" required>
                            @error('city') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Type of Supplier <span class="text-red-500">*</span></label>
                            <select class="w-full p-2 border rounded-lg" name="type" required>
                                <option disabled selected>-- Select Type --</option>
                                <option value="Distributor">Distributor</option>
                                <option value="Whole Seller">Whole Seller</option>
                            </select>
                            @error('type') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div class="">
                            <label class="block text-sm font-medium text-gray-700">Supplier Address <span class="text-red-500">*</span></label>
                            <textarea class="w-full p-2 border rounded-lg" name="address" required>{{ old('address') }}</textarea>
                            @error('address') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
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
                        <input type="file" class="hidden" id="image" name="photo" accept="image/*" onchange="previewImage();">
                        <!-- end: Input Image -->
                    </div>
                </div>
                <!-- end: Input Data -->
    
                <div class="mt-4 flex space-x-2">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                    <a href="{{ route('suppliers.index') }}" class="bg-red-500 text-white px-4 py-2 rounded">Cancel</a>
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
            }
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection