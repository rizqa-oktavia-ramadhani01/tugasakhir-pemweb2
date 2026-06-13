@extends('layouts.app')

@section('title', 'Jurnal Harian')

@section('content')
    <div class="container-fluid px-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark">
                <i class="bi bi-journal-text text-primary me-2"></i>
                Jurnal Harian {{ $child->nama_anak }}
            </h3>
            <a href="{{ route('parent-journals.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Jurnal Hari Ini
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @forelse($journals as $journal)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span
                                    class="badge bg-primary">{{ \Carbon\Carbon::parse($journal->tanggal)->translatedFormat('l, d F Y') }}</span>
                                <div>
                                    <a href="{{ route('parent-journals.edit', $journal->id) }}"
                                        class="btn btn-sm btn-warning me-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('parent-journals.destroy', $journal->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin hapus?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <h6 class="fw-bold">
                                <i class="bi bi-list-check text-primary me-2"></i>
                                Aktivitas Dilakukan
                            </h6>
                            <p class="text-muted small">{{ $journal->aktivitas_dilakukan }}</p>

                            @if($journal->respon_anak)
                                <h6 class="fw-bold mt-3">
                                    <i class="bi bi-chat-dots text-primary me-2"></i>
                                    Respon Anak
                                </h6>
                                <p class="text-muted small">{{ $journal->respon_anak }}</p>
                            @endif

                            @if($journal->kata_baru)
                                <h6 class="fw-bold mt-3">
                                    <i class="bi bi-book text-success me-2"></i>
                                    Kata Baru
                                </h6>
                                <p class="text-success small">{{ $journal->kata_baru }}</p>
                            @endif

                            @if($journal->kendala)
                                <h6 class="fw-bold mt-3">
                                    <i class="bi bi-exclamation-triangle text-warning me-2"></i>
                                    Kendala
                                </h6>
                                <p class="text-warning small">{{ $journal->kendala }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Belum ada jurnal. <a href="{{ route('parent-journals.create') }}">Tulis jurnal hari ini</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection