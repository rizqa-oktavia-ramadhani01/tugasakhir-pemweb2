<!DOCTYPE html>
<html>

<head>
    <title>Data Activity</title>
</head>

<body>

    <h1>Data Activity</h1>

    <a href="{{ route('activities.create') }}">
        Tambah Activity
    </a>

    <hr>

    <table border="1">

        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Durasi</th>
            <th>Aksi</th>
        </tr>

        @foreach($activities as $activity)
        <tr>

            <td>{{ $activity->id }}</td>
            <td>{{ $activity->judul }}</td>
            <td>{{ $activity->kategori }}</td>
            <td>{{ $activity->durasi_menit }}</td>

            <td>

                <a href="{{ route('activities.show',$activity->id) }}">
                    Detail
                </a>

                <a href="{{ route('activities.edit',$activity->id) }}">
                    Edit
                </a>

                <form
                    action="{{ route('activities.destroy',$activity->id) }}"
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