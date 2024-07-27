<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>All Posts</title>
</head>
<body class="bg-gray-100 h-screen flex">
    <!-- Sidebar -->
    <div class="w-64 bg-gray-200 text-white flex flex-col">
        <div class="flex flex-col p-4 space-y-2">
            <a href="#" class="flex items-center p-2 hover:bg-blue-700  rounded" onclick="showSection('user')">
                <span class="material-icons mr-3 text-black hover:text-white">person</span>
                <span class="text-xl font-bold  hover:text-white text-black">User</span>
            </a>
            
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Toolbar -->
        <div class="flex justify-between items-center p-4 bg-white shadow-md">
            <h1 class="text-xl font-bold">All Posts</h1>
            <form action="/logout" method="POST" class="ml-4">
                @csrf
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Log out
                </button>
            </form>
        </div>

        <!-- Content Sections -->
        <div class="p-8 flex-1 overflow-auto">
            <div id="user" class="content-section">
                <p>  @include('allusers') .</p>
            </div>
            <div id="product" class="content-section hidden">
                <p>Product section content goes here.</p>
            </div>
        </div>
    </div>

    <script>
        function showSection(section) {
            document.querySelectorAll('.content-section').forEach((el) => el.classList.add('hidden'));
            document.getElementById(section).classList.remove('hidden');
        }
    </script>

    <!-- Material Icons CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</body>
</html>
