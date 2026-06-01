<!DOCTYPE html>
<html>

<body>

    <h1>Tambah Learning Content</h1>

    <form action="{{ route('learning-contents.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <input type="text" name="judul">

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

        <br><br>

        <textarea name="deskripsi"></textarea>

        <br><br>

        <textarea name="isi"></textarea>

        <br><br>

        Gambar :
        <input type="file" name="gambar">

        <br><br>

        Audio :
        <input type="file" name="audio">

        <br><br>

        <button type="submit">
            Simpan
        </button>

    </form>

</body>

</html>