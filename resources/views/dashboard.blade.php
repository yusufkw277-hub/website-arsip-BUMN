@extends('layouts.app')

@section('content')
<div class="dashboard-home">

    <!-- HEADER BERANDA -->
    <div class="beranda-header">
        <h2 class="beranda-title">
            <img src="{{ asset('images/icon-home.png') }}" class="icon-home-img" alt="Home">
            <span>Beranda</span>
        </h2>             
    
        <div class="running-text-wrapper">
            <marquee behavior="scroll" direction="left">
                Selamat Datang di Pengelolaan Arsip Inaktif BUMN
            </marquee>
        </div>
    </div>    

    <!-- CAROUSEL -->
    <div id="berandaCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">
        <div class="carousel-inner">

            <div class="carousel-item active">
                <img src="{{ asset('images/carousel1.jpg') }}" class="d-block w-100">
            </div>

            <div class="carousel-item">
                <img src="{{ asset('images/carousel2.jpg') }}" class="d-block w-100">
            </div>

            <div class="carousel-item">
                <img src="{{ asset('images/carousel3.jpg') }}" class="d-block w-100">
            </div>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#berandaCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#berandaCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- SECTION KEARSIPAN DIGITAL -->
<section class="arsip-digital-section">
    <div class="arsip-digital-content">

        <div class="arsip-icon">“</div>

        <h3 class="arsip-digital-title">
            Mengenal Kearsipan Digital
        </h3>

        <p class="arsip-digital-desc">
            Kearsipan bukan sekadar penyimpanan dokumen, melainkan
            pengelolaan rekaman kegiatan atau peristiwa dalam berbagai
            bentuk media sesuai dengan perkembangan teknologi informasi
            dan komunikasi.
        </p>

        <ul class="arsip-digital-list">
            <li>
                <strong>Penyimpanan Aman:</strong>
                Menjamin seluruh dokumen negara dan perusahaan tersimpan
                dalam sistem enkripsi yang kuat.
            </li>
            <li>
                <strong>Temu Balik Cepat:</strong>
                Memudahkan pencarian dokumen penting hanya dalam hitungan
                detik melalui fitur “Pencarian Arsip”.
            </li>
            <li>
                <strong>Preservasi Jangka Panjang:</strong>
                Menjaga keaslian dokumen sejarah BUMN agar tetap dapat
                diakses oleh generasi mendatang.
            </li>
        </ul>

    </div>
</section>

{{-- ================= STATISTIK ARSIP ================= --}}
<section class="statistik-arsip">
    <h2>Statistik Total Jumlah Arsip</h2>

    <div class="statistik-wrapper">
        {{-- CHART --}}
        <div class="chart-scroll">
            <div class="chart-container">
                <canvas id="arsipChart"></canvas>
            </div>
        </div>

        {{-- LIST PER TAHUN --}}
<div class="arsip-list">
    <div class="arsip-list-scroll">
        @php
            $colors = ['#ff4d4f','#1890ff','#faad14','#52c41a','#eb2f96','#722ed1','#13c2c2'];
            $i = 0;
        @endphp

        @foreach($arsipPerTahun as $tahun => $jumlah)
            <div class="arsip-item">
                <span class="dot" style="background: {{ $colors[$i % count($colors)] }}"></span>
                <span class="label">Arsip {{ $tahun }}</span>
                <span class="value">{{ number_format($jumlah,0,',','.') }}</span>
            </div>
            @php $i++; @endphp
        @endforeach
    </div>

    <div class="total-arsip">
        <small>TOTAL ARSIP</small>
        <strong>{{ number_format($totalArsip,0,',','.') }}</strong>
    </div>
</div>        
    </div>
</section>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const canvas = document.getElementById('arsipChart');
    if (!canvas) return;

    const arsipPerTahun = @json($arsipPerTahun);

    const labels = Object.keys(arsipPerTahun);
    const dataValues = Object.values(arsipPerTahun);

    // Lebar chart: makin banyak tahun makin lebar (biar bisa scroll)
    const perLabelWidth = 140;
    const minWidth = 900;
    const dynamicWidth = Math.max(minWidth, labels.length * perLabelWidth);

    const container = document.querySelector('.chart-container');
    if (container) container.style.width = dynamicWidth + 'px';

    const ctx = canvas.getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                data: dataValues,
                borderColor: '#1890ff',
                backgroundColor: 'rgba(24,144,255,0.15)',
                pointRadius: 5,
                pointHoverRadius: 7,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false
            },
            scales: {
                x: {
                    ticks: { autoSkip: false }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: (value) => Number(value).toLocaleString('id-ID')
                    }
                }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });
});
</script>
@endpush
