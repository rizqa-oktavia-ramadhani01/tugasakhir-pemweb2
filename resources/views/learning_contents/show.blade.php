<!DOCTYPE html>
<html>

<head>
    <title>Detail Learning Content</title>
</head>

<body>

    <h2>{{ $content->judul }}</h2>

    <p>
        <b>Kategori :</b>
        {{ $content->kategori }}
    </p>

    <p>
        <b>Deskripsi :</b>
        {{ $content->deskripsi }}
    </p>

    <p>
        <b>Isi :</b>
        {{ $content->isi }}
    </p>

    <h3>Gambar</h3>

    @if($content->gambar)

    <img
        src="{{ asset('storage/'.$content->gambar) }}"
        width="250">

    @endif

    <h3>Audio</h3>

    @if($content->audio)

    <audio controls>

        <source
            src="{{ asset('storage/'.$content->audio) }}"
            type="audio/mpeg">

    </audio>

    @endif

    <a href="{{ route('learning-contents.index') }}">
        Kembali
    </a>

</body>

</html>