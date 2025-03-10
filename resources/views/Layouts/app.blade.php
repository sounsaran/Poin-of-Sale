<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans leading-normal tracking-normal">
    <div class="flex bg-gray-300">
        <!-- Start Sidebar -->
        @include('Layouts.sidebar')
        <!-- End Sidebar -->

        <!-- Start Main Navbar -->
        <div class="flex-1 w-5/6 ml-1/5">
            @include('Layouts.navbar')

            <!-- Start input main page -->
            @yield('content')
            <!-- Start input main page -->
        </div>
        <!-- End Main Navbar -->
    </div>

    <!-- Start Script -->
    <script src="js/script.js"></script>
    <!-- End Script -->
</body>
</html>