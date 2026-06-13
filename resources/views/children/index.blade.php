@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i>
                Kembali
            </a>

            <a href="{{ route('children.edit', $child->id) }}" class="btn rounded-pill px-4 text-white"
                style="background:#4F46E5;">
                <i class="bi bi-pencil-square me-2"></i>
                Edit Data
            </a>

        </div>

        <div class="card border-0 shadow-sm overflow-hidden">

            <div class="card-body p-0">

                <div class="p-5 text-white" style="background:linear-gradient(135deg,#4F46E5,#7C3AED);">

                    <div class="d-flex align-items-center gap-4">

                        <div style="
                                            width:90px;
                                            height:90px;
                                            background:white;
                                            color:#4F46E5;
                                            border-radius:50%;
                                            display:flex;
                                            align-items:center;
                                            justify-content:center;
                                            font-size:36px;
                                            font-weight:bold;
                                        ">
                            {{ strtoupper(substr($child->nama_anak, 0, 1)) }}
                        </div>

                        <div>

                            <h1 class="fw-bold mb-2">
                                {{ $child->nama_anak }}
                            </h1>

                            <p class="mb-3 opacity-75">
                                Profil perkembangan bahasa anak
                            </p>

                            <span class="badge bg-light text-dark me-2">
                                {{ $child->usia_anak }} Tahun
                            </span>

                            <span class="badge bg-light text-dark">
                                {{ $child->jenis_kelamin }}
                            </span>

                        </div>

                    </div>

                </div>

                <div class="p-4">

                    <div class="row g-4">

                        <div class="col-md-6">

                            <div class="card border-0 h-100" style="background:#EEF2FF;">

                                <div class="card-body">

                                    <div class="mb-3">
                                        <i class="bi bi-chat-dots-fill" style="font-size:40px;color:#4F46E5;"></i>
                                    </div>

                                    <h5 class="fw-bold mt-2">
                                        Kemampuan Bicara
                                    </h5>

                                    <p class="mb-0 text-muted">
                                        {{ $child->tingkat_kemampuan_bicara }}
                                    </p>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="card border-0 h-100" style="background:#F3E8FF;">

                                <div class="card-body">

                                    <div class="mb-3">
                                        <i class="bi bi-mic-fill" style="font-size:40px;color:#7C3AED;"></i>
                                    </div>

                                    <h5 class="fw-bold mt-2">
                                        Respon Verbal
                                    </h5>

                                    <p class="mb-0 text-muted">
                                        {{ $child->respon_verbal }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card border-0 shadow-sm mt-4">

                        <div class="card-body">

                            <h4 class="fw-bold mb-3">
                                <i class="bi bi-journal-text me-2 text-primary"></i>
                                Riwayat Perkembangan Bahasa
                            </h4>

                            <div class="p-3 rounded" style="background:#F8FAFC;">

                                {{ $child->riwayat_perkembangan_bahasa ?? 'Tidak ada data riwayat.' }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection