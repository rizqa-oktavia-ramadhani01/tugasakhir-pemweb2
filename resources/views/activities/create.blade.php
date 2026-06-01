<!DOCTYPE html>
<html>

<head>
    <title>Tambah Activity</title>
</head>

<body>

    <h1>Tambah Activity</h1>

    <form action="{{ route('activities.store') }}" method="POST">
        @csrf

        <input type="text" name="judul" placeholder="Judul">

        <br><br>

        <input type="text" name="kategori" placeholder="Kategori">

        <br><br>

        <input type="number" name="durasi_menit" placeholder="Durasi">

        <br><br>

        <textarea name="deskripsi" placeholder="Deskripsi"></textarea>

        <br><br>

        <textarea name="panduan" placeholder="Panduan"></textarea>

        <br><br>

        <button type="submit">
            Simpan
        </button>

    </form>

</body>

</html>