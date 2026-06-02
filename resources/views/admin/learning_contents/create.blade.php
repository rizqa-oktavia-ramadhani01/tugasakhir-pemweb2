<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Learning Content - Admin TUTURO</title>
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
                <a href="{{ route('admin.activities.index') }}" class="flex items-center py-3 px-5 hover:bg-indigo-700">
                    <i class="fa-solid fa-list-check w-5"></i>
                    <span class="ml-3">Activities</span>
                </a>
                <a href="{{ route('admin.learning-contents.index') }}" class="flex items-center py-3 px-5 bg-indigo-700">
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
                <a href="{{ route('admin.learning-contents.index') }}" class="text-indigo-600 hover:text-indigo-800">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6 max-w-2xl mx-auto">
                <h1 class="text-2xl font-bold mb-6">Tambah Learning Content</h1>

                <form action="{{ route('admin.learning-contents.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Judul -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Judul</label>
                        <input type="text" name="judul"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                            required>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
                        <select name="kategori"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                            required>
                            <option value="">Pilih Kategori</option>
                            <option value="Pronunciation">Pronunciation</option>
                            <option value="Sound_Imitation">Sound Imitation</option>
                            <option value="artikel">Artikel</option>
                            <option value="storytelling">Storytelling</option>
                        </select>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                        <textarea name="deskripsi" rows="3"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                            required></textarea>
                    </div>

                    <!-- Isi -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Isi Konten</label>
                        <textarea name="isi" rows="5"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                            required></textarea>
                    </div>

                    <!-- Gambar -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Gambar</label>
                        <input type="file" name="gambar"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500"
                            accept="image/*">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                    </div>

                    <!-- Audio -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Audio</label>
                        <input type="file" name="audio"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500"
                            accept=".mp3,.wav,.aac,.ogg">
                        <p class="text-xs text-gray-500 mt-1">Format: MP3, WAV, AAC</p>
                    </div>

                    <!-- Tombol -->
                    <div class="flex gap-3 mt-6">
                        <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition">
                            <i class="fa-solid fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('admin.learning-contents.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
                            <i class="fa-solid fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>