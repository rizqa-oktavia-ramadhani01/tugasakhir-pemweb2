<!DOCTYPE html>
<html>
<body>

<h1>Edit Data Anak</h1>

<form action="{{ route('children.update',$child->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <input type="text"
           name="nama_anak"
           value="{{ $child->nama_anak }}">

    <br><br>

    <input type="number"
           name="usia_anak"
           value="{{ $child->usia_anak }}">

    <br><br>

    <select name="jenis_kelamin">

        <option value="L"
            {{ $child->jenis_kelamin == 'L' ? 'selected' : '' }}>
            Laki-Laki
        </option>

        <option value="P"
            {{ $child->jenis_kelamin == 'P' ? 'selected' : '' }}>
            Perempuan
        </option>

    </select>

    <br><br>

    <input type="text"
           name="tingkat_kemampuan_bicara"
           value="{{ $child->tingkat_kemampuan_bicara }}">

    <br><br>

    <textarea name="respon_verbal">{{ $child->respon_verbal }}</textarea>

    <br><br>

    <textarea name="riwayat_perkembangan_bahasa">{{ $child->riwayat_perkembangan_bahasa }}</textarea>

    <br><br>

    <button type="submit">
        Update
    </button>

</form>

</body>
</html>