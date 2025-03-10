@extends('Layouts.app')
@section('title', 'Products')
@section('content')
<div class="container mx-auto p-4">
    <div class="flex flex-wrap items-center justify-between mb-4">
        @if (session()->has('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button type="button" class="text-white" onclick="this.parentElement.style.display='none'">&times;</button>
            </div>
        @endif
        <div>
            <h4 class="text-xl font-bold mb-2">Customer List</h4>
            <p class="text-gray-600">A customer dashboard lets you easily gather and visualize customer data...</p>
        </div>
        <div class="space-x-2">
            <a href="{{ route('customer.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"><i class="fas fa-user-plus"></i> Add Customer</a>
            <a href="" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"><i class="fas fa-trash-alt"></i> Clear Search</a>
        </div>
    </div>
    
    <div class="w-full">
        <form action="{{ route('customer.index') }}" method="get" class="flex flex-wrap items-center justify-between" id="filterForm">
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
                <a href="{{ route('customer.index') }}" class="bg-red-500 text-white px-4 py-2 rounded"><i class="fas fa-window-close"></i></a>
            </div>
        </form>
    </div>
    
    <div class="w-full mt-4">
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="w-full text-center border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3">No.</th>
                        <th class="p-3">Photo</th>
                        <th class="p-3">Name</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Phone</th>
                        <th class="p-3">Shopname</th>
                        <th class="p-3">Action</th>
                    </tr>
                </thead>
                <tbody id="Table">
                    @forelse ($customers as $customer)
                    <tr class="border-b">
                        <td class="p-3">{{ (($customers->currentPage() * 10) - 10) + $loop->iteration  }}</td>
                        <td class="p-3 w-20">
                            <div class="flex justify-center items-center w-16 h-16 rounded-lg overflow-hidden">
                                <img class="w-full h-full object-cover" src="{{ $customer->photo ? asset('images/customers/'.$customer->photo) : asset('images/logo-icon-8.jpg') }}">
                            </div>
                        </td>
                        <td class="p-3">{{ $customer->name }}</td>
                        <td class="p-3">{{ $customer->email }}</td>
                        <td class="p-3">{{ $customer->phone }}</td>
                        <td class="p-3">{{ $customer->shopname }}</td>
                        <td class="p-3">
                            <div class="flex space-x-2 justify-center items-center">
                                <a class="bg-blue-500 text-white px-3 py-1 rounded" href="{{ route('customer.show', $customer->id) }}"><i class="fas fa-eye"></i></a>
                                <a class="bg-green-500 text-white px-3 py-1 rounded" href="{{ route('customer.edit', $customer->id) }}"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded" onclick=""><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-3">Not Found</td>
                    </tr>
                    @endforelse
                    
                </tbody>
            </table>
        </div>
    </div>
    <!-- Pagination -->
    <div class="mt-4" id="pagination">
        {{ $customers->appends(request()->query())->links() }}
    </div>
</div>
<!-- JavaScript to auto-submit when row selection changes -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const rowSelect = document.getElementById("rowSelect");
        const searchInput = document.getElementById("search");
        const filterForm = document.getElementById("filterForm");
        
        function fetchCategories() {
            const formData = new FormData(filterForm);
            const queryParams = new URLSearchParams(formData).toString();

            fetch("{{ route('customer.index') }}?" + queryParams, {
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