<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TUTURO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-indigo-800 text-white">
            <div class="p-5 text-center border-b border-indigo-700">
                <i class="fa-solid fa-shapes text-3xl"></i>
                <h1 class="text-xl font-bold mt-2">TUTURO Admin</h1>
            </div>
            <nav class="mt-5">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center py-3 px-5 bg-indigo-700">
                    <i class="fa-solid fa-chart-line w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                <a href="{{ route('admin.activities.index') }}" class="flex items-center py-3 px-5 hover:bg-indigo-700">
                    <i class="fa-solid fa-list-check w-5"></i>
                    <span class="ml-3">Activities</span>
                </a>
                <a href="{{ route('admin.learning-contents.index') }}" class="flex items-center py-3 px-5 hover:bg-indigo-700">
                    <i class="fa-solid fa-book-open w-5"></i>
                    <span class="ml-3">Learning Contents</span>
                </a>
                <hr class="my-4 border-indigo-700">
                <a href="{{ route('logout.confirm') }}" class="flex items-center py-3 px-5 w-full hover:bg-red-600 text-left">
                    <i class="fa-solid fa-right-from-bracket w-5"></i>
                    <span class="ml-3">Logout</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 p-6">
            <!-- Header dengan judul dan nama user -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Dashboard Admin</h1>
                <div class="bg-white px-4 py-2 rounded-lg shadow">
                    <i class="fa-regular fa-user mr-2"></i>
                    {{ Auth::user()->name }}
                </div>
            </div>

            <!-- TOMBOL EXPORT EXCEL (DITAMBAHKAN DI SINI) -->
            <div class="mb-6 flex justify-end">
                <a href="{{ route('admin.export.parents') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow transition flex items-center gap-2">
                    <i class="fa-solid fa-file-excel"></i>
                    Export Data Orang Tua ke Excel
                </a>
            </div>

            <!-- Kartu Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500">Total Orang Tua</p>
                            <p class="text-3xl font-bold text-indigo-600">{{ $totalParents }}</p>
                        </div>
                        <i class="fa-solid fa-users text-4xl text-indigo-400"></i>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500">Total Activities</p>
                            <p class="text-3xl font-bold text-green-600">{{ $totalActivities }}</p>
                        </div>
                        <i class="fa-solid fa-list-check text-4xl text-green-400"></i>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500">Total Learning Contents</p>
                            <p class="text-3xl font-bold text-purple-600">{{ $totalContents }}</p>
                        </div>
                        <i class="fa-solid fa-book-open text-4xl text-purple-400"></i>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>