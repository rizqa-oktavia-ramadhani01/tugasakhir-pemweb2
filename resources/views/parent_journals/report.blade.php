@extends('layouts.app')

@section('title', 'Laporan Kata Baru')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">📊 Laporan Kata Baru - {{ $child->nama_anak }}</h3>
        <a href="{{ route('parent-journals.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body text-center p-4">
                    <h1 class="display-2 fw-bold text-success">{{ $totalKataBaru }}</h1>
                    <p class="text-muted">Total Kata Baru Terucap</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">📖 Daftar Kata Baru (Unik)</h5>
                    <div class="d-flex flex-wrap gap-2">
                        @forelse($kataBaruList as $kata)
                            <span class="badge bg-success fs-6 py-2 px-3">{{ $kata }}</span>
                        @empty
                            <p class="text-muted">Belum ada kata baru yang dicatat</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mt-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">📅 Riwayat Kata Baru per Hari</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kata Baru</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($journals as $journal)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($journal->tanggal)->translatedFormat('d F Y') }}</td>
                            <td>{{ $journal->kata_baru ?? '-' }}</td>
                            <td>{{ $journal->kata_baru ? count(explode(',', $journal->kata_baru)) : 0 }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection