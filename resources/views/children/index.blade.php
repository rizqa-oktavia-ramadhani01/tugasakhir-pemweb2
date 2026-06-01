<!DOCTYPE html>
<html>
<body>

<h1>Data Anak</h1>

<a href="{{ route('children.create') }}">
    Tambah Anak
</a>

<br><br>

<table border="1">

<tr>
    <th>ID</th>
    <th>Nama Anak</th>
    <th>Usia</th>
    <th>Jenis Kelamin</th>
    <th>Aksi</th>
</tr>

@foreach($children as $child)

<tr>

    <td>{{ $child->id }}</td>
    <td>{{ $child->nama_anak }}</td>
    <td>{{ $child->usia_anak }}</td>
    <td>{{ $child->jenis_kelamin }}</td>

    <td>

        <a href="{{ route('children.show',$child->id) }}">
            Detail
        </a>

        <a href="{{ route('children.edit',$child->id) }}">
            Edit
        </a>

        <form action="{{ route('children.destroy',$child->id) }}"
              method="POST">

            @csrf
            @method('DELETE')

            <button type="submit">
                Hapus
            </button>

        </form>

    </td>

</tr>

@endforeach

</table>

</body>
</html>