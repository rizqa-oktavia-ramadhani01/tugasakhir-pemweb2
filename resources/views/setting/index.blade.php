<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Tumbuh Kembang Anak - TUTURO</title>
    
    <!-- Menggunakan Tailwind CSS untuk styling cepat dan modern -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts (Nunito untuk tampilan yang ramah dan bersih) -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #F3F4F6; /* Gray-100 */
        }
        
        /* Custom Scrollbar agar terlihat rapi */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1; 
        }
        ::-webkit-scrollbar-thumb {
            background: #CBD5E1; 
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94A3B8; 
        }

        /* Animasi halus untuk kartu */
        .hover-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .hover-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
    </style>

    <script>
        // Konfigurasi Tema Tailwind (opsional, untuk konsistensi warna)
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5', // Indigo 600
                        secondary: '#F59E0B', // Amber 500
                        accent: '#10B981', // Emerald 500
                        softbg: '#F8FAFC',
                    }
                }
            }
        }
    </script>
</head>
<body class="text-gray-800 antialiased h-screen flex overflow-hidden">

    <!-- SIDEBAR MENU -->
    <aside class="w-64 bg-white border-r border-gray-200 flex-col hidden md:flex z-10">
        <!-- Logo Area -->
        <div class="h-20 flex items-center justify-center border-b border-gray-100">
            <div class="flex items-center gap-2 text-primary font-bold text-2xl">
                <i class="fa-solid fa-shapes"></i>
                <span>TUTURO</span>
            </div>
        </div>

        <!-- Menu Items -->
        <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-1">
            <!-- Menu: Dashboard / Home -->
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 rounded-lg hover:bg-indigo-50 hover:text-primary transition-colors group">
                <i class="fa-solid fa-house w-5 text-center group-hover:scale-110 transition-transform"></i>
                <span class="font-semibold text-sm">Dashboard</span>
            </a>

            <!-- Menu: Personal Harian Ortu -->
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 rounded-lg hover:bg-indigo-50 hover:text-primary transition-colors group">
                <i class="fa-solid fa-book-open w-5 text-center group-hover:scale-110 transition-transform"></i>
                <span class="font-semibold text-sm">Personal Harian Ortu</span>
            </a>

            <!-- Menu: Pantau Progres -->
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 rounded-lg hover:bg-indigo-50 hover:text-primary transition-colors group">
                <i class="fa-solid fa-chart-line w-5 text-center group-hover:scale-110 transition-transform"></i>
                <span class="font-semibold text-sm">Pantau Progres</span>
            </a>

            <!-- Menu: Profil Tumbuh Anak (ACTIVE STATE) -->
            <a href="#" class="flex items-center gap-3 px-4 py-3 bg-indigo-50 text-primary rounded-lg border-l-4 border-primary transition-colors group">
                <i class="fa-solid fa-baby w-5 text-center group-hover:scale-110 transition-transform"></i>
                <span class="font-bold text-sm">Profil Tumbuh Anak</span>
            </a>

            <!-- Menu: Jadwal Terapi -->
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 rounded-lg hover:bg-indigo-50 hover:text-primary transition-colors group">
                <i class="fa-regular fa-calendar-check w-5 text-center group-hover:scale-110 transition-transform"></i>
                <span class="font-semibold text-sm">Jadwal Terapi</span>
            </a>
            
            <!-- Menu: Artikel & Tips -->
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 rounded-lg hover:bg-indigo-50 hover:text-primary transition-colors group">
                <i class="fa-solid fa-newspaper w-5 text-center group-hover:scale-110 transition-transform"></i>
                <span class="font-semibold text-sm">Artikel & Tips</span>
            </a>
        </nav>

        <!-- Sidebar Footer / Settings -->
        <div class="p-4 border-t border-gray-100">
            <a href="#" class="flex items-center gap-3 px-4 py-2 text-gray-500 hover:text-gray-800 transition-colors">
                <i class="fa-solid fa-gear"></i>
                <span class="text-sm font-medium">Pengaturan Akun</span>
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-2 text-red-500 hover:text-red-700 transition-colors mt-1">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="text-sm font-medium">Keluar</span>
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT WRAPPER -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden bg-softbg">
        
        <!-- TOP HEADER -->
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 shadow-sm z-10">
            <!-- Mobile Menu Button (Visible only on small screens) -->
            <button class="md:hidden text-gray-500 hover:text-primary">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>

            <!-- Greeting & Date -->
            <div class="flex flex-col">
                <h1 class="text-lg md:text-xl font-bold text-gray-800">
                    Halo, Bapak & Ibu Aria Wijaya!
                </h1>
                <p class="text-xs md:text-sm text-gray-500 font-medium" id="current-date">
                    Selasa, 2 Juni 2026
                </p>
            </div>

            <!-- Right Header Actions -->
            <div class="flex items-center gap-4">
                <button class="relative p-2 text-gray-400 hover:text-primary transition-colors">
                    <i class="fa-solid fa-bell text-xl"></i>
                    <span class="absolute top-1 right-1 h-2.5 w-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                </button>
                <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-primary font-bold border border-indigo-200">
                    AW
                </div>
            </div>
        </header>

        <!-- CONTENT BODY -->
        <main class="flex-1 overflow-y-auto p-4 md:p-8">
            
            <div class="max-w-6xl mx-auto">
                
                <!-- Page Title -->
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Profil Tumbuh Kembang Anak</h2>
                    <p class="text-gray-500 text-sm">Memantau perkembangan bahasa dan interaksi si kecil.</p>
                </div>

                <!-- GRID LAYOUT -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                    <!-- LEFT COLUMN: Child Profile (4 cols) -->
                    <div class="lg:col-span-4 space-y-6">
                        
                        <!-- Profile Card -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center hover-card relative overflow-hidden">
                            <!-- Decorative bg blob -->
                            <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-r from-indigo-50 to-blue-50 -z-0"></div>
                            
                            <div class="relative z-10">
                                <div class="mx-auto w-28 h-28 rounded-full p-1 bg-white shadow-md mb-4">
                                    <!-- Avatar Placeholder (using Picsum as requested) -->
                                    <img src="https://picsum.photos/seed/ariawijaya/200/200.jpg" alt="Aria Wijaya" class="w-full h-full rounded-full object-cover">
                                </div>
                                
                                <h3 class="text-xl font-bold text-gray-800">Aria Wijaya</h3>
                                <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full mt-1 mb-4">
                                    Anak Tercinta
                                </span>

                                <!-- Profile Details -->
                                <div class="space-y-3 text-left bg-gray-50 p-4 rounded-xl mt-4">
                                    <div class="flex justify-between items-center border-b border-gray-200 pb-2">
                                        <span class="text-xs text-gray-500 font-semibold">Grup Studi</span>
                                        <span class="text-sm font-bold text-gray-700">2-3 Tahun</span>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-gray-200 pb-2">
                                        <span class="text-xs text-gray-500 font-semibold">Usia</span>
                                        <span class="text-sm font-bold text-gray-700">2 Thn 4 Bln</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-500 font-semibold">Status Bicara</span>
                                        <span class="text-sm font-bold text-emerald-600 bg-emerald-100 px-2 py-0.5 rounded-md">Normal</span>
                                    </div>
                                </div>

                                <button class="mt-6 w-full py-2 bg-white border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 hover:text-primary transition-all text-sm shadow-sm">
                                    <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Profil Anak
                                </button>
                            </div>
                        </div>

                    </div>

                    <!-- RIGHT COLUMN: Progress & Plans (8 cols) -->
                    <div class="lg:col-span-8 space-y-6">
                        
                        <!-- SECTION 1: Detail Status Perkembangan -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-bold text-gray-800">Detail Status Perkembangan</h3>
                                <button class="text-indigo-600 text-sm font-semibold hover:underline">Lihat Detail</button>
                            </div>

                            <!-- Metric: Vocabulary -->
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover-card">
                                <div class="flex flex-col md:flex-row md:items-center justify-between mb-4">
                                    <div>
                                        <h4 class="font-bold text-gray-700 text-lg">METRIK KOSAKATA</h4>
                                        <p class="text-sm text-gray-500">Jumlah kata aktif yang bisa diucapkan</p>
                                    </div>
                                    <div class="mt-2 md:mt-0 text-right">
                                        <span class="text-3xl font-bold text-primary">88</span>
                                        <span class="text-gray-400 text-lg font-medium"> / 150 Kata</span>
                                    </div>
                                </div>
                                
                                <!-- Progress Bar -->
                                <div class="w-full bg-gray-200 rounded-full h-3 mb-2 overflow-hidden">
                                    <!-- Calculation: 88 / 150 = ~58.6% -->
                                    <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-3 rounded-full" style="width: 58.6%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-500 font-medium">
                                    <span>Target Minimal: 100 Kata</span>
                                    <span class="text-emerald-600 font-bold">Progres Baik</span>
                                </div>
                            </div>

                            <!-- Grid for Plans & Suggestions -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                <!-- Plan: Priority Therapy -->
                                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover-card">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center text-secondary">
                                            <i class="fa-solid fa-list-check"></i>
                                        </div>
                                        <h4 class="font-bold text-gray-800 text-base">RENCANA PRIORITAS</h4>
                                    </div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Terapi Mandiri</p>
                                    
                                    <ul class="space-y-3">
                                        <li class="flex items-start gap-3">
                                            <div class="mt-1 min-w-[1.25rem] h-5 rounded border border-gray-300 bg-indigo-50 border-indigo-500 flex items-center justify-center text-indigo-600">
                                                <i class="fa-solid fa-check text-xs"></i>
                                            </div>
                                            <span class="text-sm text-gray-700 leading-snug">
                                                <strong>Two-word simple sentence structure.</strong>
                                                <span class="block text-xs text-gray-500 mt-1">Mendorong anak menggabungkan kata benda dan kata kerja.</span>
                                            </span>
                                        </li>
                                        <li class="flex items-start gap-3 opacity-60">
                                            <div class="mt-1 min-w-[1.25rem] h-5 rounded border border-gray-300 bg-white flex items-center justify-center text-gray-400">
                                                <i class="fa-solid fa-check text-xs"></i>
                                            </div>
                                            <span class="text-sm text-gray-700 line-through">
                                                Mengenal nama anggota keluarga.
                                            </span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <div class="mt-1 min-w-[1.25rem] h-5 rounded border border-gray-300 bg-white"></div>
                                            <span class="text-sm text-gray-700">Mengikuti instruksi 2 langkah.</span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Expert Suggestions -->
                                <div class="bg-gradient-to-br from-indigo-500 to-blue-600 rounded-2xl shadow-md p-6 text-white hover-card">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center text-white">
                                            <i class="fa-solid fa-user-doctor"></i>
                                        </div>
                                        <h4 class="font-bold text-white text-base">SARAN AHLI</h4>
                                    </div>
                                    
                                    <div class="relative">
                                        <i class="fa-solid fa-quote-left absolute -top-2 -left-2 text-white/20 text-4xl"></i>
                                        <p class="text-sm leading-relaxed text-indigo-50 relative z-10 pt-4">
                                            Aria sudah menunjukkan progres yang sangat baik dalam kosakata benda. Untuk minggu ini, fokuslah pada <strong>percakapan sederhana</strong> saat bermain mainan kesayangannya.
                                        </p>
                                    </div>

                                    <div class="mt-4 pt-4 border-t border-white/20 flex items-center gap-3">
                                        <img src="https://picsum.photos/seed/therapist/50/50.jpg" alt="Therapist" class="w-8 h-8 rounded-full border-2 border-white/50">
                                        <div>
                                            <p class="text-xs font-bold text-white">Budi Santoso, S.Psi</p>
                                            <p class="text-[10px] text-indigo-200">Ahli Terapi Bicara Anak</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <!-- Footer -->
                <footer class="mt-12 text-center text-gray-400 text-xs pb-4">
                    &copy; 2026 TUTURO Platform. Hak Cipta Dilindungi.
                </footer>

            </div>
        </main>
    </div>

    <!-- Optional Interaction Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Script untuk menangani klik tombol Edit (Simulasi)
            const editBtn = document.querySelector('button');
            
            // Tambahkan event listener ke tombol "Edit Profil Anak"
            const buttons = document.querySelectorAll('button');
            buttons.forEach(btn => {
                if(btn.textContent.includes('Edit Profil')) {
                    btn.addEventListener('click', (e) => {
                        e.preventDefault();
                        // Dalam aplikasi nyata, ini akan membuka modal atau redirect
                        const originalText = btn.innerHTML;
                        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Memuat...';
                        setTimeout(() => {
                            btn.innerHTML = originalText;
                            alert('Fitur Edit Profil akan membuka formulir data anak.');
                        }, 500);
                    });
                }
            });

            // Set tanggal hari ini (Secara dinamis, tapi default ke teks prompt jika tidak ada script logika kompleks)
            // Kode di bawah ini hanya untuk memastikan tampilan tetap sesuai request "Selasa, 2 Juni 2026"
            // Jika ingin tanggal asli komputer, uncomment baris di bawah:
            /*
            const dateElement = document.getElementById('current-date');
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            dateElement.textContent = new Date().toLocaleDateString('id-ID', options);
            */
        });
    </script>
</body>
</html>