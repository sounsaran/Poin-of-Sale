@extends('Layouts.app')
@section('title', 'Products')
@section('content')
<div class="container mx-auto px-4">
    <div class="w-full">
        @if (session()->has('success'))
            <div class="bg-green-500 text-white p-4 rounded-md flex justify-between items-center">
                <div>{{ session('success') }}</div>
                <button type="button" class="text-white" onclick="this.parentElement.style.display='none';">
                    &times;
                </button>
            </div>
        @endif
        <div class="flex flex-wrap justify-between items-center mb-4">
            <div>
                <h4 class="text-xl font-bold mb-2">Supplier List</h4>
                <p class="text-gray-600">A supplier dashboard lets you easily gather and visualize supplier data...</p>
            </div>
            <div class="space-x-2">
                <a href="{{ route('suppliers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">+ Add Supplier</a>
                <a href="{{ route('suppliers.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-md">Clear Search</a>
            </div>
        </div>
    </div>

    <div class="w-full">
        <form action="{{ route('suppliers.index') }}" method="get" class="flex flex-wrap items-center justify-between" id="filterForm">
            <div class="flex items-center space-x-2">
                <label for="row">Row:</label>
                <select class="border rounded p-2" name="row" id="rowSelect">
                    <option value="10" {{ request('row', 10) == '10' ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('row') == '25' ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('row') == '50' ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('row') == '100' ? 'selected' : '' }}>100</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label for="search">Search:</label>
                <input type="text" id="search" class="border p-2 rounded" name="search" placeholder="Search product" value="{{ request('search') }}">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded"><i class="fas fa-search"></i></button>
                <a href="{{ route('suppliers.index') }}" class="bg-red-500 text-white px-4 py-2 rounded"><i class="fas fa-window-close"></i></a>
            </div>
        </form>
    </div>

    <div class="w-full mt-4">
        <div class="overflow-x-auto bg-white shadow-md rounded-md">
            <table class="w-full text-center border-collapse">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3">No.</th>
                        <th class="p-3">Photo</th>
                        <th class="p-3">@sortablelink('name')</th>
                        <th class="p-3">@sortablelink('email')</th>
                        <th class="p-3">@sortablelink('phone')</th>
                        <th class="p-3">@sortablelink('shopname')</th>
                        <th class="p-3">@sortablelink('type')</th>
                        <th class="p-3">Action</th>
                    </tr>
                </thead>
                <tbody id="Table">
                    @foreach ($suppliers as $supplier)
                    <tr class="border-t">
                        <td class="p-3">{{ (($suppliers->currentPage() * 10) - 10) + $loop->iteration }}</td>
                        <td class="p-3">
                            <div class="flex justify-center items-center w-16 h-16 rounded-lg overflow-hidden">
                                <img class="w-full h-full object-cover" src="{{ $supplier->photo ? asset('images/supplier/'.$supplier->photo) : asset('images/1.png') }}">
                            </div>
                        </td>
                        <td class="p-3">{{ $supplier->name }}</td>
                        <td class="p-3">{{ $supplier->email }}</td>
                        <td class="p-3">{{ $supplier->phone }}</td>
                        <td class="p-3">{{ $supplier->shopname }}</td>
                        <td class="p-3">{{ $supplier->type }}</td>
                        <td class="p-3">
                            <div class="flex space-x-2 justify-center items-center">
                                <a href="{{ route('suppliers.show', $supplier->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded"><i class="fas fa-eye"></i> View</a>
                                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="bg-green-500 text-white px-3 py-1 rounded"><i class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded"><i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4" id="pagination">
            {{ $suppliers->appends(request()->query())->links() }}
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const rowSelect = document.getElementById("rowSelect");
        const searchInput = document.getElementById("search");
        const filterForm = document.getElementById("filterForm");
        
        function fetchCategories() {
            const formData = new FormData(filterForm);
            const queryParams = new URLSearchParams(formData).toString();

            fetch("{{ route('suppliers.index') }}?" + queryParams, {
                headers: { "X-Requested-With": "XMLHttpRequest" }
            })
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(data, "text/html");

                document.getElementById("Table").innerHTML = doc.querySelector("#Table").innerHTML;
                document.getElementById("pagination").innerHTML = doc.querySelector("#pagination").innerHTML;
            })
            .catch(error => console.error("Error fetching data:", error));
        }

        rowSelect.addEventListener("change", fetchCategories);
        searchInput.addEventListener("input", () => {
            clearTimeout(window.searchTimeout);
            window.searchTimeout = setTimeout(fetchCategories, 500);
        });
    });
</script>
@endsection