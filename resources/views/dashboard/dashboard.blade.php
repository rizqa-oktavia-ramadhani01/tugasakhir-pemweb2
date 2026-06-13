@extends('layouts.app')

@section('content')

    @if($child)

        <div class="card border-0 shadow-sm text-white mb-4"
            style="background:linear-gradient(135deg,#4F46E5,#7C3AED); border-radius:30px;">
            <div class="card-body p-5">

                <span class="badge px-3 py-2" style="background:rgba(255,255,255,.2); color:white;">
                    SELAMAT DATANG DI TUTURO
                </span>

                <h1 class="fw-bold display-5">
                    Mulai Stimulasi Bicara
                    {{ $child->nama_anak }}
                    Hari Ini!
                </h1>

                <p class="fs-5">
                    Dukung perkembangan bahasa dan tumbuh kembang anak
                    melalui aktivitas harian yang menyenangkan.
                </p>

            </div>

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <h6 class="text-secondary">
                            DATA ANAK
                        </h6>

                        <h3 class="fw-bold">
                            {{ $child->nama_anak }}
                        </h3>

                        <p>
                            Usia :
                            {{ $child->usia_anak }} Tahun
                        </p>

                        <span class="badge bg-success">
                            Aktif
                        </span>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <h6 class="text-secondary">
                            AKTIVITAS HARIAN
                        </h6>

                        <h2 class="fw-bold">
                            {{ $completedTasks }}
                            /
                            {{ $totalTasks }}
                        </h2>

                        <p>
                            Aktivitas selesai
                        </p>

                        <div class="progress">

                            <div class="progress-bar bg-success"
                                style="--width: {{ $taskProgressPercent }}%; width: var(--width)"></div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <h6 class="text-secondary">
                            PROGRES MILESTONE
                        </h6>

                        <h2 class="fw-bold text-dark">
                            {{ $milestoneProgressPercent }}%
                        </h2>
                        <p>
                            Perkembangan anak
                        </p>

                    </div>

                </div>

            </div>

        </div>

        <div class="row mt-4 g-4">

            <div class="col-md-4">

                <a href="{{ route('children.index') }}" class="text-decoration-none">

                    <div class="card border-0 shadow-sm">

                        <div class="card-body">

                            <h4>
                                Profil Anak
                            </h4>

                            <p class="text-muted">
                                Kelola data anak
                            </p>

                        </div>

                    </div>

                </a>

            </div>

            <div class="col-md-4">

                <a href="{{ route('activities.index') }}" class="text-decoration-none">

                    <div class="card border-0 shadow-sm">

                        <div class="card-body">

                            <h4>
                                Rencana Harian
                            </h4>

                            <p class="text-muted">
                                Kelola aktivitas harian
                            </p>

                        </div>

                    </div>

                </a>

            </div>

            <div class="col-md-4">

                <a href="{{ route('learning-contents.index') }}" class="text-decoration-none">

                    <div class="card border-0 shadow-sm">

                        <div class="card-body">

                            <h4>
                                Materi Edukasi
                            </h4>

                            <p class="text-muted">
                                Materi pembelajaran
                            </p>

                        </div>

                    </div>

                </a>

            </div>

        </div>
        <div class="row mt-4 g-4">

            <div class="col-lg-6">

                <div class="card border-0 shadow-sm h-100 rounded-4">

                    <div class="card-body p-4">

                        <h3 class="fw-bold">
                            TUGAS STRATEGIS ORANG TUA
                        </h3>

                        <p class="text-muted">
                            Lakukan administrasi klinis tumbuh kembang secara mandiri.
                        </p>

                        <hr>

                        <div class="row g-3">

                            <div class="col-6">

                                <a href="{{ route('children.index') }}" class="text-decoration-none text-dark">

                                    <div class="p-3 rounded-4 h-100 d-flex flex-column justify-content-center"
                                        style="background:#EEF2FF; min-height:120px;">

                                        <h5 class="mb-2">
                                            <i class="bi bi-person-vcard-fill me-2" style="color:#4F46E5;"></i>
                                            Profil Tumbuh
                                        </h5>

                                        <small class="text-muted">
                                            Kelola data klinis & usia
                                        </small>

                                    </div>

                                </a>

                            </div>

                            <div class="col-6">

                                <a href="{{ route('activities.index') }}" class="text-decoration-none text-dark">

                                    <div class="p-3 rounded-4 h-100 d-flex flex-column justify-content-center"
                                        style="background:#EEF2FF; min-height:120px;">
                                        <h5 class="mb-2">
                                            <i class="bi bi-clipboard2-check-fill me-2" style="color:#4F46E5;"></i>
                                            Rencana Harian
                                        </h5>

                                        <small class="text-muted">
                                            Kelola aktivitas terapi
                                        </small>

                                    </div>

                                </a>

                            </div>

                            <div class="col-6">

                                <div class="p-3 rounded-4 h-100 d-flex flex-column justify-content-center"
                                    style="background:#EEF2FF; min-height:120px;">

                                    <h5 class="mb-2">
                                        <i class="bi bi-journal-text me-2" style="color:#4F46E5;"></i>
                                        Jurnal Ortu
                                    </h5>

                                    <small class="text-muted">
                                        Segera tersedia
                                    </small>

                                </div>

                            </div>

                            <div class="col-6">

                                <div class="p-3 rounded-4 h-100 d-flex flex-column justify-content-center"
                                    style="background:#EEF2FF; min-height:120px;">

                                    <h5 class="mb-2">
                                        <i class="bi bi-graph-up-arrow me-2" style="color:#4F46E5;"></i>
                                        Pantau Progres
                                    </h5>

                                    <small class="text-muted">
                                        Segera tersedia
                                    </small>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="card border-0 shadow-sm h-100 rounded-4">

                    <div class="card-body p-4">

                        <h3 class="fw-bold">
                            WAHANA BELAJAR BAHASA ANAK
                        </h3>

                        <p class="text-muted">
                            Ajak anak belajar melalui aktivitas interaktif.
                        </p>

                        <hr>

                        <div class="row g-3">

                            <div class="col-4">

                                <a href="{{ route('learning-contents.index') }}" class="text-decoration-none text-dark">

                                    <div class="p-3 rounded-4 h-100 d-flex flex-column justify-content-center"
                                        style="background:#EEF2FF; min-height:120px;">
                                        <i class="bi bi-mic-fill" style="font-size:40px;color:#4F46E5;"></i>

                                        <h6 class="mt-3 fw-semibold">
                                            Latih Pelafalan
                                        </h6>

                                    </div>

                                </a>

                            </div>

                            <div class="col-4">

                                <a href="{{ route('learning-contents.index') }}" class="text-decoration-none text-dark">

                                    <div class="p-3 rounded-4 h-100 d-flex flex-column justify-content-center"
                                        style="background:#EEF2FF; min-height:120px;">
                                        <i class="bi bi-volume-up-fill" style="font-size:40px;color:#4F46E5;"></i>

                                        <h6 class="mt-3 fw-semibold">
                                            Tiru Suara
                                        </h6>

                                    </div>

                                </a>

                            </div>

                            <div class="col-4">

                                <a href="{{ route('learning-contents.index') }}" class="text-decoration-none text-dark">

                                    <div class="p-3 rounded-4 h-100 d-flex flex-column justify-content-center"
                                        style="background:#EEF2FF; min-height:120px;">
                                        <i class="bi bi-patch-check-fill" style="font-size:40px;color:#4F46E5;"></i>

                                        <h6 class="mt-3 fw-semibold">
                                            Tantangan Kuis
                                        </h6>

                                    </div>

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    @else

        <div class="alert alert-warning">

            <h4>
                Data Anak Belum Tersedia
            </h4>

            <p>
                Silakan tambahkan data anak terlebih dahulu.
            </p>

            <a href="{{ route('children.create') }}" class="btn btn-success">
                Tambah Data Anak
            </a>

        </div>

    @endif

@endsection