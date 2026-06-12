@extends('layouts.app')

@section('title', 'Tambah Jurnal')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h3 class="fw-bold mb-4">📝 Jurnal Harian - {{ $child->nama_anak }}</h3>
                    <p class="text-muted">Tanggal: {{ now()->translatedFormat('l, d F Y') }}</p>
                    
                    <form action="{{ route('parent-journals.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="child_id" value="{{ $child->id }}">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Aktivitas yang Dilakukan <span class="text-danger">*</span></label>
                            <textarea name="aktivitas_dilakukan" class="form-control" rows="4" required placeholder="Contoh: Latihan pelafalan huruf B, bermain tebak suara hewan, dll"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Respon Anak</label>
                            <textarea name="respon_anak" class="form-control" rows="3" placeholder="Contoh: Anak antusias, mengikuti dengan baik, sedikit kesulitan..."></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kata Baru (pisahkan dengan koma)</label>
                            <input type="text" name="kata_baru" class="form-control" placeholder="Contoh: mobil, kucing, makan, minum">
                            <small class="text-muted">Kata yang berhasil diucapkan anak hari ini</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kendala</label>
                            <textarea name="kendala" class="form-control" rows="2" placeholder="Contoh: Anak mudah teralihkan, susah fokus..."></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Catatan Tambahan</label>
                            <textarea name="catatan" class="form-control" rows="2" placeholder="Catatan khusus untuk terapis/ahli"></textarea>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">💾 Simpan Jurnal</button>
                            <a href="{{ route('parent-journals.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection