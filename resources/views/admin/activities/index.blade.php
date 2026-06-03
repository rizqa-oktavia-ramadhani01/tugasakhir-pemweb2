<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Activity - Admin TUTURO</title>
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

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Data Activity</h1>
                <a href="{{ route('admin.activities.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                    <i class="fa-solid fa-plus"></i> Tambah Activity
                </a>
            </div>

            <!-- Pesan Sukses -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Tabel Data -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($activities as $activity)
                        <tr>
                            <td class="px-6 py-4">{{ $activity->id }}</td>
                            <td class="px-6 py-4 font-medium">{{ $activity->judul }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-indigo-100 text-indigo-800 rounded-full text-xs">
                                    {{ $activity->kategori }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $activity->durasi_menit ?? '-' }} menit</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.activities.show', $activity->id) }}" class="text-blue-600 hover:text-blue-800 mr-3">
                                    <i class="fa-solid fa-eye"></i> Detail
                                </a>
                                <a href="{{ route('admin.activities.edit', $activity->id) }}" class="text-yellow-600 hover:text-yellow-800 mr-3">
                                    <i class="fa-solid fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.activities.destroy', $activity->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')" class="text-red-600 hover:text-red-800">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                <i class="fa-solid fa-inbox text-4xl mb-2 block"></i>
                                Belum ada data activity. Silakan tambah activity baru.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $activities->links() }}
            </div>
        </main>
    </div>
</body>
</html>