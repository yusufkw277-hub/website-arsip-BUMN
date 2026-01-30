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
                        <span class="value countup" data-number="{{ $jumlah }}">0</span>
                    </div>
                    @php $i++; @endphp
                @endforeach
            </div>

            <div class="total-arsip">
                <small>TOTAL ARSIP</small>
                <strong id="totalArsipNumber">{{ number_format($totalArsip,0,',','.') }}</strong>
            </div>            
        </div>
    </div>

    {{-- ✅ INSIGHT DI BAWAH CHART (bukan di dalam flex row) --}}
    <div class="statistik-insight">
        <div class="insight-item">
            <span class="insight-icon">📈</span>
            <span id="insight-terbanyak"></span>
        </div>

        <div class="insight-item">
            <span class="insight-icon">📉</span>
            <span id="insight-terendah"></span>
        </div>
    </div>
</section>

{{-- ================= PEMISAH SECTION ================= --}}
<div class="section-divider"></div>

{{-- ================= PERATURAN & RETENSI ================= --}}
<section class="retensi-section">
    <h2 class="retensi-title">Peraturan dan Jadwal Retensi</h2>

    <div class="retensi-cards">
        {{-- CARD PERMEN --}}
        <div class="retensi-card">
            <small class="retensi-subtitle">
                Peraturan Menteri Badan Usaha Milik Negara Nomor PER-06/MBU/10/2019
            </small>

            <h3 class="retensi-heading">
                PERUBAHAN ATAS PERATURAN MENTERI BADAN USAHA MILIK NEGARA
                NOMOR PER-04/MBU/03/2018 TENTANG PENYELENGGARAAN ARSIP DINAMIS
                DI LINGKUNGAN KEMENTERIAN BADAN USAHA MILIK NEGARA
            </h3>

            <hr>

            <a href="{{ asset('pdf/permen-bumn.pdf') }}" target="_blank" class="retensi-pdf">
                <img src="{{ asset('images/icon-pdf.png') }}" alt="PDF">
                PER-06-MBU-2019 (penyelenggaraan arsip dinamis)
            </a>
        </div>

        {{-- CARD JRA --}}
        <div class="retensi-card">
            <small class="retensi-subtitle">
                Jadwal Retensi Arsip
            </small>

            <h3 class="retensi-heading">
                PERATURAN KEPALA ARSIP NASIONAL REPUBLIK INDONESIA
                NOMOR 12 TAHUN 2009 TENTANG JADWAL RETENSI ARSIP
            </h3>

            <hr>

            <a href="{{ asset('pdf/jra.pdf') }}" target="_blank" class="retensi-pdf">
                <img src="{{ asset('images/icon-pdf.png') }}" alt="PDF">
                Jadwal retensi arsip JRA
            </a>
        </div>
    </div>
</section>

{{-- ================= FOOTER / PENUTUP ================= --}}
<footer class="footer-in-content">
    <div class="footer-inner">
        <div class="footer-left">
            <img src="{{ asset('images/logo-bumn-garuda.png') }}" class="footer-logo" alt="BUMN">

            <div class="footer-text">
                <div class="footer-title">
                    BADAN PENGATURAN<br>
                    BADAN USAHA MILIK NEGARA
                </div>
                <div class="footer-address">
                    Jl. Medan Merdeka Selatan No.13<br>
                    Jakarta 10110 Indonesia
                </div>
            </div>
        </div>
    </div>

    <!-- 🔥 PINDAH KE SINI -->
    <div class="footer-pattern">
        <img src="{{ asset('images/logo-bumn-pattern.png') }}" alt="pattern">
    </div>
</footer>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const statistikSection = document.querySelector('.statistik-arsip');
    const canvas = document.getElementById('arsipChart');
    if (!statistikSection || !canvas) return;

    // Data dari backend
    const arsipPerTahun = @json($arsipPerTahun);
    const labels = Object.keys(arsipPerTahun);
    const dataValues = Object.values(arsipPerTahun);

    // Lebar chart biar bisa scroll
    const perLabelWidth = 140;
    const minWidth = 900;
    const dynamicWidth = Math.max(minWidth, labels.length * perLabelWidth);
    const container = document.querySelector('.chart-container');
    if (container) container.style.width = dynamicWidth + 'px';

    // =======================
    // INSIGHT (tetap)
    // =======================
    const entries = Object.entries(arsipPerTahun);
    if (entries.length > 0) {
        const max = entries.reduce((a, b) => a[1] > b[1] ? a : b);
        const min = entries.reduce((a, b) => a[1] < b[1] ? a : b);

        const elMax = document.getElementById('insight-terbanyak');
        const elMin = document.getElementById('insight-terendah');

        if (elMax) elMax.innerText = `Arsip terbanyak tercatat pada tahun ${max[0]}`;
        if (elMin) elMin.innerText = `Penurunan arsip terjadi pada tahun ${min[0]}`;
    }

    // =======================
    // COUNT UP (TOTAL)
    // =======================
    function animateCount(el, endValue, duration = 1200) {
        if (!el) return;

        const startValue = 0;
        const startTime = performance.now();

        function step(now) {
            const progress = Math.min((now - startTime) / duration, 1);
            const current = Math.floor(startValue + (endValue - startValue) * progress);
            el.textContent = current.toLocaleString('id-ID');

            if (progress < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    }

    // Ambil total arsip angka asli dari backend (lebih aman)
    const totalArsipValue = {{ (int) $totalArsip }};
    const totalEl = document.getElementById('totalArsipNumber');

    // =======================
    // CHART.JS (dibuat sekali)
    // =======================
    const ctx = canvas.getContext('2d');

    let chartInstance = null;

    function buildChart() {
        if (chartInstance) return; // jangan dobel

        chartInstance = new Chart(ctx, {
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
                interaction: { mode: 'index', intersect: false },
                scales: {
                    x: { ticks: { autoSkip: false } },
                    y: {
                        beginAtZero: true,
                        ticks: { callback: (v) => Number(v).toLocaleString('id-ID') }
                    }
                },
                plugins: {
                    legend: { display: false }
                },
                animation: {
                    duration: 1400,
                    easing: 'easeOutQuart'
                }
            }
        });
    }

    // =======================
    // TRIGGER SAAT MASUK LAYAR
    // =======================
    let hasPlayed = false;

    const observer = new IntersectionObserver((entriesObs) => {
        entriesObs.forEach((entry) => {
            if (entry.isIntersecting && !hasPlayed) {
                hasPlayed = true;

                // 1) count up total
                animateCount(totalEl, totalArsipValue, 1200);

                // animasi angka per tahun kanan
        document.querySelectorAll('.countup').forEach(el => {
        const end = Number(el.dataset.number || 0);
        animateCount(el, end, 1000);
    });

                // 2) build chart (akan animasi dari chart.js)
                buildChart();

                observer.disconnect();
            }
        });
    }, { threshold: 0.35 });

    observer.observe(statistikSection);
});
</script>
@endpush
