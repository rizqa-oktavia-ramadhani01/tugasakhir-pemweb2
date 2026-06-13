@extends('layouts.app')

@section('title', 'Pantau Progres')

@section('content')
<div class="container-fluid px-0">
    <!-- Header -->
    <div class="mb-4">
        <h3 class="fw-bold text-dark">📊 Pusat Analitik</h3>
        <p class="text-muted">Pemantauan Progres & Konsistensi</p>
        <small class="text-muted">Analisis mingguan keseriusan stimulasi orang tua diselaraskan dengan pencapaian tonggak bicara (milestones) sang anak.</small>
    </div>

    <!-- Streak & Konsistensi -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 text-center">
                    <div class="mb-3">
                        <span class="display-1 fw-bold text-warning">🔥</span>
                    </div>
                    <h2 class="fw-bold text-dark">{{ $streak }} Hari</h2>
                    <p class="text-muted">Streak Ortu (Hari Beruntun)</p>
                    <span class="badge bg-warning">Metrik Konsistensi</span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-gradient-success text-white" style="background: linear-gradient(135deg, #00b894, #008f7a);">
                <div class="card-body p-4 text-center">
                    <h1 class="display-1 fw-bold">{{ $consistencyPercent }}%</h1>
                    <p class="fs-5">Rapor Komitmen Ortu</p>
                    <p class="small">Digabungkan dari aktivitas terselesaikan & jurnal harian yang dimasukkan.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Peringkat -->
    @if($betterThan > 0)
    <div class="alert alert-success rounded-4 mb-4">
        <i class="bi bi-trophy-fill me-2"></i>
        <strong>Sangat Baik!</strong> Anda melampaui {{ $betterThan }}% orang tua di kelompok tumbuh kembang {{ $child->nama_anak }} minggu ini! Pertahankan interaksi verbalnya.
    </div>
    @endif

    <!-- Grup Aktivitas & Grafik -->
    <div class="row g-4 mb-4">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold">📈 Grup Aktivitas</h5>
                        <span class="badge bg-info">Grafik Stimulasi Mingguan</span>
                    </div>
                    
                    <p class="text-muted mb-3">Sesi Terapi Mandiri - Fluktuasi pengerjaan PR harian melatih oral motorik & reseptif wicara.</p>
                    
                    <!-- Grafik Batang -->
                    <div class="d-flex justify-content-between align-items-end" style="height: 200px;">
                        @foreach($weeklyData as $day)
                        <div class="text-center" style="flex: 1;">
                            <div class="bg-success rounded-3 mx-auto" style="width: 30px; height: {{ ($day['completed'] / max($day['total'], 1)) * 60 }}px; min-height: 5px; background-color: {{ $day['isToday'] ? '#4F46E5' : '#00b894' }};"></div>
                            <p class="mt-2 small fw-bold">{{ $day['completed'] }}/{{ $day['total'] }}</p>
                            <p class="small text-muted">{{ $day['hari'] }}</p>
                            @if($day['isToday'])
                            <span class="badge bg-primary">Hari Ini</span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-4 text-center">
                        <p class="text-muted small">Target Ideal: {{ $targetPerHari }} Sesi/Hari</p>
                        @if($hariIni >= $targetPerHari)
                        <span class="badge bg-success">✅ Target Hari Ini Tercapai!</span>
                        @else
                        <span class="badge bg-warning">⚠️ {{ $hariIni }} dari {{ $targetPerHari }} sesi hari ini</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Metrik Klinis -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">📋 Metrik Klinis</h5>
                    <p class="text-muted small">Pencapaian Milestone - Target tumbuh kembang wicara dari Ikatan Dokter Anak Indonesia (IDAI).</p>
                    
                    <div class="text-center my-4">
                        <h1 class="display-1 fw-bold text-success">{{ $milestoneProgress['percent'] }}%</h1>
                        <p class="text-muted">Progres Usia {{ $child->usia_anak }} Tahun</p>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" style="width: {{ $milestoneProgress['percent'] }}%"></div>
                        </div>
                        <p class="small mt-2">{{ $milestoneProgress['completed'] }} dari {{ $milestoneProgress['total'] }} milestone tercapai</p>
                    </div>
                    
                    <!-- Detail Milestone -->
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-6">
                                <div class="p-2 bg-light rounded-3 text-center">
                                    <h4 class="fw-bold text-primary">{{ $stats['total_kata_baru'] }}</h4>
                                    <small class="text-muted">Suku Kata Stabil</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded-3 text-center">
                                    <h4 class="fw-bold text-primary">{{ $milestoneProgress['total'] }}</h4>
                                    <small class="text-muted">Aspek Observasi</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Milestone yang Dicapai -->
    <div class="card border-0 shadow-sm rounded-4 mt-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">🎯 Pencapaian Milestone</h5>
            <div class="row">
                @foreach($milestoneProgress['items'] as $item)
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3">
                        @if($item['status'] == 'tercapai')
                            <i class="bi bi-check-circle-fill text-success fs-3"></i>
                            <div>
                                <p class="fw-bold mb-0">{{ $item['milestone'] }}</p>
                                <small class="text-muted">{{ $item['deskripsi'] }}</small>
                            </div>
                        @else
                            <i class="bi bi-clock-history text-warning fs-3"></i>
                            <div>
                                <p class="fw-bold mb-0 text-muted">{{ $item['milestone'] }}</p>
                                <small class="text-muted">{{ $item['deskripsi'] }}</small>
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection