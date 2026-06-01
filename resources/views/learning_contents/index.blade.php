<!DOCTYPE html>
<html>
<body>

<h1>Learning Content</h1>

<a href="{{ route('learning-contents.create') }}">
    Tambah Data
</a>

<br><br>

<table border="1">

    <tr>
        <th>ID</th>
        <th>Judul</th>
        <th>Kategori</th>
        <th>Aksi</th>
    </tr>

    @foreach($contents as $content)

    <tr>

        <td>{{ $content->id }}</td>
        <td>{{ $content->judul }}</td>
        <td>{{ $content->kategori }}</td>

        <td>

            <a href="{{ route('learning-contents.show',$content->id) }}">
                Detail
            </a>

            <a href="{{ route('learning-contents.edit',$content->id) }}">
                Edit
            </a>

            <form action="{{ route('learning-contents.destroy',$content->id) }}"
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