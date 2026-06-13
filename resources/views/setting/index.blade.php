@extends('layouts.child-selection')

@section('content')

    <div class="container-fluid">

        <div class="card border-0 shadow-sm mb-4 overflow-hidden">

            <div class="card-body p-5 text-white" style="background:linear-gradient(135deg,#4F46E5,#6366F1);">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>

                        <h1 class="fw-bold mb-2 text-white">
                            Data Anak
                        </h1>

                        <p class="mb-0 opacity-75">
                            Kelola data anak yang terhubung dengan akun Anda.
                        </p>

                    </div>

                    <a href="{{ route('children.create') }}" class="btn btn-light">

                        <i class="bi bi-plus-circle me-2"></i>

                        Tambah Anak

                    </a>

                </div>

            </div>

        </div>

        <div class="row g-4">

            @forelse($children as $child)

                <div class="col-md-6 col-xl-4">
                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-body d-flex flex-column">

                            <div class="d-flex align-items-center mb-3">

                                <div class="rounded-circle text-white fw-bold d-flex align-items-center justify-content-center"
                                    style="width:60px;height:60px;background:#4F46E5;">

                                    {{ strtoupper(substr($child->nama_anak, 0, 1)) }}

                                </div>

                                <div class="ms-3">

                                    <h5 class="fw-bold mb-1">
                                        {{ $child->nama_anak }}
                                    </h5>

                                    <small class="text-muted d-block">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        {{ $child->usia_anak }} Tahun
                                    </small>

                                    <small class="text-muted">
                                        <i class="bi bi-person me-1"></i>
                                        {{ $child->jenis_kelamin }}
                                    </small>

                                </div>

                            </div>

                            <hr>

                            <div class="d-grid mb-3">

                                <a href="{{ route('switch.child', $child->id) }}" class="btn text-white"
                                    style="background:#4F46E5;">

                                    <i class="fa-solid fa-house"></i>

                                    Buka Dashboard

                                </a>

                            </div>

                            <div class="row g-2 mt-auto">

                                <div class="col-4">

                                    <a href="{{ route('children.show', $child->id) }}" class="btn btn-light border w-100">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                </div>

                                <div class="col-4">

                                    <a href="{{ route('children.edit', $child->id) }}" class="btn btn-light border w-100">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>

                                </div>

                                <div class="col-4">

                                    <form action="{{ route('children.destroy', $child->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-light border text-danger w-100"
                                            onclick="return confirm('Yakin hapus data anak ini?')">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="card border-0 shadow-sm">

                        <div class="card-body text-center py-5">

                            <i class="bi bi-person-plus" style="font-size:60px;color:#4F46E5;"></i>

                            <h4 class="mt-3">
                                Belum Ada Data Anak
                            </h4>

                            <p class="text-muted">
                                Tambahkan data anak terlebih dahulu.
                            </p>

                            <a href="{{ route('children.create') }}" class="btn text-white" style="background:#4F46E5;">

                                <i class="bi bi-plus-circle me-2"></i>

                                Tambah Anak

                            </a>

                        </div>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

@endsection