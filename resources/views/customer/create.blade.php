@extends('Layouts.app')
@section('title', 'Products')
@section('content')
<div class="mx-auto p-4">
    <div class="grid grid-cils-1">
        <div class="w-full">
            <div class="bg-white shadow-lg rounded-lg p-4">
                <div class="flex justify-between items-center border-b pb-4">
                    <h4 class="text-xl font-semibold">Add Customer</h4>
                </div>
                <div class="mt-6">
                    <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- begin: Input Data -->
                            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Customer Name <span class="text-red-500">*</span></label>
                                    <input type="text" id="name" name="name" class="w-full border rounded-md p-2" value="{{ old('name') }}" required>
                                </div>
                                <div>
                                    <label for="shopname" class="block text-sm font-medium text-gray-700">Shop Name <span class="text-red-500">*</span></label>
                                    <input type="text" id="shopname" name="shopname" class="w-full border rounded-md p-2" value="{{ old('shopname') }}" required>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Customer Email <span class="text-red-500">*</span></label>
                                    <input type="email" id="email" name="email" class="w-full border rounded-md p-2" value="{{ old('email') }}" required>
                                </div>
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Customer Phone <span class="text-red-500">*</span></label>
                                    <input type="text" id="phone" name="phone" class="w-full border rounded-md p-2" value="{{ old('phone') }}" required>
                                </div>
                                <div>
                                    <label for="account_holder" class="block text-sm font-medium text-gray-700">Account Holder</label>
                                    <input type="text" class="w-full border rounded-md p-2" id="account_holder" name="account_holder" value="{{ old('account_holder') }}">
                                </div>
                                <div>
                                    <label for="bank_name" class="block text-sm font-medium text-gray-700">Bank Name <span class="text-red-500">*</span></label>
                                    <select class="w-full p-2 border rounded-lg" name="bank_name">
                                        <option disabled selected>-- Select Supplier --</option>
                                        <option value="ABA">ABA</option>
                                        <option value="Wing">Wing</option>
                                        <option value="ACLida">AC Lida</option>
                                        <option value="AMK">AMK</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="bank_name" class="block text-sm font-medium text-gray-700">Account Number <span class="text-red-500">*</span></label>
                                    <input type="text" class="w-full border rounded-md p-2" id="account_number" name="account_number" value="{{ old('account_number') }}">
                                </div>
                                <div>
                                    <label for="bank_branch" class="block text-sm font-medium text-gray-700">Bank Branch <span class="text-red-500">*</span></label>
                                    <input type="text" class="w-full border rounded-md p-2" id="bank_branch" name="bank_branch" value="{{ old('bank_branch') }}">
                                </div>
                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700">Customer City <span class="text-red-500">*</span></label>
                                    <input type="text" class="w-full border rounded-md p-2" id="city" name="city" value="{{ old('city') }}" required>
                                </div>
                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700">Customer Address <span class="text-red-500">*</span></label>
                                    <textarea id="address" name="address" class="w-full border rounded-md p-2" required>{{ old('address') }}</textarea>
                                    @error('address')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                                </div>
                                <!-- end: Input Data -->
                            </div>

                            <div class="flex flex-col items-center justify-center p-4 border border-gray-300 rounded-lg">
                                <!-- begin: Input Image -->
                                <div class="w-52 h-52 rounded-lg overflow-hidden">
                                    <img id="image-preview" class="w-full h-full object-cover" src="{{ asset('images/images.png') }}" alt="profile-pic">
                                </div>
                                <label for="image" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">
                                    Choose File
                                </label>
                                {{-- <input type="file" class="hidden" id="photo" name="photo" accept="image/*" onchange="previewImage();"> --}}
                                <input type="file" class="hidden" id="image" name="photo" accept="image/*" onchange="previewImage();">
                            </div>
                        </div>
                        <!-- end: Input Image -->
                        <div class="mt-4 flex space-x-2">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Save</button>
                            <a href="{{ route('customer.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-md">Cancel</a>
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