<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TUTURO - @yield('title', 'Dashboard Orang Tua & Anak')</title>

    <!-- Bootstrap 5 CSS (WAJIB untuk dashboard) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
                <!-- ===== FITUR ORANG TUA ===== -->
                <div class="nav-category">
                    <div class="category-title">
                        <i class="fa-regular fa-user mr-1"></i> Orang Tua
                    </div>
                    <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-house"></i>
                        <span>Dashboard Utama</span>
                    </a>
                    <a href="{{ route('setting.index') }}" class="nav-item {{ request()->routeIs('children.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-baby"></i>
                        <span>Personal Tumbuh Anak</span>
                    </a>
                    <a href="{{ route('activities.index') }}" class="nav-item {{ request()->routeIs('activities.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>Rencana Harian</span>
                    </a>
                    <a href="{{ route('parent-journals.index') }}"  class="nav-item {{ request()->routeIs('parent-journals.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-book-open"></i>
                        <span>Jurnal Harian Ortu</span>
                    </a>
                    <a href="{{ route('progress.index') }}" class="nav-item {{ request()->routeIs('progress.*') ? 'active' : '' }}"class="nav-item">
                        <i class="fa-regular fa-calendar-check"></i>
                        <span>Pantau Progres</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i class="fa-solid fa-newspaper"></i>
                        <span>Pusat Edukasi</span>
                    </a>
                </div>

                <!-- ===== FITUR ANAK ===== -->
                <div class="nav-category">
                    <div class="category-title">
                        <i class="fa-regular fa-face-smile mr-1"></i> Fitur Anak
                    </div>
                    <a href="{{ route('learning-contents.index') }}" class="nav-item">
                        <i class="fa-solid fa-microphone-alt"></i>
                        <span>Latih Pelafalan</span>
                    </a>
                    <a href="{{ route('learning-contents.index') }}" class="nav-item">
                        <i class="fa-solid fa-ear-listen"></i>
                        <span>Sound Imitation</span>
                    </a>
                    <a href="{{ route('learning-contents.index') }}" class="nav-item">
                        <i class="fa-solid fa-comments"></i>
                        <span>Tantangan Bahasa</span>
                    </a>
                </div>
            </div>

            <!-- FOOTER HORIZONTAL: Profil, Pengaturan, Keluar -->
            <div class="sidebar-footer">
                <a href="{{ route('profile') }}" class="footer-link">
                    <i class="fa-regular fa-circle-user"></i>
                    <span>Profil</span>
                </a>
                <a href="{{ route('setting.index') }}" class="footer-link">
                    <i class="fa-solid fa-gear"></i>
                    <span>Pengaturan</span>
                </a>
                <a href="{{ route('logout.confirm') }}" class="footer-link logout">
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
                    <h1>Halo, {{ Auth::user()->name }}</h1>
                    <p>{{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
                <div class="header-actions">
                    <button class="notification-btn">
                        <i class="fa-regular fa-bell"></i>
                        <span class="badge-dot"></span>
                    </button>
                    <div class="avatar">
                        {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Scrollable Content -->
            <div class="main-scroll">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Set dynamic date
        const dateElement = document.querySelector('.greeting p');
        if (dateElement) {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const today = new Date().toLocaleDateString('id-ID', options);
            dateElement.textContent = today;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>