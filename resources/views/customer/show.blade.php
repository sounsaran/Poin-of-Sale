@extends('Layouts.app')
@section('title', 'Products')
@section('content')
<div class="mx-auto p-4">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
        <!-- begin: Left Detail Employee -->
        <div class="bg-white shadow-md rounded-lg p-5">
            <div class="flex items-center mb-3">
                <div class="w-28 h-28 overflow-hidden">
                    <img src="{{ $customers->photo ? asset('images/customers/'.$customers->photo) : asset('images/logo-icon-8.jpg') }}" class="w-full h-full object-cover rounded-full" alt="profile-image">
                </div>
                <div class="ml-3">
                    <h4 class="mb-1 text-lg font-semibold">{{ $customers->name }}</h4>
                    <p class="text-gray-600 mb-2">{{ $customers->shopname }}</p>
                    <a href="{{ route('customer.edit', $customers->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm">Edit</a>
                    <a href="{{ route('customer.index') }}" class="bg-red-500 text-white px-3 py-1 rounded text-sm">Back</a>
                </div>
            </div>
            <ul class="space-y-2">
                <li class="flex items-center text-gray-600">
                    📧 {{ $customers->email }}
                </li>
                <li class="flex items-center text-gray-600">
                    📞 {{ $customers->phone }}
                </li>
                <li class="flex items-center text-gray-600">
                    📍 {{ $customers->city ? $customers->city : 'Unknown' }}
                </li>
            </ul>
        </div>
        <!-- end: Left Detail Employee -->

        <!-- begin: Right Detail Employee -->
        <div class="lg:col-span-2 bg-white shadow-md rounded-lg p-5">
            <h4 class="text-lg font-semibold mb-4">Customer Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-600">Name</label>
                    <input type="text" class="w-full bg-gray-100 p-2 rounded" value="{{ $customers->name }}" readonly>
                </div>
                <div>
                    <label class="block text-gray-600">Email</label>
                    <input type="text" class="w-full bg-gray-100 p-2 rounded" value="{{ $customers->email }}" readonly>
                </div>
                <div>
                    <label class="block text-gray-600">Phone</label>
                    <input type="text" class="w-full bg-gray-100 p-2 rounded" value="{{ $customers->phone }}" readonly>
                </div>
                <div>
                    <label class="block text-gray-600">Shop Name</label>
                    <input type="text" class="w-full bg-gray-100 p-2 rounded" value="{{ $customers->shopname }}" readonly>
                </div>
                <div>
                    <label class="block text-gray-600">Account Holder</label>
                    <input type="text" class="w-full bg-gray-100 p-2 rounded" value="{{ $customers->account_holder }}" readonly>
                </div>
                <div>
                    <label class="block text-gray-600">Bank Name</label>
                    <input type="text" class="w-full bg-gray-100 p-2 rounded" value="{{ $customers->bank_name }}" readonly>
                </div>
                <div>
                    <label class="block text-gray-600">Account Number</label>
                    <input type="text" class="w-full bg-gray-100 p-2 rounded" value="{{ $customers->account_number }}" readonly>
                </div>
                <div>
                    <label class="block text-gray-600">Bank Branch</label>
                    <input type="text" class="w-full bg-gray-100 p-2 rounded" value="{{ $customers->bank_branch }}" readonly>
                </div>
                <div>
                    <label class="block text-gray-600">City</label>
                    <input type="text" class="w-full bg-gray-100 p-2 rounded" value="{{ $customers->city }}" readonly>
                </div>
                <div>
                    <label class="block text-gray-600">Address</label>
                    <textarea class="w-full bg-gray-100 p-2 rounded" readonly>{{ $customers->address }}</textarea>
                </div>
            </div>
        </div>
        <!-- end: Right Detail Employee -->
    </div>
</div>

@endsection