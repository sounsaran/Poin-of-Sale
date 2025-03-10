@extends('Layouts.app')
@section('title', 'Products')
@section('content')
<div class="container mx-auto p-4">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <!-- begin: Left Detail Employee -->
        <div class="bg-white shadow-md rounded-lg p-5">
            <div class="flex items-center mb-3 space-x-5">
                <div class="relative w-28 h-28">
                    <img src="{{ $supplier->photo ? asset('images/supplier/'.$supplier->photo) : asset('images/1.png') }}" class="rounded-full w-full h-full object-cover" alt="profile-image">
                </div>
                <div class="ml-3">
                    <h4 class="text-lg font-semibold">{{ $supplier->name }}</h4>
                    <p class="text-gray-500 mb-4">{{ $supplier->shopname }}</p>
                    <a href="{{ route('suppliers.edit', $supplier->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded text-sm">Edit</a>
                    <a href="{{ route('suppliers.index') }}" class="bg-red-500 text-white px-4 py-2 rounded text-sm">Back</a>
                </div>
            </div>
            <ul class="space-y-2">
                <li class="flex items-center text-gray-700 space-x-4">
                    <i class="far fa-envelope"></i>
                    <p>{{ $supplier->email }}</p>
                </li>
                <li class="flex items-center text-gray-700 space-x-4">
                    <i class="fas fa-phone-alt"></i>
                    <p>{{ $supplier->phone }}</p>
                </li>
                <li class="flex items-center text-gray-700 space-x-4">
                    <i class="fas fa-map-marker-alt"></i>
                    <p> {{ $supplier->city ?? 'Unknown' }}</p>
                </li>
            </ul>
        </div>
        <!-- end: Left Detail Employee -->

        <!-- begin: Right Detail Employee -->
        <div class="lg:col-span-2 bg-white shadow-md rounded-lg p-5">
            <h4 class="text-lg font-semibold mb-4">Supplier Information</h4>
            <div class="space-y-3">
                @foreach(['name', 'email', 'phone', 'shopname', 'type', 'account_holder', 'bank_name', 'account_number', 'bank_branch', 'city'] as $field)
                    <div class="grid grid-cols-3 items-center">
                        <label class="text-gray-700 font-medium">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                        <div class="col-span-2">
                            <input type="text" class="w-full bg-gray-100 p-2 rounded border border-gray-300" value="{{ $supplier->$field }}" readonly>
                        </div>
                    </div>
                @endforeach
                <div class="grid grid-cols-3 items-start">
                    <label class="text-gray-700 font-medium">Address</label>
                    <div class="col-span-2">
                        <textarea class="w-full bg-gray-100 p-2 rounded border border-gray-300" readonly>{{ $supplier->address }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- end: Right Detail Employee -->
    </div>
</div>
@endsection