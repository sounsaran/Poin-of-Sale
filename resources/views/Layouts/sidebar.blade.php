<div class="sticky top-0 z-50 w-1/6 h-screen text-white bg-gray-900 ml-1/5">
    <!-- Start Name System -->
    <div class="p-2 pt-3 pl-4 text-lg font-semibold">
        Monkey
    </div>
    <!-- End Name System -->
    <!-- Start Sidebar Link -->
    <nav class="mt-1">
        <a class="block py-2.5 px-4 hover:bg-gray-700 {{ request()->is('dashboard') ? 'bg-gray-700' : '' }}" href="{{ route('dashboard') }}">
            <i class="fas fa-th-large w-[35px]"></i> Dashboard
        </a>
        {{-- <a class="block py-2.5 px-4 hover:bg-gray-700 {{ request()->is('pos') ? 'bg-gray-700' : '' }}" href="/pos" >
            <i class="fas fa-shopping-cart w-[35px]"></i> POS
        </a> --}}
        <a class="block py-2.5 px-4 hover:bg-gray-700 {{ request()->is('categories') ? 'bg-gray-700' : '' }}" href="/categories" >
            <i class="fas fa-cubes w-[35px]"></i> Categories
        </a>
        <a class="block py-2.5 px-4 hover:bg-gray-700 {{ request()->is('products') ? 'bg-gray-700' : '' }}" href="/products" >
            <i class="fas fa-archive w-[35px]"></i> Poducts
        </a>
        <a class="block py-2.5 px-4 hover:bg-gray-700 {{ request()->is('customer') ? 'bg-gray-700' : '' }}" href="/customer" >
            <i class="fas fa-users w-[35px]"></i> Customers
        </a>
        <a class="block py-2.5 px-4 hover:bg-gray-700 {{ request()->is('suppliers') ? 'bg-gray-700' : '' }}" href="/suppliers" >
            <i class="fas fa-cubes w-[35px]"></i> Supplier
        </a>
    </nav>
    <!-- End Sidebar Link -->
</div>