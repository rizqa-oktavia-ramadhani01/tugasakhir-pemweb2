<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TUTURO - Dashboard Orang Tua & Anak</title>

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8FAFC;
            color: #1E293B;
            height: 100vh;
            overflow: hidden;
        }

        /* Layout Utama */
        .app-container {
            display: flex;
            height: 100vh;
            width: 100%;
            overflow: hidden;
        }

        /* ========= SIDEBAR STYLE ========= */
        .sidebar {
            width: 280px;
            background-color: #FFFFFF;
            border-right: 1px solid #E2E8F0;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            z-index: 10;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.02);
        }

        /* Logo Area */
        .logo-area {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid #F1F5F9;
            margin-bottom: 0.25rem;
        }

        .logo-wrapper {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 800;
            font-size: 1.6rem;
            color: #4F46E5;
        }

        .logo-wrapper i {
            font-size: 1.8rem;
        }

        .logo-wrapper span {
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        /* Area Scroll Navigasi */
        .nav-scroll {
            flex: 1;
            overflow-y: auto;
            padding: 0.75rem 0.875rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Kategori Menu */
        .nav-category {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .category-title {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            color: #94A3B8;
            padding-left: 0.75rem;
            margin-bottom: 0.25rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.7rem 1rem;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 500;
            color: #475569;
            transition: all 0.2s ease;
            text-decoration: none;
            cursor: pointer;
        }

        .nav-item i {
            width: 1.4rem;
            text-align: center;
            font-size: 1.1rem;
            transition: transform 0.2s ease;
        }

        .nav-item:hover {
            background: #EEF2FF;
            color: #4F46E5;
        }

        .nav-item:hover i {
            transform: scale(1.05);
        }

        .nav-item.active {
            background: #EEF2FF;
            color: #4F46E5;
            font-weight: 600;
            border-left: 3px solid #4F46E5;
            border-radius: 12px;
        }

        /* Sidebar Footer Horizontal */
        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid #F1F5F9;
            display: flex;
            justify-content: space-around;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.3rem;
            text-decoration: none;
            color: #64748B;
            font-size: 0.7rem;
            font-weight: 500;
            transition: all 0.2s ease;
            padding: 0.4rem 0.6rem;
            border-radius: 10px;
            flex: 1;
            text-align: center;
        }

        .footer-link i {
            font-size: 1.1rem;
        }

        .footer-link:hover {
            background: #F1F5F9;
            color: #4F46E5;
        }

        .footer-link.logout:hover {
            color: #EF4444;
            background: #FEF2F2;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
            background-color: #F8FAFC;
        }

        /* Header */
        .top-header {
            height: 70px;
            background-color: #FFFFFF;
            border-bottom: 1px solid #E2E8F0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            flex-shrink: 0;
        }

        .greeting h1 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0F172A;
        }

        .greeting p {
            font-size: 0.75rem;
            color: #64748B;
            font-weight: 500;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .notification-btn {
            position: relative;
            background: none;
            border: none;
            font-size: 1.25rem;
            color: #94A3B8;
            cursor: pointer;
            transition: color 0.2s;
        }

        .notification-btn:hover {
            color: #4F46E5;
        }

        .badge-dot {
            position: absolute;
            top: -2px;
            right: -4px;
            width: 8px;
            height: 8px;
            background-color: #EF4444;
            border-radius: 50%;
            border: 2px solid white;
        }

        .avatar {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #4F46E5, #818CF8);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.9rem;
        }

        /* Scroll Area Main */
        .main-scroll {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem 2rem;
        }

        /* Card styles */
        .card {
            background: white;
            border-radius: 1.25rem;
            border: 1px solid #EFF3F8;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
            transition: all 0.2s;
        }

        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 20px -12px rgba(0, 0, 0, 0.1);
        }

        .progress-bar {
            background: #E2E8F0;
            border-radius: 999px;
            height: 8px;
            overflow: hidden;
        }

        .progress-fill {
            background: linear-gradient(90deg, #4F46E5, #7C3AED);
            height: 100%;
            border-radius: 999px;
            width: 0%;
        }

        /* Custom scroll */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #F1F5F9;
        }

        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="app-container">
        <!-- SIDEBAR MENU -->
        <aside class="sidebar">
            <!-- Logo Area -->
            <div class="logo-area">
                <div class="logo-wrapper">
                    <i class="fa-solid fa-shapes"></i>
                    <span>TUTURO</span>
                </div>
            </div>

            <!-- Area Navigasi (Scroll) -->
            <div class="nav-scroll">
                <!-- ===== FITUR ORANG TUA (di atas) ===== -->
                <div class="nav-category">
                    <div class="category-title">
                        <i class="fa-regular fa-user mr-1"></i> Orang Tua
                    </div>
                    <a href="#" class="nav-item">
                        <i class="fa-solid fa-house"></i>
                        <span>Dashboard Utama</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i class="fa-solid fa-book-open"></i>
                        <span>Personal Tumbuh Anak</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>Rencana Harian</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>Jurnal Harian Ortu</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i class="fa-regular fa-calendar-check"></i>
                        <span>Pantau Progres</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i class="fa-solid fa-newspaper"></i>
                        <span>Pusat Edukasi</span>
                    </a>
                </div>

                <!-- ===== FITUR ANAK (di bawah) ===== -->
                <div class="nav-category">
                    <div class="category-title">
                        <i class="fa-regular fa-face-smile mr-1"></i> Fitur Anak
                    </div>
                    <a href="#" class="nav-item">
                        <i class="fa-solid fa-microphone-alt"></i>
                        <span>Latih Pelafalan</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i class="fa-solid fa-ear-listen"></i>
                        <span>Sound Imitation</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i class="fa-solid fa-comments"></i>
                        <span>Tantangan Bahasa</span>
                    </a>
                </div>
            </div>

            <!-- FOOTER HORIZONTAL: Pengaturan, Profil, Keluar -->
            <div class="sidebar-footer">
                <a href="#" class="footer-link">
                    <i class="fa-solid fa-gear"></i>
                    <span>Pengaturan</span>
                </a>
                <a href="#" class="footer-link">
                    <i class="fa-regular fa-circle-user"></i>
                    <span>Profil</span>
                </a>
                <a href="{{ url('/logout') }}" class="footer-link logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar</span>
                </a>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <!-- Top Header -->
            <header class="top-header">
                <div class="greeting">
                    <h1>Halo, Bapak & Ibu Aria</h1>
                    <p>Selasa, 2 Juni 2026</p>
                </div>
                <div class="header-actions">
                    <button class="notification-btn">
                        <i class="fa-regular fa-bell"></i>
                        <span class="badge-dot"></span>
                    </button>
                    <div class="avatar">AW</div>
                </div>
            </header>

            <!-- Scrollable Content -->
            <div class="main-scroll">
                <div style="max-width: 1200px; margin: 0 auto;">
                    <!-- Page Title -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Profil Tumbuh Kembang Anak</h2>
                        <p style="color: #64748B; font-size: 0.85rem;">Memantau perkembangan bahasa dan interaksi si kecil.</p>
                    </div>

                    <!-- Grid dua kolom -->
                    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1.75rem;">
                        <!-- Kolom Kiri: Profil Anak -->
                        <div>
                            <div class="card card-hover" style="padding: 1.5rem; text-align: center;">
                                <div style="position: relative;">
                                    <div style="height: 80px; background: linear-gradient(135deg, #EEF2FF, #E0E7FF); margin: -1.5rem -1.5rem 0 -1.5rem; border-radius: 1.25rem 1.25rem 0 0;"></div>
                                    <div style="margin-top: -40px;">
                                        <img src="https://picsum.photos/seed/aria/120/120" alt="Aria" style="width: 96px; height: 96px; border-radius: 50%; border: 4px solid white; object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                                    </div>
                                </div>
                                <h3 style="font-size: 1.35rem; font-weight: 800; margin-top: 0.75rem;">Aria Wijaya</h3>
                                <span style="display: inline-block; background: #DBEAFE; color: #1E40AF; font-size: 0.7rem; font-weight: 600; padding: 0.2rem 0.9rem; border-radius: 30px;">Anak Tercinta</span>

                                <div style="background: #F8FAFC; border-radius: 1rem; padding: 0.9rem; margin-top: 1.25rem;">
                                    <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #E2E8F0;">
                                        <span style="font-size: 0.7rem; font-weight: 600; color: #64748B;">Grup Studi</span>
                                        <span style="font-size: 0.8rem; font-weight: 700;">2-3 Tahun</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #E2E8F0;">
                                        <span style="font-size: 0.7rem; font-weight: 600; color: #64748B;">Usia</span>
                                        <span style="font-size: 0.8rem; font-weight: 700;">2 Thn 4 Bln</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between; padding: 0.5rem 0;">
                                        <span style="font-size: 0.7rem; font-weight: 600; color: #64748B;">Status Bicara</span>
                                        <span style="background: #D1FAE5; color: #065F46; padding: 0.2rem 0.6rem; border-radius: 30px; font-size: 0.7rem; font-weight: 700;">Normal</span>
                                    </div>
                                </div>
                                <button style="margin-top: 1.25rem; width: 100%; background: white; border: 1px solid #CBD5E1; padding: 0.6rem; border-radius: 12px; font-weight: 600; font-size: 0.8rem; color: #334155; cursor: pointer; transition: all 0.2s;">
                                    <i class="fa-regular fa-pen-to-square"></i> Edit Profil
                                </button>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Detail & Rencana -->
                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            <!-- Metrik Kosakata -->
                            <div class="card card-hover" style="padding: 1.25rem 1.5rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                                    <div>
                                        <h4 style="font-weight: 800;">METRIK KOSAKATA</h4>
                                        <p style="font-size: 0.7rem; color: #64748B;">Jumlah kata aktif yang bisa diucapkan</p>
                                    </div>
                                    <div style="text-align: right;">
                                        <span style="font-size: 1.8rem; font-weight: 800; color: #4F46E5;">88</span>
                                        <span style="color: #94A3B8;"> / 150</span>
                                    </div>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 58.6%;"></div>
                                </div>
                                <div style="display: flex; justify-content: space-between; margin-top: 0.5rem;">
                                    <span style="font-size: 0.7rem;">Target: 100 Kata</span>
                                    <span style="font-size: 0.7rem; color: #10B981; font-weight: 700;">Progres Baik</span>
                                </div>
                            </div>

                            <!-- Grid 2 Kolom untuk Rencana & Saran -->
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                                <!-- Rencana Prioritas -->
                                <div class="card card-hover" style="padding: 1.25rem;">
                                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                                        <div style="width: 36px; height: 36px; background: #FEF3C7; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #F59E0B;">
                                            <i class="fa-solid fa-list-check"></i>
                                        </div>
                                        <h4 style="font-weight: 800;">Rencana Prioritas</h4>
                                    </div>
                                    <p style="font-size: 0.65rem; font-weight: 700; color: #94A3B8; letter-spacing: 0.5px;">Terapi Mandiri</p>
                                    <ul style="margin-top: 0.8rem; display: flex; flex-direction: column; gap: 0.8rem;">
                                        <li style="display: flex; gap: 0.6rem; align-items: start;">
                                            <i class="fa-solid fa-check-circle" style="color: #4F46E5; margin-top: 0.15rem;"></i>
                                            <span style="font-size: 0.8rem;"><strong>Two-word sentence</strong><br><span style="font-size: 0.7rem; color: #64748B;">Gabungkan kata benda + kerja</span></span>
                                        </li>
                                        <li style="display: flex; gap: 0.6rem; opacity: 0.6;">
                                            <i class="fa-regular fa-circle-check"></i>
                                            <span style="font-size: 0.8rem; text-decoration: line-through;">Nama anggota keluarga</span>
                                        </li>
                                        <li style="display: flex; gap: 0.6rem;">
                                            <i class="fa-regular fa-circle"></i>
                                            <span style="font-size: 0.8rem;">Instruksi 2 langkah</span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Saran Ahli -->
                                <div class="card" style="background: linear-gradient(145deg, #4F46E5, #6366F1); color: white; padding: 1.25rem;">
                                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                                        <div style="width: 36px; height: 36px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fa-solid fa-user-doctor"></i>
                                        </div>
                                        <h4 style="font-weight: 800;">Saran Ahli</h4>
                                    </div>
                                    <div style="margin-top: 1rem;">
                                        <i class="fa-solid fa-quote-left" style="opacity: 0.3; font-size: 1.4rem;"></i>
                                        <p style="margin-top: 0.25rem; font-size: 0.8rem; line-height: 1.4;">Aria menunjukkan progres sangat baik. Fokus pada percakapan sederhana saat bermain.</p>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 0.6rem; margin-top: 1rem; padding-top: 0.8rem; border-top: 1px solid rgba(255,255,255,0.2);">
                                        <img src="https://picsum.photos/seed/therapist2/40/40" style="width: 32px; height: 32px; border-radius: 50%; border: 2px solid white;">
                                        <div>
                                            <p style="font-size: 0.7rem; font-weight: 700;">Budi Santoso, S.Psi</p>
                                            <p style="font-size: 0.6rem; opacity: 0.8;">Ahli Terapi Bicara</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Catatan tambahan -->
                            <div class="card" style="padding: 1rem 1.5rem; background: #F1F5F9; border: none; text-align: center;">
                                <p style="font-size: 0.7rem; color: #475569;"><i class="fa-regular fa-heart" style="color: #EC4899;"></i> Setiap perkembangan kecil adalah kemenangan besar. Tetap semangat, Ayah & Bunda!</p>
                            </div>
                        </div>
                    </div>

                    <!-- Footer kecil bawah konten -->
                    <div style="margin-top: 2.5rem; text-align: center; color: #94A3B8; font-size: 0.65rem; padding: 0.75rem 0;">
                        &copy; 2026 TUTURO — Mendukung tumbuh kembang optimal anak.
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Animasi kecil untuk tombol edit profil
        const editBtn = document.querySelector('button');
        if (editBtn) {
            editBtn.addEventListener('click', (e) => {
                e.preventDefault();
                alert('✨ Form edit profil anak akan segera hadir ✨');
            });
        }

        // Set dynamic date (opsional, biar lebih hidup)
        const dateElement = document.querySelector('.greeting p');
        if (dateElement) {
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const today = new Date().toLocaleDateString('id-ID', options);
            dateElement.textContent = today;
        }
    </script>
</body>

</html>