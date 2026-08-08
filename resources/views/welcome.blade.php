<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Warga RT 03 RW 13 Cemani</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #ffffff;
            --secondary-color: #ffc107;
            --text-color: #333;
            --background-light: #f8f9fa;
            --background-dark: #ffffff;
            --mobile-breakpoint: 768px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--background-light);
        }

        /* --- PENGATURAN HEADER SIMETRIS --- */
        .header {
            background: #fff;
            border-bottom: 1px solid #ddd;
            padding: 10px 0; 
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative; 
            width: 100%;
            max-width: 1280px; 
            margin: 0 auto; 
            padding: 0 20px;
        }

        .header-logo {
            height: 50px;
            width: 60px;
            object-fit: contain; 
        }

        .header-title {
            font-size: 1.6rem;
            font-weight: bold;
            text-align: center;
            margin: 0;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: max-content; 
        }

        /* --- PENGATURAN NAVBAR --- */
        .nav {
            background: #004d40;
            display: block;
            text-align: center;
            padding: 0;
            align-items: center;
            align-content: center;
        }

        .nav-menu {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .nav-item {
            color: #fff;
            text-decoration: none;
            padding: 12px 18px;
            font-weight: 500;
            transition: background 0.3s;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .login {
            color: #fff;
            text-decoration: none;
            padding: 12px 18px;
            font-weight: 500;
            transition: background 0.3s;
        }

        .login:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* --- PENGATURAN MODE HP (MOBILE) --- */
        .nav-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #fff;
            padding: 10px;
            cursor: pointer;
        }

        /* Footer */
        .footer {
            background: #004d40;
            color: #fff;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
        }

        @media (max-width: 768px) {
            .logo-kanan {
                display: none; 
            }
            
            .header .container {
                justify-content: flex-start;
                gap: 15px; 
            }

            .header-logo.logo-kiri {
                height: 40px; 
                width: 45px;
            }

            .header-title {
                text-align: left;
                font-size: 1.1rem; 
                white-space: nowrap; 
                position: static;
                transform: none;
            }

            .nav-menu {
                display: none;
                flex-direction: column;
                background: #004d40;
                width: 100%;
            }

            .nav-menu.show {
                display: flex;
            }

            .nav-toggle {
                display: block;
                margin-left: auto;
            }
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <header class="header sticky top-0 z-50">
        <div class="container">
            <img src="{{ asset('logos/logo-skh.jpg') }}" alt="Logo Desa" class="header-logo logo-kiri">
            <h1 class="header-title text-[#004D40]">Desa Cemani RT 03 RW 13</h1>
            <img src="{{ asset('logos/logo-kt.jpg') }}" alt="Logo Karang Taruna" class="header-logo logo-kanan">
        </div>
    </header>

    <nav class="nav shadow-md">
        <button class="nav-toggle" id="navToggle">
            <i class="fas fa-bars"></i>
        </button>
        <div class="nav-menu" id="navMenu">
            <a href="#beranda" class="nav-item">Beranda</a>
            <a href="#informasi" class="nav-item">Informasi</a>
            <a href="#agenda" class="nav-item">Agenda</a>
            <a href="#galeri" class="nav-item">Galeri</a>
            <a href="/karang-taruna" class="nav-item text-yellow-300 font-bold">Karang Taruna</a>
            
            <!-- PERBAIKAN TOMBOL LOGIN: Menghapus class nav-item agar hover-nya normal -->
            @auth
                <a href="{{ url('/dashboard') }}" class="login">Panel Admin</a>
            @else
                <a href="{{ route('login') }}" class="login">Login</a>
            @endauth
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-8" id="beranda">
        
        <!-- PENGUMUMAN LELAYU -->
        @php
            // Mencari berita Lelayu terbaru, dan memfilter agar HANYA muncul
            // jika berita tersebut dibuat dalam 2 hari (48 jam) terakhir.
            $lelayu = isset($berita) ? $berita->where('kategori', 'Lelayu')
                                              ->where('created_at', '>=', now()->subDays(2))
                                              ->first() : null;
        @endphp
        
        @if($lelayu)
        <div class="bg-red-600 text-white p-4 rounded-xl shadow-lg mb-8 flex flex-col md:flex-row items-center justify-between animate-pulse border-2 border-red-800">
            <div class="flex items-center gap-4 mb-3 md:mb-0">
                <span class="text-4xl">🚨</span>
                <div>
                    <h3 class="font-extrabold text-lg md:text-xl">KABAR DUKA (LELAYU)</h3>
                    <p class="text-sm md:text-base font-medium">{{ $lelayu->judul }}</p>
                </div>
            </div>
            <a href="#informasi" class="bg-white text-red-700 font-extrabold px-6 py-2 rounded-lg text-sm hover:bg-gray-100 shadow">Baca Selengkapnya</a>
        </div> 
        @endif

        <!-- BANNER SAMBUTAN -->
        <section class="mb-14 rounded-2xl overflow-hidden relative shadow-lg bg-[#004D40]">
            <img src="{{ asset('logos/banner.png') }}" alt="Lingkungan RT 03" class="w-full h-48 md:h-72 object-cover opacity-50">
            <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-6 text-center">
            </div>
        </section>

        <!-- KABAR & PENGUMUMAN -->
        <section id="informasi" class="mb-14">
            <div class="flex items-center justify-between mb-6 border-b-2 border-gray-200 pb-2">
                <div class="flex items-center">
                    <span class="text-3xl mr-3">📢</span>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-[#004D40]">Kabar & Pengumuman</h2>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @if(isset($berita))
                    @forelse ($berita as $item)
                        <div class="bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
                            <div class="p-6 md:p-8">
                                @if($item->kategori == 'Lelayu')
                                    <span class="inline-block bg-red-100 text-red-700 text-sm md:text-base px-3 py-1 rounded-md font-bold mb-3">🔴 LELAYU</span>
                                @elseif($item->kategori == 'Pengumuman')
                                    <span class="inline-block bg-yellow-100 text-yellow-700 text-sm md:text-base px-3 py-1 rounded-md font-bold mb-3">⚠️ PENGUMUMAN</span>
                                @else
                                    <span class="inline-block bg-blue-100 text-blue-700 text-sm md:text-base px-3 py-1 rounded-md font-bold mb-3">📰 BERITA</span>
                                @endif
                                
                                <h3 class="font-bold text-xl text-gray-900 mb-2 leading-tight">{{ $item->judul }}</h3>
                                <p class="text-sm text-gray-500 mb-4 font-medium"><i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}</p>
                                <p class="text-gray-700 text-base line-clamp-3 leading-relaxed">{{ $item->konten }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-lg text-gray-500 font-medium bg-gray-100 p-6 rounded-lg text-center w-full col-span-full">Belum ada pengumuman saat ini.</p>
                    @endforelse
                @endif
            </div>
        </section>

        <!-- JADWAL KEGIATAN -->
        <section id="agenda" class="mb-14">
            <div class="flex items-center mb-6 border-b-2 border-gray-200 pb-2">
                <span class="text-3xl mr-3">🗓️</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-[#004D40]">Jadwal Kegiatan Terdekat</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if(isset($kegiatan))
                    @forelse ($kegiatan as $agenda)
                        <div class="bg-white rounded-xl shadow border-l-8 border-yellow-400 p-6">
                            <h3 class="font-bold text-xl text-[#004D40] mb-3">{{ $agenda->nama_kegiatan }}</h3>
                            <div class="text-base text-gray-700 space-y-2">
                                <p class="flex items-start"><i class="fas fa-clock mt-1 mr-2 text-gray-400"></i> {{ \Carbon\Carbon::parse($agenda->waktu_pelaksanaan)->translatedFormat('d F Y - H:i') }} WIB</p>
                                <p class="flex items-start"><i class="fas fa-map-marker-alt mt-1 mr-2 text-gray-400"></i> {{ $agenda->lokasi }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-lg text-gray-500 font-medium bg-gray-100 p-6 rounded-lg text-center w-full col-span-full">Tidak ada kegiatan dalam waktu dekat.</p>
                    @endforelse
                @endif
            </div>
        </section>

        <!-- CUPLIKAN KARANG TARUNA -->
        <section class="mb-14 bg-gradient-to-r from-[#004D40] to-green-700 rounded-2xl p-6 md:p-10 text-white shadow-xl flex flex-col md:flex-row items-center justify-between border-4 border-yellow-400">
            <div class="flex flex-col md:flex-row items-center text-center md:text-left gap-6 mb-6 md:mb-0">
                <img src="{{ asset('logos/logo-kt.jpg') }}" alt="Karang Taruna" class="h-24 w-24 md:h-28 md:w-28 bg-white rounded-full p-1 object-contain shadow-md">
                <div>
                    <h2 class="text-2xl md:text-3xl font-extrabold mb-2 text-yellow-300">Karang Taruna RT 03</h2>
                    <p class="text-gray-100 text-sm md:text-lg max-w-2xl">Mari dukung kreativitas, olahraga, dan program-program inovatif pemuda-pemudi untuk lingkungan RT 03 yang lebih maju dan produktif.</p>
                </div>
            </div>
            <a href="/karang-taruna" class="bg-yellow-400 text-[#004D40] font-extrabold text-lg px-8 py-4 rounded-xl hover:bg-yellow-300 shadow-md transition transform hover:scale-105 whitespace-nowrap">
                Lihat Program Kerja <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </section>

        <!-- LAYANAN AKSES CEPAT (Dipindah ke Bawah) -->
        <section class="mb-14">
            <h2 class="text-xl md:text-2xl font-extrabold text-center text-[#004D40] mb-6">Layanan Akses Cepat Warga</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="#" class="bg-white border border-gray-200 rounded-2xl p-5 text-center hover:bg-[#004D40] hover:text-white transition-all group shadow-sm">
                    <div class="bg-blue-50 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-3 group-hover:bg-white group-hover:bg-opacity-20">
                        <i class="fas fa-envelope-open-text text-2xl text-[#004D40] group-hover:text-white"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-white text-sm md:text-base">Surat Pengantar</h3>
                </a>
                
                <a href="#" class="bg-white border border-gray-200 rounded-2xl p-5 text-center hover:bg-[#004D40] hover:text-white transition-all group shadow-sm">
                    <div class="bg-red-50 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-3 group-hover:bg-white group-hover:bg-opacity-20">
                        <i class="fas fa-shield-alt text-2xl text-red-600 group-hover:text-white"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-white text-sm md:text-base">Lapor Keamanan</h3>
                </a>
                
                <a href="#" class="bg-white border border-gray-200 rounded-2xl p-5 text-center hover:bg-[#004D40] hover:text-white transition-all group shadow-sm">
                    <div class="bg-green-50 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-3 group-hover:bg-white group-hover:bg-opacity-20">
                        <i class="fas fa-wallet text-2xl text-green-600 group-hover:text-white"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-white text-sm md:text-base">Laporan Kas RT</h3>
                </a>
                
                <a href="#kontak" class="bg-white border border-gray-200 rounded-2xl p-5 text-center hover:bg-[#004D40] hover:text-white transition-all group shadow-sm">
                    <div class="bg-yellow-50 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-3 group-hover:bg-white group-hover:bg-opacity-20">
                        <i class="fas fa-phone-alt text-2xl text-yellow-600 group-hover:text-white"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-white text-sm md:text-base">Kontak Darurat</h3>
                </a>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="footer">
        <p class="font-bold">&copy; {{ date('Y') }} Karang Taruna RT 03 RW 13 Cemani. All rights reserved.</p>
    </footer>

    <script>
        const navToggle = document.getElementById("navToggle");
        const navMenu = document.getElementById("navMenu");

        navToggle.addEventListener("click", () => {
            navMenu.classList.toggle("show");
        });
    </script>
</body>
</html>