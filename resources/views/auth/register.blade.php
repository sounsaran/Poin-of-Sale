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
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center text-gray-700">CREATE ACCOUNT</h2>
            <form action="register" method="POST">
                @csrf
                <div class="mt-4">
                    <label class="block text-gray-700">Your Name</label>
                    <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div class="mt-4">
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div class="mt-4">
                    <label class="block text-gray-700">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div class="mt-4">
                    <label class="block text-gray-700">Comfirm Password</label>
                    <input type="password" name="passwordcomfirm" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <a href="/login" class="text-blue-600">I Have Account</a>
                <div class="mt-4">
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>