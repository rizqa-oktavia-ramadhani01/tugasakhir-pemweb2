@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">

        <div class="mb-4">
            <h2 class="fw-bold">Pusat Edukasi</h2>
            <p class="text-muted mb-0">
                Artikel dan panduan untuk mendukung perkembangan bahasa dan komunikasi anak.
            </p>
        </div>

        <div class="row g-4">

            @foreach($educations as $education)

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">

                        {{-- Banner --}}
                        <div class="position-relative" style="
                                                    background: {{ $education->banner_color }};
                                                    height: 150px;
                                                ">

                            <div class="position-absolute top-50 start-50 translate-middle">
                                <i class="fas fa-puzzle-piece text-white fs-1"></i>
                            </div>

                            <span class="badge bg-dark position-absolute bottom-0 end-0 m-3">
                                {{ $education->badge }}
                            </span>

                        </div>

                        {{-- Body --}}
                        <div class="card-body p-4">

                            <small class="text-muted fw-semibold">
                                <i class="far fa-clock me-1"></i>
                                {{ $education->reading_time }}
                            </small>

                            <h4 class="fw-bold mt-3">
                                {{ $education->title }}
                            </h4>

                            <p class="text-muted">
                                {{ $education->excerpt }}
                            </p>

                            <hr>

                            <div class="d-flex justify-content-between align-items-center">

                                <a href="{{ route('education.show', $education->id) }}"
                                    class="text-decoration-none fw-semibold text-primary">
                                    Baca Selengkapnya
                                </a>

                                <i class="fas fa-arrow-right text-primary"></i>

                            </div>

                        </div>

                    </div>
                </div>

            @endforeach

        </div>

    </div>
@endsection