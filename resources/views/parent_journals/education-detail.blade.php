@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <a href="{{ route('education.index') }}"
           class="btn btn-outline-secondary btn-sm">
            Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">

        <div
            style="
                background: {{ $education->banner_color }};
                height: 220px;
            "
            class="rounded-top-4">
        </div>

        <div class="card-body p-5">

            <span class="badge bg-dark mb-3">
                {{ $education->badge }}
            </span>

            <h1 class="fw-bold mb-3">
                {{ $education->title }}
            </h1>

            <p class="text-muted mb-4">
                {{ $education->reading_time }}
            </p>

            <div class="lh-lg">
                {{ $education->content }}
            </div>

        </div>

    </div>

</div>

@endsection