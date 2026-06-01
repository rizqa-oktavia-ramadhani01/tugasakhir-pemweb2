<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TUTURO</title>

    <style>
        /* 1. RESET DASAR */
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            height: 100vh; /* Tinggi layar penuh */
            display: flex;
            justify-content: center; /* Posisi tengah horizontal */
            align-items: center;     /* Posisi tengah vertikal */
            font-family: Arial, sans-serif;
            background: #f4fdfb;     /* Warna latar belakang */
        }

        /* 2. STYLE CONTAINER UTAMA */
        .container{
            text-align: center;
            
            /* Menambahkan animasi 'muncul' saat halaman dimuat */
            animation: muncul 1.5s ease-out;
        }

        /* 3. STYLE LOGO */
        .logo{
            width: 120px;
            height: 120px;
            margin: auto;
            border-radius: 50%; /* Membuat kotak jadi bulat */
            background: #48C9B0;
            color: white;
            font-size: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            
            /* Menambahkan bayangan agar terlihat timbul */
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            
            /* Menambahkan animasi 'memantul' yang berulang terus menerus */
            animation: memantul 2s infinite ease-in-out;
        }

        /* 4. STYLE TEKS */
        h1{
            margin-top: 20px;
            color: #2C3E50;
        }

        p{
            margin-top: 10px;
            color: #666;
        }

        .splash-footer {
            margin-top: 3rem;
            font-size: 0.8rem;
            color: #bdc3c7;
        }

        /* 5. STYLE TOMBOL */
        .btn{
            display: inline-block;
            margin-top: 25px;
            padding: 12px 25px;
            background: #48C9B0;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            
            /* Transisi membuat perubahan warna/ukuran jadi halus */
            transition: all 0.3s ease;
        }

        /* Efek saat mouse diarahkan ke tombol */
        .btn:hover{
            background: #38b29b; /* Warna sedikit lebih gelap */
            transform: scale(1.05); /* Tombol jadi sedikit lebih besar */
        }

        /* --- BAGIAN ANIMASI (KEYFRAMES) --- */
        
        /* Animasi muncul dari bawah */
        @keyframes muncul {
            from {
                opacity: 0;       /* Mulai transparan */
                transform: translateY(30px); /* Posisi awal 30px ke bawah */
            }
            to {
                opacity: 1;       /* Menjadi terlihat */
                transform: translateY(0);    /* Kembali ke posisi normal */
            }
        }

        /* Animasi memantul untuk logo */
        @keyframes memantul {
            0% { transform: translateY(0); }
            50% { transform: translateY(-10px); } /* Naik ke atas 10px */
            100% { transform: translateY(0); }    /* Turun ke bawah lagi */
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="logo">
            💬
        </div>

        <h1>TUTURO</h1>

        <p>
            Teman Bimbingan Bicara<br>
            Anak dan Orang Tua
        </p>

        <!-- Saya biarkan route Laravel tetap disini -->
        <a href="/auth" class="btn">
            Mulai Sekarang
        </a>

        <div class="splash-footer">
            © 2026 TUTURO - Teman Bimbingan Bicara Anak dan Orang Tua
        </div>

    </div>

</body>
</html>