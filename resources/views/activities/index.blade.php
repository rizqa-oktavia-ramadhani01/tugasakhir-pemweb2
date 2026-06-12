@extends('layouts.app')

@section('title', 'Rencana Harian')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">📋 Rencana Harian</h3>
        <div class="bg-white rounded-3 px-4 py-2 shadow-sm">
            <span class="text-muted">Progres Hari Ini</span>
            <span class="fw-bold text-success ms-2">{{ $progress ?? 0 }}%</span>
        </div>
    </div>

    <div class="bg-white rounded-4 p-3 mb-4 shadow-sm">
        <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">Selesai {{ $completedCount ?? 0 }} dari {{ $totalActivities ?? 0 }} aktivitas</span>
        </div>
        <div class="progress" style="height: 10px;">
            <div class="progress-bar bg-success" style="width: {{ $progress ?? 0 }}%"></div>
        </div>
    </div>

    <div class="row g-4">
        @forelse($activities as $activity)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="fw-bold text-dark mb-0">{{ $activity->judul }}</h5>
                        <span class="badge bg-light text-success px-3 py-1 rounded-pill">
                            <i class="bi bi-clock"></i> {{ $activity->durasi_menit }} mnt
                        </span>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success mb-3 py-1 px-2">
                        {{ $activity->kategori }}
                    </span>
                    <p class="text-muted small mb-3">{{ $activity->deskripsi }}</p>

                    @if($activity->panduan)
                    <div class="accordion mb-3" id="accordion{{ $activity->id }}">
                        <div class="accordion-item border-0 bg-light rounded-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-light text-dark small py-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $activity->id }}">
                                    <i class="bi bi-journal-text me-2"></i> Lihat Panduan
                                </button>
                            </h2>
                            <div id="collapse{{ $activity->id }}" class="accordion-collapse collapse">
                                <div class="accordion-body small text-muted bg-light rounded-bottom">
                                    {{ $activity->panduan }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @php
                        $isChecked = isset($todayLogs[$activity->id]) && $todayLogs[$activity->id]->selesai == 1;
                    @endphp

                    <form action="{{ route('toggle-activity') }}" method="POST" class="d-inline w-100">
                        @csrf
                        <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                        <input type="hidden" name="child_id" value="{{ session('active_child_id') }}">
                        <input type="hidden" name="selesai" value="{{ $isChecked ? 0 : 1 }}">
                        <button type="submit" class="toggle-activity-btn w-100 py-2 rounded-3 fw-semibold border-0 transition
                            {{ $isChecked ? 'bg-success text-white' : 'bg-light text-secondary' }}">
                            <i class="bi bi-check-circle me-2"></i>
                            <span class="toggle-text">
                                {{ $isChecked ? '✅ Selesai Dilatih' : '☐ Centang Selesai' }}
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning text-center">
                Belum ada aktivitas. Silakan admin tambah activity terlebih dahulu.
            </div>
        </div>
        @endforelse
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.toggle-activity-btn').click(function(e) {
        e.preventDefault();
        let $form = $(this).closest('form');
        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize(),
            success: function(response) {
                location.reload();
            },
            error: function() {
                alert('Terjadi kesalahan');
            }
        });
    });
});
</script>
@endsection