@extends('layouts.app')

@section('title', 'Edit Jurnal')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h3 class="fw-bold mb-4">✏️ Edit Jurnal - {{ \Carbon\Carbon::parse($journal->tanggal)->translatedFormat('l, d F Y') }}</h3>
                    
                    <form action="{{ route('parent-journals.update', $journal->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Aktivitas yang Dilakukan <span class="text-danger">*</span></label>
                            <textarea name="aktivitas_dilakukan" class="form-control" rows="4" required>{{ $journal->aktivitas_dilakukan }}</textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Respon Anak</label>
                            <textarea name="respon_anak" class="form-control" rows="3">{{ $journal->respon_anak }}</textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kata Baru (pisahkan dengan koma)</label>
                            <input type="text" name="kata_baru" class="form-control" value="{{ $journal->kata_baru }}">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kendala</label>
                            <textarea name="kendala" class="form-control" rows="2">{{ $journal->kendala }}</textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Catatan Tambahan</label>
                            <textarea name="catatan" class="form-control" rows="2">{{ $journal->catatan }}</textarea>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">💾 Update Jurnal</button>
                            <a href="{{ route('parent-journals.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection