<!DOCTYPE html>
<html>

<head>
    <title>Detail Activity</title>
</head>

<body>

    <h1>Detail Activity</h1>

    <h2>{{ $activity->judul }}</h2>

    <p>
        <b>Kategori :</b>
        {{ $activity->kategori }}
    </p>

    <p>
        <b>Durasi :</b>
        {{ $activity->durasi_menit }} menit
    </p>

    <p>
        <b>Deskripsi :</b>
        {{ $activity->deskripsi }}
    </p>

    <p>
        <b>Panduan :</b>
        {{ $activity->panduan }}
    </p>

    <a href="{{ route('activities.index') }}">
        Kembali
    </a>

</body>

</html>