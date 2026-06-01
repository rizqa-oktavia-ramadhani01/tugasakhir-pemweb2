<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - TUTURO</title>
    
    <!-- Font agar terlihat rapi (Google Fonts) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        /* --- 1. VARIABEL WARNA (Sesuai Request) --- */
        :root {
            --pink-main: #FA6781;   /* Warna Tombol */
            --peach-bg: #FFC49D;    /* Warna Panel Geser */
            --cream-bg: #FAE7CB;    /* Warna Form */
            --text-dark: #444;
            --white: #ffffff;
        }

        /* --- 2. RESET DASAR --- */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f6f5f7;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        h1 {
            font-weight: bold;
            margin: 0;
            color: var(--text-dark);
        }

        p {
            font-size: 14px;
            font-weight: 300;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        span {
            font-size: 12px;
        }

        a {
            color: #333;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        /* --- 3. STYLE TOMBOL --- */
        button {
            border-radius: 20px;
            border: 1px solid var(--pink-main);
            background-color: var(--pink-main);
            color: #ffffff;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
            cursor: pointer;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        /* Tombol di dalam panel (Ghost button) */
        button.ghost {
            background-color: transparent;
            border-color: #ffffff;
        }

        /* --- 4. STYLE FORM --- */
        form {
            background-color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
            border-radius: 5px; /* Sudut agak melengkung */
        }

        /* --- 5. CONTAINER UTAMA --- */
        .container {
            background-color: var(--cream-bg);
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
                        0 10px 10px rgba(0,0,0,0.22);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        /* --- 6. PENEMPATAN FORM --- */
        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        /* Login ada di kiri */
        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        /* Register ada di kanan (awalnya tersembunyi di belakang) */
        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        /* --- 7. ANIMASI PERPINDAHAN (Class Aktif dari JS) --- */
        /* Saat panel aktif, geser form login ke kanan */
        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }

        /* Saat panel aktif, geser form register masuk ke view */
        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {
            0%, 49.99% {
                opacity: 0;
                z-index: 1;
            }
            50%, 100% {
                opacity: 1;
                z-index: 5;
            }
        }

        /* --- 8. PANEL OVERLAY (Bagian Berwarna) --- */
        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: var(--peach-bg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #ffffff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        /* Responsif untuk HP (Tumpuk vertikal) */
        @media (max-width: 768px) {
            .container {
                width: 100%;
                min-height: 600px;
                border-radius: 0;
            }
            /* Sederhanakan untuk mobile: Overlay disembunyikan, kita pakai toggle biasa */
            /* (Untuk kode pemula, kita biarkan sliding bekerja, tapi mungkin agak kecil di HP) */
        }
    </style>
</head>
<body>

    <div class="container" id="container">
        
        <!-- --- BAGIAN REGISTER (Kanan) --- -->
        <div class="form-container sign-up-container">
            <form method="POST" action="/register">
                @csrf
                <h1>Buat Akun</h1>
                <p>Silakan daftar untuk orang tua</p>
                
                <input type="text" name="name" placeholder="Nama Lengkap" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                
                <button type="submit">Register</button>
            </form>
        </div>

        <!-- --- BAGIAN LOGIN (Kiri) --- -->
        <div class="form-container sign-in-container">
            <form method="POST" action="/login">
                @csrf
                <h1>Masuk</h1>
                <p>Selamat datang kembali di TUTURO</p>
                
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>

                <button type="submit">Login</button>
            </form>
        </div>

        <!-- --- BAGIAN OVERLAY (PANEL GESEWARNA) --- -->
        <div class="overlay-container">
            <div class="overlay">
                
                <!-- Panel Kiri Overlay (Muncul saat Register aktif) -->
                <div class="overlay-panel overlay-left">
                    <h1>Sudah Punya Akun?</h1>
                    <p>Untuk tetap terhubung dengan kami, silakan login dengan info pribadi Anda</p>
                    <button class="ghost" id="signIn">Kembali ke Login</button>
                </div>
                
                <!-- Panel Kanan Overlay (Muncul saat Login aktif - Default) -->
                <div class="overlay-panel overlay-right">
                    <h1>Halo, Teman TUTURO!</h1>
                    <p>Masukkan detail pribadi Anda dan mulailah perjalanan bersama kami</p>
                    <button class="ghost" id="signUp">Daftar Sekarang</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Script Sederhana untuk Animasi -->
    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        // Ketika tombol "Daftar" diklik, tambahkan class "right-panel-active"
        // Ini memicu CSS untuk menggeser panel
        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        // Ketika tombol "Kembali ke Login" diklik, hapus class tersebut
        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>

</body>
</html>