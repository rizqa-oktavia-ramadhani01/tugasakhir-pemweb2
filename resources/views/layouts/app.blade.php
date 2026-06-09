<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TUTURO</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <style>
        body {
            background: #f5f7fb;
        }

        .sidebar {
            width: 280px;
            min-height: 100vh;
            background: #ffffff;
            border-right: 1px solid #e9ecef;
            position: fixed;
            display: flex;
            flex-direction: column;
        }

        .menu-link {
            display: block;
            padding: 16px 18px;
            margin-bottom: 10px;
            border-radius: 18px;
            text-decoration: none;
            color: #7182a3;
            font-size: 18px;
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

        body {
            background: #f5f7fb;
        }

        .sidebar {
            width: 280px;
            min-height: 100vh;
            background: #ffffff;
            border-right: 1px solid #e9ecef;
            position: fixed;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            margin-left: 280px;
            min-height: 100vh;
        }

        .topbar {
            background: white;
            padding: 25px 40px;
            border-bottom: 1px solid #e5e7eb;
        }

        .menu-link {
            display: block;
            padding: 16px 18px;
            margin-bottom: 10px;
            border-radius: 18px;
            text-decoration: none;
            color: #7182a3;
            font-size: 18px;
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
    </style>
</head>

<body>
    <div class="sidebar">

        <div class="p-4">

            <div class="d-flex align-items-center mb-5">

                <div style="
                width:48px;
                height:48px;
                border-radius:14px;
                background:#00c781;
                color:white;
                font-size:28px;
                font-weight:bold;
                display:flex;
                align-items:center;
                justify-content:center;">
                    T
                </div>

                <div class="ms-3">

                    <h2 class="fw-bold mb-0" style="color:#005f56;">
                        TUTURO
                    </h2>

                    <small class="text-secondary fw-semibold">
                        TEMAN TUMBUH
                    </small>

                </div>

            </div>

            <div class="mb-4">

                <span class="fw-bold text-secondary">
                    AREA ORANG TUA
                </span>

            </div>

            <a href="{{ url('/dashboard') }}" class="menu-link menu-active">
                <i class="bi bi-house-door-fill me-2"></i>
                Dashboard Utama
            </a>

            <a href="{{ route('children.index') }}" class="menu-link">
                <i class="bi bi-person-fill me-2"></i>
                Profil Tumbuh Anak
            </a>

            <a href="{{ route('activities.index') }}" class="menu-link">
                <i class="bi bi-calendar-check-fill me-2"></i>
                Rencana Harian
            </a>

            <a href="#" class="menu-link">
                <i class="bi bi-lightbulb-fill me-2"></i>
                Rekomendasi Pintar
            </a>

            <a href="#" class="menu-link">
                <i class="bi bi-journal-text me-2"></i>
                Jurnal Harian Ortu
            </a>

            <a href="#" class="menu-link">
                <i class="bi bi-bar-chart-fill me-2"></i>
                Pantau Progres
            </a>

        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">

            <span class="fw-bold text-secondary">
                AREA ANAK (1-5 TAHUN)
            </span>

            <span class="badge rounded-pill" style="background:#fff3e8;color:#ff8a3d;">
                Bermain
            </span>

        </div>



        <a href="{{ route('learning-contents.index') }}" class="menu-link">

            🔊 Latih Pelafalan

        </a>

        <a href="{{ route('learning-contents.index') }}" class="menu-link">

            🎤 Tiru Suara Ceria

        </a>

        <a href="{{ route('learning-contents.index') }}" class="menu-link">

            🏆 Tantangan Bahasa

        </a>

        <div class="mt-auto p-4 border-top">

            <div class="card border-0" style="background:#f3f5f9; border-radius:18px;">

                <div class="card border-0" style="background:#f3f5f9;border-radius:18px;">

                    <div class="card-body d-flex align-items-center">

                        <div style="
            width:52px;
            height:52px;
            border-radius:50%;
            background:#fff4e6;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:bold;
            color:#ff6b00;">

                            A

                        </div>

                        <div class="ms-3">

                            <div class="fw-bold">
                                {{ $child->nama_anak ?? 'Nama Anak' }}
                            </div>

                            <small class="text-secondary">
                                Usia {{ $child->usia_anak ?? '-' }} Tahun
                            </small>

                        </div>

                    </div>

                </div>

                <div class="d-flex justify-content-around mt-4 text-center">

                    <a href="#" class="text-decoration-none text-secondary">

                        <div style="font-size:24px;">⚙️</div>

                        <small>Setelan</small>

                    </a>

                    <a href="#" class="text-decoration-none text-secondary">

                        <div style="font-size:24px;">👤</div>

                        <small>Profil</small>

                    </a>

                    <form method="POST" action="{{ url('/logout') }}">

                        @csrf

                        <button type="submit" style="border:none;background:none;color:#dc3545;">

                            <div style="font-size:24px;">🚪</div>

                            <small>Keluar</small>

                        </button>

                    </form>

                </div>


                <div class="card-body d-flex align-items-center">

                    <div style="
                    width:52px;
                    height:52px;
                    border-radius:50%;
                    background:#fff4e6;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    font-weight:bold;
                    color:#ff6b00;">

                        A

                    </div>

                    <div class="ms-3">

                        <div class="fw-bold">

                            {{ $child->nama_anak ?? 'Nama Anak' }}

                        </div>

                        <small class="text-secondary">

                            Usia
                            {{ $child->usia_anak ?? '-' }}
                            Tahun

                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="main-content">

        <div class="topbar">
            <h1 class="fw-bold d-flex align-items-center">
                <i class="bi bi-person-circle me-3 text-success fs-2"></i>
                <span>Halo, {{ Auth::user()->name }}</span>
            </h1>

            <div class="text-secondary">
                {{ now()->format('d F Y') }}
            </div>
        </div>

        <div class="p-4">
            @yield('content')
        </div>

    </div>

</body>

</html>