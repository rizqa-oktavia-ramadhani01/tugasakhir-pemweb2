<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Learning Content - Admin TUTURO</title>
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

            <div class="bg-white rounded-lg shadow p-6 max-w-3xl mx-auto">
                <h1 class="text-2xl font-bold text-indigo-600 mb-4">{{ $content->judul }}</h1>

                <!-- Kategori -->
                <div class="mb-4">
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        @if($content->kategori == 'Pronunciation') bg-blue-100 text-blue-800
                        @elseif($content->kategori == 'Sound Imitation') bg-green-100 text-green-800
                        @elseif($content->kategori == 'Artikel') bg-yellow-100 text-yellow-800
                        @else bg-purple-100 text-purple-800
                        @endif">
                        <i class="fa-solid fa-tag mr-1"></i> {{ $content->kategori }}
                    </span>
                </div>

                <!-- Deskripsi -->
                <div class="mb-6 border-b pb-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">
                        <i class="fa-solid fa-align-left mr-2"></i> Deskripsi
                    </h3>
                    <p class="text-gray-600 leading-relaxed">{{ $content->deskripsi }}</p>
                </div>

                <!-- Isi -->
                <div class="mb-6 border-b pb-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">
                        <i class="fa-solid fa-file-lines mr-2"></i> Isi Konten
                    </h3>
                    <div class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $content->isi }}</div>
                </div>

                <!-- Gambar -->
                @if($content->gambar)
                <div class="mb-6 border-b pb-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">
                        <i class="fa-solid fa-image mr-2"></i> Gambar
                    </h3>
                    <div class="bg-gray-100 rounded-lg p-4 inline-block">
                        <img src="{{ asset('storage/'.$content->gambar) }}" alt="Gambar" class="max-w-full h-auto rounded-lg shadow" style="max-height: 300px;">
                    </div>
                </div>
                @endif

                <!-- Audio -->
                @if($content->audio)
                <div class="mb-6 border-b pb-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">
                        <i class="fa-solid fa-headphones mr-2"></i> Audio
                    </h3>
                    <div class="bg-gray-100 rounded-lg p-4">
                        <audio controls class="w-full">
                            <source src="{{ asset('storage/'.$content->audio) }}" type="audio/mpeg">
                            Browser Anda tidak mendukung pemutar audio.
                        </audio>
                    </div>
                </div>
                @endif

                <!-- Tombol Aksi -->
                <div class="flex gap-3 mt-6">
                    <a href="{{ route('admin.learning-contents.edit', $content->id) }}" class="bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-600 transition">
                        <i class="fa-solid fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.learning-contents.destroy', $content->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                    </form>
                    <a href="{{ route('admin.learning-contents.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>