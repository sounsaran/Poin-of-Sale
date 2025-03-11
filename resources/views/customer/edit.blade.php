@extends('Layouts.app')
@section('title', 'Products')
@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-4">
        <div class="flex justify-between items-center border-b pb-4">
            <h4 class="text-xl font-semibold">Edit Customer</h4>
        </div>

        <div class="mt-6">
            <form action="{{ route('customer.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Input Fields (2 Cols) -->
                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="name" class="block font-medium">Customer Name <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" class="w-full border rounded p-2 @error('name') border-red-500 @enderror" 
                                value="{{ old('name', $customer->name) }}" required>
                            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="shopname" class="block font-medium">Shop Name <span class="text-red-500">*</span></label>
                            <input type="text" id="shopname" name="shopname" class="w-full border rounded p-2 @error('shopname') border-red-500 @enderror" 
                                value="{{ old('shopname', $customer->shopname) }}" required>
                            @error('shopname') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="email" class="block font-medium">Email <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" class="w-full border rounded p-2 @error('email') border-red-500 @enderror" 
                                value="{{ old('email', $customer->email) }}" required>
                            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="phone" class="block font-medium">Phone <span class="text-red-500">*</span></label>
                            <input type="text" id="phone" name="phone" class="w-full border rounded p-2 @error('phone') border-red-500 @enderror" 
                                value="{{ old('phone', $customer->phone) }}" required>
                            @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="account_holder" class="block font-medium">Account Holder</label>
                            <input type="text" id="account_holder" name="account_holder" class="w-full border rounded p-2" 
                                value="{{ old('account_holder', $customer->account_holder) }}">
                        </div>
                        <div>
                            <label for="bank_name" class="block font-medium">Bank Name</label>
                            <select id="bank_name" name="bank_name" class="w-full border rounded p-2">
                                <option value="">Select Bank</option>
                                @foreach(['BRI', 'BNI', 'BCA', 'BSI', 'Mandiri'] as $bank)
                                    <option value="{{ $bank }}" @if(old('bank_name', $customer->bank_name) == $bank) selected @endif>{{ $bank }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="account_number" class="block font-medium">Account Number</label>
                            <input type="text" id="account_number" name="account_number" class="w-full border rounded p-2" 
                                value="{{ old('account_number', $customer->account_number) }}">
                        </div>
                        <div>
                            <label for="bank_branch" class="block font-medium">Bank Branch</label>
                            <input type="text" id="bank_branch" name="bank_branch" class="w-full border rounded p-2" 
                                value="{{ old('bank_branch', $customer->bank_branch) }}">
                        </div>
                        <div>
                            <label for="city" class="block font-medium">City <span class="text-red-500">*</span></label>
                            <input type="text" id="city" name="city" class="w-full border rounded p-2 @error('city') border-red-500 @enderror" 
                                value="{{ old('city', $customer->city) }}" required>
                            @error('city') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="address" class="block font-medium">Address <span class="text-red-500">*</span></label>
                            <textarea id="address" name="address" class="w-full border rounded p-2 @error('address') border-red-500 @enderror" required>{{ old('address', $customer->address) }}</textarea>
                            @error('address') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                
                    <!-- Image Upload (1 Col) -->
                    <div class="flex flex-col items-center justify-center p-4 border border-gray-300 rounded-lg">
                        <div class="w-52 h-52 rounded-lg overflow-hidden">
                            <img id="image-preview" class="w-full h-full object-cover" 
                                src="{{ $customer->photo ? asset('images/customers/'.$customer->photo) : asset('images/user.png') }}" 
                                alt="profile-pic">
                        </div>
                        <label for="photo" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">
                            Choose File
                        </label>
                        <input type="file" id="photo" name="photo" class="hidden" accept="image/*" onchange="previewImage();">
                        @error('photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>                

                <!-- Buttons -->
                <div class="flex space-x-2 mt-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                    <a href="{{ route('customer.index') }}" class="bg-red-500 text-white px-4 py-2 rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage() {
    const file = document.getElementById('photo').files[0];
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