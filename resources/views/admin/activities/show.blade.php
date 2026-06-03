<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Activity - Admin TUTURO</title>
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
                <a href="{{ route('admin.dashboard') }}" class="flex items-center py-3 px-5 hover:bg-indigo-700">
                    <i class="fa-solid fa-chart-line w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                <a href="{{ route('admin.activities.index') }}" class="flex items-center py-3 px-5 bg-indigo-700">
                    <i class="fa-solid fa-list-check w-5"></i>
                    <span class="ml-3">Activities</span>
                </a>
                <a href="{{ route('admin.learning-contents.index') }}" class="flex items-center py-3 px-5 hover:bg-indigo-700">
                    <i class="fa-solid fa-book-open w-5"></i>
                    <span class="ml-3">Learning Contents</span>
                </a>
                <hr class="my-4 border-indigo-700">
                <form action="{{ route('logout') }}" method="POST" class="mt-5">
                    @csrf
                    <button type="submit" class="flex items-center py-3 px-5 w-full hover:bg-red-600 text-left">
                        <i class="fa-solid fa-right-from-bracket w-5"></i>
                        <span class="ml-3">Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <main class="flex-1 p-6">
            <div class="mb-6">
                <a href="{{ route('admin.activities.index') }}" class="text-indigo-600 hover:text-indigo-800">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6 max-w-2xl mx-auto">
                <h1 class="text-2xl font-bold mb-6">Detail Activity</h1>

                <div class="space-y-4">
                    <div class="border-b pb-3">
                        <label class="block text-gray-500 text-sm">Judul</label>
                        <p class="font-semibold text-lg">{{ $activity->judul }}</p>
                    </div>

                    <div class="border-b pb-3">
                        <label class="block text-gray-500 text-sm">Kategori</label>
                        <p><span class="px-2 py-1 bg-indigo-100 text-indigo-800 rounded-full text-xs">{{ $activity->kategori }}</span></p>
                    </div>

                    <div class="border-b pb-3">
                        <label class="block text-gray-500 text-sm">Durasi</label>
                        <p>{{ $activity->durasi_menit ?? '-' }} menit</p>
                    </div>

                    <div class="border-b pb-3">
                        <label class="block text-gray-500 text-sm">Deskripsi</label>
                        <p class="whitespace-pre-line">{{ $activity->deskripsi }}</p>
                    </div>

                    <div class="border-b pb-3">
                        <label class="block text-gray-500 text-sm">Panduan</label>
                        <p class="whitespace-pre-line">{{ $activity->panduan ?? '-' }}</p>
                    </div>
                </div>

                <div class="flex gap-3 mt-6">
                    <a href="{{ route('admin.activities.edit', $activity->id) }}" class="bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-600">
                        <i class="fa-solid fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.activities.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                        Kembali
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>