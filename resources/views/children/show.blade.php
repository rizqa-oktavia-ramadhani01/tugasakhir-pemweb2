<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Anak</title>
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
            align-items: flex-start; /* Agar tidak tengah vertikal, tapi dari atas */
        }

        /* 2. Container */
        .container {
            width: 100%;
            max-width: 800px; /* Lebar sedikit lebih besar dari kartu list */
            margin-top: 20px;
        }

        /* 3. Kartu Profil Utama */
        .profile-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        /* Aksen Biru di atas kartu */
        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            z-index: 0;
        }

        /* Tombol Back */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #555;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            padding: 8px 16px;
            background: #e9ecef;
            border-radius: 20px;
            transition: all 0.2s;
            z-index: 2;
            position: relative;
        }

        .btn-back:hover {
            background: #dde2e6;
            color: #000;
        }

        .btn-back svg {
            width: 18px;
            height: 18px;
            fill: currentColor;
        }

        /* Header Profil (Avatar & Nama) */
        .profile-header {
            display: flex;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
            margin-top: 30px; /* Space for the blue header */
        }

        .avatar-lg {
            width: 80px;
            height: 80px;
            background-color: white;
            border: 4px solid white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
            color: #007bff;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .identity h1 {
            font-size: 28px;
            color: #222;
            margin-bottom: 5px;
        }

        .identity .badge-group {
            display: flex;
            gap: 10px;
        }

        .badge {
            font-size: 13px;
            padding: 4px 10px;
            border-radius: 12px;
            background-color: #f1f3f5;
            color: #495057;
            font-weight: 500;
        }

        /* Garis Pembatas */
        .separator {
            height: 1px;
            background-color: #eee;
            margin: 20px 0;
        }

        /* Layout Detail (Grid) */
        .details-grid {
            display: grid;
            grid-template-columns: 1fr; /* Default 1 kolom */
            gap: 20px;
        }

        /* Style Label dan Value */
        .detail-item label {
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #888;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .detail-item .value {
            font-size: 16px;
            color: #333;
            font-weight: 500;
            line-height: 1.5;
        }

        /* Kotak Khusus Riwayat */
        .history-box {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            margin-top: 10px;
        }

        .history-box .value {
            white-space: pre-wrap; /* Agar paragraf tetap turun baris */
            color: #444;
            text-align: justify;
        }

        /* Responsif untuk HP */
        @media (min-width: 600px) {
            .details-grid {
                grid-template-columns: 1fr 1fr; /* 2 Kolom di layar besar */
            }
            /* Riwayat mengambil 2 kolom penuh */
            .full-width {
                grid-column: span 2;
            }
        }
        
        @media (max-width: 600px) {
            .profile-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .identity .badge-group {
                justify-content: center;
            }
            .profile-card {
                padding: 20px;
            }
        }

    </style>
</head>
<body>

    <div class="container">
        
        <!-- Tombol Back (Asumsi route index) -->
        <a href="{{ route('children.index') }}" class="btn-back">
            <svg viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
            Kembali
        </a>

        <!-- Kartu Detail -->
        <div class="profile-card">
            
            <!-- Header Kartu -->
            <div class="profile-header">
                <div class="avatar-lg">
                    <!-- Ambil huruf pertama nama -->
                    {{ substr($child->nama_anak, 0, 1) }}
                </div>
                <div class="identity">
                    <h1>{{ $child->nama_anak }}</h1>
                    <div class="badge-group">
                        <span class="badge">{{ $child->usia_anak }} Tahun</span>
                        <span class="badge">{{ $child->jenis_kelamin }}</span>
                    </div>
                </div>
            </div>

            <div class="separator"></div>

            <!-- Isi Detail -->
            <div class="details-grid">
                
                <!-- Item 1: Kemampuan Bicara -->
                <div class="detail-item">
                    <label>Kemampuan Bicara</label>
                    <div class="value">
                        {{ $child->tingkat_kemampuan_bicara }}
                    </div>
                </div>

                <!-- Item 2: Respon Verbal -->
                <div class="detail-item">
                    <label>Respon Verbal</label>
                    <div class="value">
                        {{ $child->respon_verbal }}
                    </div>
                </div>

                <!-- Item 3: Riwayat (Full Width) -->
                <div class="detail-item full-width">
                    <label>Riwayat Perkembangan Bahasa</label>
                    
                    <div class="history-box">
                        <div class="value">
                            {{ $child->riwayat_perkembangan_bahasa ?? 'Tidak ada data riwayat.' }}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</body>
</html>