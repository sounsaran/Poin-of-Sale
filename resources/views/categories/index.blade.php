@extends('Layouts.app')
@section('title', 'Products')
@section('content')
<div class="container mx-auto px-4">
    <div class="w-full">
        @if (session()->has('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button type="button" class="text-white" onclick="this.parentElement.style.display='none'">&times;</button>
            </div>
        @endif
        <div class="flex flex-wrap justify-between items-center mb-4">
            <div>
                <h4 class="text-lg font-semibold">Category List</h4>
                <p class="text-gray-600">A Category dashboard lets you easily gather and visualize Category data from optimizing <br>
                    the Category experience, ensuring Category retention. </p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md flex items-center">
                    <i class="fas fa-plus mr-2"></i> Create Category
                </a>
                <a href="{{ route('categories.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-md flex items-center">
                    Clear Search
                </a>
            </div>
        </div>
    </div>

    <div class="w-full mb-4">
        <form action="{{ route('categories.index') }}" method="get" class="flex flex-wrap justify-between" id="filterForm">
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
                <input type="text" id="search" class="border p-2 rounded" name="search" placeholder="Search category" value="{{ request('search') }}">
                <a href="{{ route('categories.index') }}" class="bg-red-500 text-white px-4 py-2 rounded"><i class="fas fa-window-close"></i></a>
            </div>
        </form>
    </div>
    
    <div class="w-full overflow-x-auto">
        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="w-full border-collapse border border-gray-800">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2">No.</th>
                        <th class="border p-2">Name</th>
                        <th class="border p-2">Description</th>
                        <th class="border p-2">Action</th>
                    </tr>
                </thead>
                <tbody id="categoryTable">
                    @forelse ($categories as $category)
                    <tr class="border">
                        <td class="border p-2 w-14 text-center">
                            {{ ($categories->firstItem() + $loop->index) }}
                        </td>
                        <td class="border p-2">{{ $category->name }}</td>
                        <td class="border p-2">{{ $category->description }}</td>
                        <td class="border p-2 w-48">
                            <div class="flex space-x-2 justify-center items-center">
                                <a href="{{ route('categories.edit', $category->id) }}" class="bg-green-500 text-white px-3 py-1 rounded">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded" onclick="return confirm('Are you sure you want to delete this record?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>                                
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center bg-red-500 text-white p-4">Data not Found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4" id="pagination">
        {{ $categories->appends(request()->query())->links() }}
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

            fetch("{{ route('categories.index') }}?" + queryParams, {
                headers: { "X-Requested-With": "XMLHttpRequest" }
            })
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(data, "text/html");

                document.getElementById("categoryTable").innerHTML = doc.querySelector("#categoryTable").innerHTML;
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