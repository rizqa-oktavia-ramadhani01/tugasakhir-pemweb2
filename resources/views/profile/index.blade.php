<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profil Saya - TUTURO</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .profile-card {
            background: white;
            border-radius: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .info-row {
            transition: all 0.2s ease;
        }
        .info-row:hover {
            background-color: #f8fafc;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .modal.active {
            display: flex;
        }
        .modal-content {
            animation: modalFadeIn 0.3s ease;
        }
        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1100;
            animation: slideInRight 0.3s ease;
        }
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body class="flex items-center justify-center p-4">

    <div class="profile-card w-full max-w-2xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-shapes text-white text-3xl"></i>
                    <div>
                        <h1 class="text-white text-2xl font-bold">Profil Saya</h1>
                        <p class="text-indigo-200 text-sm">Kelola informasi akun Anda</p>
                    </div>
                </div>
                <a href="{{ route('dashboard') }}" class="text-white/80 hover:text-white transition">
                    <i class="fa-solid fa-xmark text-2xl"></i>
                </a>
            </div>
        </div>

        <!-- Content -->
        <div class="p-8">
            <!-- Session Messages -->
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <i class="fa-solid fa-exclamation-circle mr-2"></i> {{ session('error') }}
                </div>
            @endif

            <!-- Avatar -->
            <div class="text-center mb-6">
                <div class="w-28 h-28 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i class="fa-solid fa-user text-white text-5xl"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-800">{{ Auth::user()->name ?? 'User' }}</h2>
                <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full mt-1">
                    <i class="fa-solid fa-circle-check mr-1"></i> Akun Aktif
                </span>
            </div>
            
            <!-- Informasi Detail -->
            <div class="space-y-3">
                <!-- Username / Nama (Bisa Edit) -->
                <div class="info-row flex items-center gap-3 border border-gray-200 rounded-xl p-4 bg-white">
                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                        <i class="fa-regular fa-user text-indigo-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500">Username / Nama Lengkap</p>
                        <p class="font-semibold text-gray-800 text-lg">{{ Auth::user()->name ?? 'Belum diisi' }}</p>
                    </div>
                    <button onclick="showEditNameModal()" class="text-indigo-500 hover:text-indigo-700">
                        <i class="fa-regular fa-pen-to-square"></i> Edit
                    </button>
                </div>
                
                <!-- Email (TIDAK BISA EDIT) -->
                <div class="info-row flex items-center gap-3 border border-gray-200 rounded-xl p-4 bg-gray-50">
                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                        <i class="fa-regular fa-envelope text-gray-500"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500">Alamat Email</p>
                        <p class="font-semibold text-gray-800">{{ Auth::user()->email ?? 'Belum diisi' }}</p>
                    </div>
                    <span class="text-gray-400 text-xs">
                        <i class="fa-solid fa-lock"></i> Tidak bisa diubah
                    </span>
                </div>
                
                <!-- Password (Bisa Ganti) -->
                <div class="info-row flex items-center gap-3 border border-gray-200 rounded-xl p-4 bg-white">
                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-lock text-indigo-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500">Password</p>
                        <p class="font-semibold text-gray-800">••••••••</p>
                    </div>
                    <button onclick="showChangePasswordModal()" class="text-indigo-500 hover:text-indigo-700">
                        <i class="fa-solid fa-key"></i> Ganti
                    </button>
                </div>
                
                <!-- Role -->
                <div class="info-row flex items-center gap-3 border border-gray-200 rounded-xl p-4 bg-white">
                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                        <i class="fa-regular fa-id-card text-indigo-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500">Role / Hak Akses</p>
                        <p class="font-semibold text-gray-800">
                            @php
                                $role = Auth::user()->role ?? 'parent';
                                $roleName = $role == 'parent' ? 'Orang Tua' : ($role == 'admin' ? 'Administrator' : ucfirst($role));
                            @endphp
                            {{ $roleName }}
                        </p>
                    </div>
                </div>
                
                <!-- Tanggal Masuk -->
                <div class="info-row flex items-center gap-3 border border-gray-200 rounded-xl p-4 bg-white">
                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                        <i class="fa-regular fa-calendar text-indigo-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500">Bergabung Sejak / Tanggal Masuk</p>
                        <p class="font-semibold text-gray-800">
                            {{ Auth::user()->created_at ? Auth::user()->created_at->format('d F Y') : '-' }}
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Informasi Keamanan -->
            <div class="mt-6 p-4 bg-amber-50 rounded-xl border border-amber-200">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-shield-hart text-amber-600"></i>
                    <p class="text-xs text-amber-700">
                        <strong>Catatan Keamanan:</strong> Email tidak dapat diubah karena digunakan sebagai identitas login. 
                        Jika perlu mengganti email, silakan hubungi dukungan pelanggan.
                    </p>
                </div>
            </div>
            
            <!-- Tombol Aksi -->
            <div class="mt-8 flex gap-3">
                <a href="{{ route('dashboard') }}" class="flex-1 text-center bg-gray-200 text-gray-700 py-3 rounded-xl hover:bg-gray-300 transition font-semibold">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Dashboard
                </a>
                <a href="{{ route('setting.index') }}" class="flex-1 text-center bg-indigo-600 text-white py-3 rounded-xl hover:bg-indigo-700 transition font-semibold">
                    <i class="fa-solid fa-sliders-h mr-2"></i> Pengaturan Lainnya
                </a>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT NAMA -->
    <div id="editNameModal" class="modal">
        <div class="modal-content bg-white rounded-2xl p-6 max-w-md w-full mx-4">
            <h3 class="text-xl font-bold mb-4">Edit Nama</h3>
            <form action="{{ route('profile.update-name') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full p-3 border border-gray-300 rounded-lg mb-4 focus:border-indigo-500 focus:outline-none" required>
                <div class="flex gap-3">
                    <button type="button" onclick="closeModal('editNameModal')" class="flex-1 bg-gray-200 py-2 rounded-lg">Batal</button>
                    <button type="submit" class="flex-1 bg-indigo-600 text-white py-2 rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL GANTI PASSWORD -->
    <div id="changePasswordModal" class="modal">
        <div class="modal-content bg-white rounded-2xl p-6 max-w-md w-full mx-4">
            <h3 class="text-xl font-bold mb-4">Ganti Password</h3>
            <form action="{{ route('profile.update-password') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="password" name="current_password" placeholder="Password Saat Ini" class="w-full p-3 border border-gray-300 rounded-lg mb-3 focus:border-indigo-500 focus:outline-none" required>
                <input type="password" name="new_password" placeholder="Password Baru (min. 8 karakter)" class="w-full p-3 border border-gray-300 rounded-lg mb-3 focus:border-indigo-500 focus:outline-none" required>
                <input type="password" name="new_password_confirmation" placeholder="Konfirmasi Password Baru" class="w-full p-3 border border-gray-300 rounded-lg mb-4 focus:border-indigo-500 focus:outline-none" required>
                <div class="flex gap-3">
                    <button type="button" onclick="closeModal('changePasswordModal')" class="flex-1 bg-gray-200 py-2 rounded-lg">Batal</button>
                    <button type="submit" class="flex-1 bg-indigo-600 text-white py-2 rounded-lg">Ganti Password</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showEditNameModal() {
            document.getElementById('editNameModal').classList.add('active');
        }
        function showChangePasswordModal() {
            document.getElementById('changePasswordModal').classList.add('active');
        }
        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }
        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        }
    </script>
</body>
</html>