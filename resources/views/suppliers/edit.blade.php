@extends('Layouts.app')
@section('title', 'Products')
@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h4 class="text-lg font-semibold">Edit Supplier</h4>
        </div>

        <div>
            <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Supplier Name <span class="text-red-500">*</span></label>
                            <input type="text" class="w-full p-2 border rounded-lg" id="name" name="name" value="{{ old('name', $supplier->name) }}" required>
                            @error('name') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Shop Name <span class="text-red-500">*</span></label>
                            <input type="text" class="w-full p-2 border rounded-lg" id="shopname" name="shopname" value="{{ old('shopname', $supplier->shopname) }}" required>
                            @error('shopname') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Supplier Email <span class="text-red-500">*</span></label>
                            <input type="email" class="w-full p-2 border rounded-lg" id="email" name="email" value="{{ old('email', $supplier->email) }}" required>
                            @error('email') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Supplier Phone <span class="text-red-500">*</span></label>
                            <input type="text" class="w-full p-2 border rounded-lg" id="phone" name="phone" value="{{ old('phone', $supplier->phone) }}" required>
                            @error('phone') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="account_holder" class="block text-sm font-medium text-gray-700">Account Holder</label>
                            <input type="text" class="w-full p-2 border rounded-lg" id="account_holder" name="account_holder" value="{{ old('account_holder', $supplier->account_holder) }}">
                            @error('account_holder')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Bank Name</label>
                            <select class="w-full p-2 border rounded-lg" name="bank_name">
                                <option disabled selected>-- Select Supplier --</option>
                                @foreach(['ABA', 'Wing', 'ACLida', 'AMK'] as $bank)
                                    <option value="{{ $bank }}" @if(old('bank_name', $supplier->bank_name) == $bank) selected @endif>{{ $bank }}</option>
                                @endforeach
                            </select>
                            @error('bank_name') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="account_number" class="block text-sm font-medium text-gray-700">Account Number</label>
                            <input type="text" class="w-full p-2 border rounded-lg" id="account_number" name="account_number" value="{{ old('account_number', $supplier->account_number) }}">
                            @error('account_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="bank_branch" class="block text-sm font-medium text-gray-700">Bank Branch</label>
                            <input type="text" class="w-full p-2 border rounded-lg" id="bank_branch" name="bank_branch" value="{{ old('bank_branch', $supplier->bank_branch) }}">
                            @error('bank_branch')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Supplier City <span class="text-red-500">*</span></label>
                            <input type="text" class="w-full p-2 border rounded-lg" id="city" name="city" value="{{ old('city', $supplier->city) }}" required>
                            @error('city') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Type of Supplier <span class="text-red-500">*</span></label>
                            <select class="w-full p-2 border rounded-lg" name="type" required>
                                <option disabled selected>-- Select Type --</option>
                                <option value="Distributor" @if(old('type', $supplier->type) == 'Distributor')selected="selected"@endif>Distributor</option>
                                <option value="Whole Seller" @if(old('type', $supplier->type) == 'Whole Seller')selected="selected"@endif>Whole Seller</option>
                            </select>
                            @error('type') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div class="">
                            <label class="block text-sm font-medium text-gray-700">Supplier Address <span class="text-red-500">*</span></label>
                            <textarea class="w-full p-2 border rounded-lg" name="address" required>{{ old('address', $supplier->address) }}</textarea>
                            @error('address') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    
                    <div class="flex flex-col items-center justify-center p-4 border border-gray-300 rounded-lg">
                        <!-- Image Preview -->
                        <div class="w-52 h-52 rounded-lg overflow-hidden">
                            <img id="image-preview" class="w-full h-full object-cover" src="{{ $supplier->photo ? asset('images/supplier/'.$supplier->photo) : asset('images/user.png') }}" alt="profile-pic">
                        </div>
                        
                        <label for="image" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">Choose file</label>
                        <input type="file" class="hidden" name="photo" id="image" accept="image/*" onchange="previewImage();">
                        @error('photo')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                
                
                <!-- Submit Buttons -->
                <div class="mt-6 flex justify-start space-x-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow">Update</button>
                    <a href="{{ route('suppliers.index') }}" class="px-4 py-2 bg-red-600 text-white rounded-md shadow">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection