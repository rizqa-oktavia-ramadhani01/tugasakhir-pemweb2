<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Anak</title>
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
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        /* 2. Container */
        .container {
            width: 100%;
            max-width: 800px;
            margin-top: 20px;
        }

        /* 3. Kartu Form */
        .form-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            padding: 40px;
        }

        /* Header Judul & Tombol Back */
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #f0f2f5;
            padding-bottom: 15px;
        }

        .card-header h2 {
            font-size: 24px;
            color: #222;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            color: #666;
            font-size: 14px;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 20px;
            background-color: #f1f3f5;
            transition: background 0.2s;
        }

        .btn-back:hover {
            background-color: #e9ecef;
            color: #000;
        }

        .btn-back svg {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }

        /* 4. Layout Grid Form */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr; /* Default 1 kolom untuk HP */
            gap: 20px;
        }

        /* 2 Kolom untuk layar Desktop */
        @media (min-width: 600px) {
            .form-grid {
                grid-template-columns: 1fr 1fr;
            }
            .full-width {
                grid-column: span 2; /* Mengambil 2 kolom penuh */
            }
        }

        /* Styling Label */
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Styling Input & Textarea */
        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 12px 15px;
            font-size: 15px;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-family: inherit;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #28a745; /* Warna Fokus Hijau */
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
            line-height: 1.5;
        }

        /* 5. Tombol Submit */
        .form-actions {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
            border-top: 1px solid #f0f2f5;
            padding-top: 20px;
        }

        .btn-submit {
            background-color: #28a745; /* Hijau untuk Tambah */
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background-color: #218838;
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        /* Responsif Tambahan untuk Mobile */
        @media (max-width: 600px) {
            .form-card {
                padding: 20px;
            }
            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        
        <div class="form-card">
            
            <!-- Header -->
            <div class="card-header">
                <h2>Tambah Data Anak</h2>
                <a href="{{ route('children.index') }}" class="btn-back">
                    <svg viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
                    Batal / Kembali
                </a>
            </div>

            <form action="{{ route('children.store') }}" method="POST">
                @csrf

                <div class="form-grid">
                    
                    <!-- Nama Anak -->
                    <div class="form-group full-width">
                        <label for="nama_anak">Nama Anak</label>
                        <input type="text"
                               id="nama_anak"
                               name="nama_anak"
                               placeholder="Masukkan nama lengkap anak"
                               required>
                    </div>

                    <!-- Usia Anak -->
                    <div class="form-group">
                        <label for="usia_anak">Usia (Tahun)</label>
                        <input type="number"
                               id="usia_anak"
                               name="usia_anak"
                               placeholder="0"
                               required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin">
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <!-- Kemampuan Bicara -->
                    <div class="form-group full-width">
                        <label for="tingkat_kemampuan_bicara">Tingkat Kemampuan Bicara</label>
                        <input type="text"
                               id="tingkat_kemampuan_bicara"
                               name="tingkat_kemampuan_bicara"
                               placeholder="Contoh: Fasih, Sedang, Terbatas">
                    </div>

                    <!-- Respon Verbal -->
                    <div class="form-group full-width">
                        <label for="respon_verbal">Respon Verbal</label>
                        <textarea name="respon_verbal" 
                                  id="respon_verbal"
                                  placeholder="Jelaskan respon verbal anak..."></textarea>
                    </div>

                    <!-- Riwayat Perkembangan Bahasa -->
                    <div class="form-group full-width">
                        <label for="riwayat_perkembangan_bahasa">Riwayat Perkembangan Bahasa</label>
                        <textarea name="riwayat_perkembangan_bahasa" 
                                  id="riwayat_perkembangan_bahasa"
                                  placeholder="Tuliskan riwayat perkembangan..."></textarea>
                    </div>

                </div> <!-- End Grid -->

                <!-- Tombol Submit -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <svg style="width:20px;height:20px;fill:white;" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                        Simpan Data
                    </button>
                </div>

            </form>
        </div>

    </div>

</body>
</html>