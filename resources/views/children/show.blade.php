<!DOCTYPE html>
<html>
<body>

<h1>Detail Anak</h1>

<p>
    <b>Nama :</b>
    {{ $child->nama_anak }}
</p>

<p>
    <b>Usia :</b>
    {{ $child->usia_anak }}
</p>

<p>
    <b>Jenis Kelamin :</b>
    {{ $child->jenis_kelamin }}
</p>

<p>
    <b>Kemampuan Bicara :</b>
    {{ $child->tingkat_kemampuan_bicara }}
</p>

<p>
    <b>Respon Verbal :</b>
    {{ $child->respon_verbal }}
</p>

<p>
    <b>Riwayat :</b>
    {{ $child->riwayat_perkembangan_bahasa }}
</p>

</body>
</html>