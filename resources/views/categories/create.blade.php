@extends('Layouts.app')
@section('title', 'Products')
@section('content')
<div class="container mx-auto p-4">
    <div class="flex flex-col">
        <div class="w-full">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex justify-between items-center border-b pb-4">
                    <h4 class="text-lg font-semibold">Create Category</h4>
                </div>

                <div class="mt-4">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <!-- begin: Input Data -->
                        <div class="grid grid-cols-1 gap-4">
                            <div class="flex flex-col">
                                <label for="name" class="font-medium">Category Name <span class="text-red-500">*</span></label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                                    class="border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex flex-col">
                                <label for="description" class="font-medium">Category Description <span class="text-red-500">*</span></label>
                                <input type="text" id="description" name="description" value="{{ old('description') }}" required 
                                    class="border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror">
                                @error('description')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <!-- end: Input Data -->
                        <div class="mt-4 flex space-x-2">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Save</button>
                            <a href="{{ route('categories.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Description Generator
    const title = document.querySelector("#name");
    const description = document.querySelector("#description");
    title.addEventListener("keyup", function() {
        let preDescription = title.value;
        preDescription = preDescription.replace(/ /g, "-");
        description.value = preDescription.toLowerCase();
    });
</script>

@endsection