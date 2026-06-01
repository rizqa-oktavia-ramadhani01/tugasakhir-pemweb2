<!DOCTYPE html>
<html>

<head>
    <title>Edit Activity</title>
</head>

<body>

    <h1>Edit Activity</h1>

    <form action="{{ route('activities.update',$activity->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input
            type="text"
            name="judul"
            value="{{ $activity->judul }}">

        <br><br>

        <input
            type="text"
            name="kategori"
            value="{{ $activity->kategori }}">

        <br><br>

        <input
            type="number"
            name="durasi_menit"
            value="{{ $activity->durasi_menit }}">

        <br><br>

        <textarea name="deskripsi">{{ $activity->deskripsi }}</textarea>

        <br><br>

        <textarea name="panduan">{{ $activity->panduan }}</textarea>

        <br><br>

        <button type="submit">
            Update
        </button>

    </form>

</body>

</html>