<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sistem Arsip BUMN</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap dulu -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- bootstrap icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@500&display=swap" rel="stylesheet">

    <!-- CSS buatan kamu TERAKHIR -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('styles')
</head>

<body>

    <div class="wrapper">

        <div class="sidebar">
            <div class="logo">
                <img src="{{ asset('images/logo-bumn.png') }}">
                <span>SISTEM ARSIP BUMN</span>
            </div>

            <ul>
                <li><a href="{{ route('dashboard') }}">Beranda</a></li>
                <li><a href="{{ route('admin') }}">Admin</a></li>
                <li><a href="{{ route('arsip') }}">Pencarian Arsip</a></li>
                <li><a href="{{ route('arsip.data') }}">Data Arsip</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </div>

        <div class="content">
            <div class="header"></div>
            <div class="main">
                @yield('content')
            </div>
        </div>

    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Hapus selectedArsipIds jika bukan di halaman /data-arsip
        if (!window.location.pathname.startsWith('/data-arsip')) {
            localStorage.removeItem('selectedArsipIds');
        }
    </script>

    <!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('scripts')
</body>

</html>
