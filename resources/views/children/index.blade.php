<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anak</title>
    <style>
        /* 1. Reset Dasar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            color: #333;
            padding: 20px;
        }

        /* 2. Container Full Width */
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 24px;
            color: #2c3e50;
        }

        .btn-add {
            background-color: #27ae60;
            color: white;
            text-decoration: none;
            padding: 10px 24px;
            border-radius: 6px;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-add:hover {
            background-color: #219150;
        }

        /* 3. CSS GRID LAYOUT */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        /* 4. Desain Kartu (Card) */
        .child-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            transition: transform 0.2s, box-shadow 0.2s;
            border: 1px solid transparent;
        }

        .child-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-color: #e0e0e0;
        }

        /* --- PERBAIKAN DI SINI --- */
        .card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;

            /* Tambah padding kanan yang besar (selebar tombol) */
            padding-right: 140px;

            width: 100%;
        }

        .card-info {
            flex: 1;
            /* Agar area teks mengambil sisa ruang yang tersedia */
            min-width: 0;
            /* Diperlukan agar ellipsis (titik tiga) bisa bekerja */
        }

        .card-info h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 2px;

            /* Agar nama panjang dipotong dan diberi titik tiga "..." */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-info p {
            font-size: 13px;
            color: #777;
        }

        /* ----------------------- */

        .divider {
            height: 1px;
            background-color: #eee;
            margin: 15px 0;
        }

        .btn-dashboard {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 10px;
            background-color: #f8f9fa;
            color: #333;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
            gap: 8px;
        }

        .btn-dashboard:hover {
            background-color: #007bff;
            color: white;
        }

        .btn-dashboard svg {
            width: 16px;
            height: 16px;
            fill: currentColor;
            transition: transform 0.2s;
        }

        .btn-dashboard:hover svg {
            transform: translateX(4px);
        }

        /* --- TOMBOL AKSI (POJOK KANAN ATAS) --- */
        .card-actions {
            position: absolute;
            top: 15px;
            right: 15px;
            display: flex;
            gap: 8px;
            z-index: 10;
        }

        .icon-btn {
            background: white;
            border: 1px solid #eee;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #555;
            transition: all 0.2s;
            text-decoration: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .icon-btn svg {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }

        .icon-btn:hover {
            transform: scale(1.1);
        }

        .icon-btn.view:hover {
            background-color: #e3f2fd;
            color: #1976d2;
            border-color: #bbdefb;
        }

        .icon-btn.edit:hover {
            background-color: #fff3e0;
            color: #f57c00;
            border-color: #ffe0b2;
        }

        .icon-btn.delete:hover {
            background-color: #ffebee;
            color: #d32f2f;
            border-color: #ffcdd2;
        }

        .form-delete {
            display: inline;
            padding: 0;
            margin: 0;
            background: none;
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 50px;
            color: #888;
            background: white;
            border-radius: 12px;
        }
    </style>
</head>

<body>

    <div class="container">

        <header>
            <h1>Data Anak</h1>
            <a href="{{ route('children.create') }}" class="btn-add">
                <svg style="width:20px;height:20px;fill:white;" viewBox="0 0 24 24">
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                </svg>
                Tambah Anak
            </a>
        </header>

        <div class="card-grid">

            @forelse($children as $child)

            <div class="child-card">

                <!-- Area Tombol Aksi -->
                <div class="card-actions">
                    <a href="{{ route('children.show', $child->id) }}" class="icon-btn view" title="Lihat Detail">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                        </svg>
                    </a>

                    <a href="{{ route('children.edit', $child->id) }}" class="icon-btn edit" title="Edit">
                        <svg viewBox="0 0 24 24">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                        </svg>
                    </a>

                    <form action="{{ route('children.destroy', $child->id) }}"
                        method="POST"
                        class="form-delete"
                        onsubmit="return confirm('Yakin hapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="icon-btn delete" title="Hapus">
                            <svg viewBox="0 0 24 24">
                                <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Info Kartu -->
                <div class="card-header">
                    <div class="avatar">
                        {{ substr($child->nama_anak, 0, 1) }}
                    </div>
                    <div class="card-info">
                        <h3 title="{{ $child->nama_anak }}">{{ $child->nama_anak }}</h3>
                        <p>{{ $child->usia_anak }} Tahun &bull; {{ $child->jenis_kelamin }}</p>
                    </div>
                </div>

                <div class="divider"></div>

                <a href="{{ route('switch.child', $child->id) }}" class="btn-dashboard">
                    Buka Dashboard
                    <svg viewBox="0 0 24 24">
                        <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z" />
                    </svg>
                </a>

            </div>

            @empty
            <div class="empty-state">
                <p>Belum ada data anak.</p>
            </div>
            @endforelse

        </div>
    </div>

</body>

</html>