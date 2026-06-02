<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Activity - Admin TUTURO</title>
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
                <h1 class="text-2xl font-bold mb-6">Edit Activity</h1>

                <form action="{{ route('admin.activities.update', $activity->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Judul</label>
                        <input type="text" name="judul" value="{{ $activity->judul }}" 
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
                        <input type="text" name="kategori" value="{{ $activity->kategori }}" 
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Durasi (menit)</label>
                        <input type="number" name="durasi_menit" value="{{ $activity->durasi_menit }}" 
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" 
                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required>{{ $activity->deskripsi }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Panduan</label>
                        <textarea name="panduan" rows="4" 
                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">{{ $activity->panduan }}</textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                            <i class="fa-solid fa-save"></i> Update
                        </button>
                        <a href="{{ route('admin.activities.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>