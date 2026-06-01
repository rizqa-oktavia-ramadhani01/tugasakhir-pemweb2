<!DOCTYPE html>
<html>

<head>
    <title>Edit Learning Content</title>
</head>

<body>

    <form action="{{ route('learning-contents.update',$content->id) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <input type="text"
            name="judul"
            value="{{ $content->judul }}">

        <br><br>

        <select name="kategori">

            <option value="Pronunciation">
                Pronunciation
            </option>

            <option value="Sound_Imitation">
                Sound Imitation
            </option>

            <option value="artikel">
                Artikel
            </option>

            <option value="storytelling">
                Storytelling
            </option>

        </select>

        <textarea name="deskripsi">{{ $content->deskripsi }}</textarea>

        <br><br>

        <textarea name="isi">{{ $content->isi }}</textarea>

        <br><br>

        <input type="file" name="gambar">

        <br><br>

        <input type="file" name="audio">

        <br><br>

        <button type="submit">
            Update
        </button>

    </form>

</body>

</html>