<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TUTURO - Teman Tumbuh</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
            font-family: 'Segoe UI', Roboto, sans-serif;
        }

        .sidebar {
            width: 280px;
            height: 100vh;
            background: #ffffff;
            border-right: 1px solid #e9ecef;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            z-index: 1000;
        }

        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: white;
            padding: 20px 40px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu-link {
            display: block;
            padding: 14px 18px;
            margin-bottom: 5px;
            border-radius: 14px;
            text-decoration: none;
            color: #7182a3;
            font-size: 16px;
            font-weight: 600;
            transition: 0.3s;
        }

        .menu-link:hover {
            background: #eefaf5;
            color: #008f6a;
        }

        .menu-active {
            background: #dff5eb;
            color: #008f6a;
        }

        .area-title {
            font-size: 12px;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>

    <div class="sidebar p-3">
        <div class="d-flex align-items-center my-3 px-2">
            <div style="width:44px; height:44px; border-radius:12px; background:#00c781; color:white; font-size:24px; font-weight:bold; display:flex; align-items:center; justify-content:center;">
                T
            </div>
            <div class="ms-3">
                <h3 class="fw-bold mb-0" style="color:#005f56; font-size: 22px;">TUTURO</h3>
                <small class="text-secondary fw-semibold area-title">TEMAN TUMBUH</small>
            </div>
        </div>

        <hr class="text-muted opacity-25">

        <div class="px-2 my-2">
            <span class="fw-bold text-secondary area-title">AREA ORANG TUA</span>
        </div>

        <a href="{{ route('dashboard') }}" class="menu-link {{ request()->routeIs('dashboard') ? 'menu-active' : '' }}">
            🏠 Dashboard Utama
        </a>

        <a href="{{ route('children.index') }}" class="menu-link {{ request()->routeIs('children.*') ? 'menu-active' : '' }}">
            👤 Profil Tumbuh Anak
        </a>

        <a href="{{ route('activities.index') }}" class="menu-link {{ request()->routeIs('activities.*') ? 'menu-active' : '' }}">
            ☑️ Rencana Harian
        </a>

        <a href="#" class="menu-link">✨ Rekomendasi Pintar</a>
        <a href="#" class="menu-link">📅 Jurnal Harian Ortu</a>
        <a href="#" class="menu-link">📊 Pantau Progres</a>

        <hr class="text-muted opacity-25">

        <div class="d-flex justify-content-between align-items-center px-2 my-2">
            <span class="fw-bold text-secondary area-title">AREA ANAK (1-5 TAHUN)</span>
            <span class="badge rounded-pill" style="background:#fff3e8; color:#ff8a3d; font-size: 10px;">Bermain</span>
        </div>

        <a href="{{ route('learning-contents.pelafalan') }}" class="menu-link {{ request()->routeIs('learning-contents.*') ? 'menu-active' : '' }}">
            🔊 Latih Pelafalan
        </a>
        <a href="{{ route('learning-contents.tantangan') }}" class="menu-link {{ request()->routeIs('learning-contents.*') ? 'menu-active' : '' }}">
            🏆 Tantangan Bahasa
        </a>

        <div class="mt-auto pt-3 border-top">
            <div class="p-3 bg-light rounded-4 mb-3">
                <div class="d-flex align-items-center">
                    <div style="width:42px; height:42px; border-radius:50%; background:#fff4e6; display:flex; align-items:center; justify-content:center; font-weight:bold; color:#ff6b00;">
                        {{ isset($child) ? strtoupper(substr($child->nama_anak, 0, 1)) : 'A' }}
                    </div>
                    <div class="ms-3">
                        <div class="fw-bold text-dark text-truncate" style="max-width: 150px;">
                            {{ $child->nama_anak ?? 'Nama Anak' }}
                        </div>
                        <small class="text-secondary d-block">
                            Usia {{ $child->usia_anak ?? '-' }} Tahun
                        </small>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-around text-center pb-2">
                <a href="#" class="text-decoration-none text-secondary">
                    <div style="font-size:18px;">⚙️</div>
                    <small style="font-size: 11px;">Setelan</small>
                </a>
                <a href="#" class="text-decoration-none text-secondary">
                    <div style="font-size:18px;">👤</div>
                    <small style="font-size: 11px;">Profil</small>
                </a>
                <form method="POST" action="{{ url('/logout') }}">
                    @csrf
                    <button type="submit" style="border:none; background:none; color:#dc3545; padding:0;">
                        <div style="font-size:18px;">🚪</div>
                        <small style="font-size: 11px;">Keluar</small>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="topbar">
            <div>
                <h4 class="fw-bold mb-1 text-dark">
                    Halo, Bapak & Ibu {{ $child ? $child->nama_anak : 'Orang Tua' }}! 👋
                </h4>
                <div class="text-secondary small fw-semibold">
                    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, j F Y') }}
                </div>
            </div>
            <div>
                <a href="{{ route('activities.index') }}" class="btn btn-success fw-bold px-4 py-2 rounded-3 shadow-sm text-white" style="background-color: #00a878; border: none;">
                    Mulai Stimulasi Harian
                </a>
            </div>
        </div>

        <div class="p-4 flex-grow-1">
            @yield('content')
        </div>
    </div>

    <script href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>