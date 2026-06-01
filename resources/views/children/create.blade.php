<!DOCTYPE html>
<html>
<body>

<h1>Tambah Data Anak</h1>

<form action="{{ route('children.store') }}" method="POST">

    @csrf

    <input type="text"
           name="nama_anak"
           placeholder="Nama Anak">

    <br><br>

    <input type="number"
           name="usia_anak"
           placeholder="Usia Anak">

    <br><br>

    <select name="jenis_kelamin">
        <option value="L">Laki-Laki</option>
        <option value="P">Perempuan</option>
    </select>

    <br><br>

    <input type="text"
           name="tingkat_kemampuan_bicara"
           placeholder="Kemampuan Bicara">

    <br><br>

    <textarea
        name="respon_verbal"
        placeholder="Respon Verbal"></textarea>

    <br><br>

    <textarea
        name="riwayat_perkembangan_bahasa"
        placeholder="Riwayat Perkembangan"></textarea>

    <br><br>

    <button type="submit">
        Simpan
    </button>

</form>

</body>
</html>