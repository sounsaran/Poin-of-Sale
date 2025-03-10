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
        <a class="block py-2.5 px-4 hover:bg-gray-700 {{ request()->is('pos') ? 'bg-gray-700' : '' }}" href="" >
            <i class="fas fa-shopping-cart w-[35px]"></i> POS
        </a>
        <a class="block py-2.5 px-4 hover:bg-gray-700 {{ request()->is('product') ? 'bg-gray-700' : '' }}" href="/" >
            <i class="fas fa-archive w-[35px]"></i> Poducts
        </a>
        <a class="block py-2.5 px-4 hover:bg-gray-700 {{ request()->is('product') ? 'bg-gray-700' : '' }}" href="/product" >
            <i class="fas fa-archive w-[35px]"></i> Poducts show
        </a>
        <a class="block px-4 py-2 5 hover:bg-gray-700 {{ request()->is('order-list') ? 'bg-gray-700' : '' }}" href="/orderList">
            <i class="fas fa-list w-[35px]"></i> Order List
        </a>
        <a class="block px-4 py-2 5 hover:bg-gray-700 {{ request()->is('analytics') ? 'bg-gray-700' : '' }}" href="#">
            <i class="fas fa-chart-pie w-[35px]"></i>Analytics
        </a>
        <a class="block px-4 py-2 5 hover:bg-gray-700 {{ request()->is('stock') ? 'bg-gray-700' : '' }}" href="#">
            <i class="fas fa-database w-[35px]"></i>Stock
        </a>
        <a class="block px-4 py-2 5 hover:bg-gray-700 {{ request()->is('total-order') ? 'bg-gray-700' : '' }}" href="#">
            <i class="fas fa-clipboard-list w-[35px]"></i>Total Order
        </a>
        <a class="block px-4 py-2 5 hover:bg-gray-700{{ request()->is('team') ? 'bg-gray-700' : '' }}" href="#">
            <i class="fas fa-users w-[35px]"></i>Team
        </a>
        <a class="block px-4 py-2 5 hover:bg-gray-700 {{ request()->is('setting') ? 'bg-gray-700' : '' }}" href="#">
            <i class="fas fa-cog w-[35px]"></i>Setting
        </a>
        <!-- <div class="group">
            Dropdown Toggle
            <div data-dropdown-toggle="dropdownMenu2" class="py-2.5 px-4 hover:bg-gray-700 flex items-center">
                <i class="fas fa-boxes w-[35px] mr-1"></i> Products <i class="ml-auto fas fa-angle-left icon"></i>
            </div>
            Dropdown Links
            <div id="dropdownMenu2" class="hidden ml-3 bg-gray-800">
                <hr class="">
                <a href="#" class="block py-2.5 px-4 hover:bg-gray-700 pl-8"><i class="fas fa-boxes w-[35px]"></i> Product</a>
                <a href="#" class="block py-2.5 px-4 hover:bg-gray-700 pl-8">Service 2</a>
                <a href="#" class="block py-2.5 px-4 hover:bg-gray-700 pl-8">Service 3</a>
                <hr class="">
            </div>
        </div> -->
    </nav>
    <!-- End Sidebar Link -->
</div>