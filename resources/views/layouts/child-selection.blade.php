<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TUTURO - @yield('title', 'Pilih Anak')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8FAFC;
            color: #1E293B;
        }

        .app-logo {
            font-size: 2rem;
            font-weight: 800;
            color: #4F46E5;
            text-decoration: none;
        }

        .app-logo span {
            background: linear-gradient(135deg, #4F46E5, #7C3AED);
            -webkit-background-clip: text;
            color: transparent;
        }
    </style>
</head>

<body>

    <div class="container-fluid py-4">

        <!-- Logo -->
        <div class="text-center mb-4">
            <a href="#" class="app-logo">
                <i class="fa-solid fa-shapes"></i>
                <span>TUTURO</span>
            </a>
        </div>

        <!-- Content -->
        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>

</html>