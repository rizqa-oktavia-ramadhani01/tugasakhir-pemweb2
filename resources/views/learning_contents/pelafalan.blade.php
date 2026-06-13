@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        .area-tantangan {
            font-family: 'Nunito', sans-serif;
        }
        .opsi-kartu {
            transition: all 0.2s ease-in-out;
        }
        .opsi-kartu:hover {
            transform: translateY(-4px);
        }
    </style>

    <div class="area-tantangan text-gray-800 antialiased space-y-5 p-2">
<body class="text-gray-800 antialiased h-screen flex overflow-hidden">

    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between hidden md:flex z-10 p-4 shrink-0">
        <div>
            <div class="py-4 px-2 mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#00A878] rounded-xl flex items-center justify-center text-white font-black text-xl shadow-md shadow-emerald-100">
                        T
                    </div>
                    <div>
                        <h2 class="font-black text-xl text-[#00664F] tracking-wide leading-none">TUTURO</h2>
                        <span class="text-[10px] font-bold text-slate-400 tracking-widest uppercase">Teman Tumbuh</span>
                    </div>
                </div>
            </div>

            <nav class="space-y-1 opacity-40 pointer-events-none mb-6 px-2">
                <div class="flex items-center gap-3 px-3 py-2 text-slate-500 font-bold text-sm">
                    <i class="fa-solid fa-wand-magic-sparkles w-5"></i> Rekomendasi Pintar
                </div>
                <div class="flex items-center gap-3 px-3 py-2 text-slate-500 font-bold text-sm">
                    <i class="fa-regular fa-calendar-check w-5"></i> Jurnal Harian Ortu
                </div>
                <div class="flex items-center gap-3 px-3 py-2 text-slate-500 font-bold text-sm">
                    <i class="fa-solid fa-chart-simple w-5"></i> Pantau Progres
                </div>
                <div class="flex items-center gap-3 px-3 py-2 text-slate-500 font-bold text-sm">
                    <i class="fa-solid fa-book-open w-5"></i> Pusat Edukasi
                </div>
            </nav>

            <hr class="border-slate-100 my-4">

            <div class="px-2">
                <div class="flex items-center justify-between mb-3 px-3">
                    <span class="text-[11px] font-extrabold text-slate-400 tracking-wider">AREA ANAK (1-5 TAHUN)</span>
                    <span class="bg-orange-100 text-orange-600 text-[10px] font-black px-2 py-0.5 rounded-full">Bermain</span>
                </div>

                <div class="space-y-1.5">
                    <a href="{{ route('learning-contents.pelafalan') }}" class="flex items-center gap-3 px-4 py-3 bg-orange-50 text-orange-600 rounded-2xl transition-all">
                        <i class="fa-solid fa-volume-high text-base"></i>
                        <span class="font-black text-sm tracking-wide">Latih Pelafalan</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-slate-50 rounded-2xl transition-all opacity-60">
                        <i class="fa-solid fa-trophy text-base text-amber-500"></i>
                        <span class="font-bold text-sm tracking-wide text-slate-700">Tantangan Bahasa</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="p-2 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-orange-100 border border-orange-200 flex items-center justify-center text-orange-600 font-black text-lg">
                    {{ $child ? strtoupper(substr($child->nama_anak, 0, 1)) : 'O' }}
                </div>
                <h1 class="text-xs font-black text-slate-700 leading-tight">
                    {{ $child ? $child->nama_anak : 'Orang Tua' }}
                </h1>
            </div>
            <span class="h-2.5 w-2.5 bg-emerald-400 rounded-full animate-pulse mr-1"></span>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <header class="h-16 bg-white border-b border-gray-100 flex items-center justify-between px-6 shrink-0">
            <div class="flex items-center gap-1">
                <h1 class="text-base font-black text-slate-800 tracking-wide">
                    Halo, Bapak & Ibu {{ $child ? $child->nama_anak : 'Orang Tua' }}!
                </h1>
                <span class="text-xl">👋</span>
                <span class="text-xs text-slate-400 font-bold ml-2">
                    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, j F Y') }}
                </span>
            </div>
            <a href="{{ route('activities.index') }}" class="bg-[#00A878] hover:bg-[#008F64] text-white text-xs font-black px-4 py-2.5 rounded-xl transition-all inline-flex items-center justify-center">
                Mulai Stimulasi harian
            </a>
        </header>

        <main class="flex-1 overflow-y-auto p-6 space-y-4">
            
            <div class="bg-[#FFFDF0] border border-[#FFF1C5] rounded-2xl p-5 flex justify-between items-center shadow-sm">
                <div class="space-y-1">
                    <div class="inline-flex items-center bg-[#FFF8D6] text-[#A07800] font-extrabold text-[10px] px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                        ✨ Area Anak Mandiri (Bermain)
                    </div>
                    <h2 class="text-2xl font-black text-slate-800 tracking-tight">Pelafalan Kata & Suku Kata Ceria</h2>
                    <p class="text-xs font-bold text-orange-600/90">Sentuh gambar, dengarkan suara cara mengejanya!</p>
                </div>
            </div>

            <!-- Tab Kategori Menu Pembelajaran -->
            <div class="tab-kategori flex items-center gap-2 overflow-x-auto bg-white border border-slate-200/60 rounded-xl p-1.5 shadow-sm">
                @php
                    // Array key di bawah ini disamakan dengan teks yang bakal kamu ketik di kolom Deskripsi admin
                    $categories = [
                        'HEWAN' => '🐱 HEWAN',
                        'ALPHABET' => '🔤 ALPHABET',
                        'ANGKA' => '🔢 ANGKA',
                        'KELUARGA' => '👨‍👩‍👧‍👦 KELUARGA'
                    ];
                    $first = true;
                @endphp
                @foreach($categories as $key => $label)
                    <button onclick="filterKategori('{{ $key }}', this)" 
                        class="btn-kategori whitespace-nowrap px-4 py-2 rounded-xl text-xs font-black tracking-wide uppercase transition-all
                        {{ $first ? 'bg-orange-500 text-white shadow-sm shadow-orange-100' : 'text-slate-400 hover:bg-slate-50' }}">
                        {{ $label }}
                    </button>
                    @php $first = false; @endphp
                @endforeach
            </div>
                
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-start">
                
                <div class="lg:col-span-4 bg-white border border-slate-100 rounded-2xl p-4 shadow-sm space-y-2 max-h-[480px] overflow-y-auto">
                    <span class="text-[10px] font-black text-slate-400 tracking-widest block uppercase mb-1">Daftar Istilah</span>
                    
                    <div id="wrapper-list-item" class="space-y-2">
                        @foreach($contents as $index => $item)
                            <div data-deskripsi-kategori="{{ strtoupper(trim($item->deskripsi)) }}" 
                                 onclick="pilihItem(this)"
                                 data-judul="{{ $item->judul }}"
                                 data-isi="{{ $item->isi }}"
                                 data-deskripsi="{{ $item->deskripsi }}"
                                 data-gambar="{{ $item->gambar ? asset('storage/' . $item->gambar) : '' }}"
                                 data-audio="{{ $item->audio ? asset('storage/' . $item->audio) : '' }}"
                                 class="item-pelafalan flex items-center justify-between p-3 rounded-2xl border transition-all cursor-pointer border-slate-100 hover:bg-slate-50/50">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center border border-slate-100 overflow-hidden shrink-0">
                                        @if($item->gambar)
                                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-xl">🎈</span>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="font-black text-slate-800 text-sm tracking-wide leading-tight">{{ $item->judul }}</h3>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wide mt-0.5">{{ strtoupper($item->judul) }}</p>
                                    </div>
                                </div>
                                <span class="text-slate-400 text-xs p-1.5"><i class="fa-solid fa-volume-high"></i></span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="lg:col-span-8 space-y-4">
                    <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col items-center text-center">
                        <div class="w-32 h-32 flex items-center justify-center mb-3">
                            <img id="detail-gambar" src="" alt="Gambar" class="w-full h-full object-contain" style="display: none;">
                            <div id="detail-fallback-icon" class="text-4xl">🎈</div>
                        </div>
                        
                        <h2 id="detail-judul" class="text-3xl font-black text-slate-800 tracking-wide">-</h2>
                        
                        <div class="flex items-center gap-1.5 mt-2">
                            <span id="detail-suku-kata" class="bg-orange-50 border border-orange-100 text-orange-600 px-2.5 py-0.5 rounded-lg text-xs font-black tracking-wider">
                                -
                            </span>
                            <span id="detail-sub-judul" class="text-xs font-bold text-slate-400 uppercase tracking-wide">
                                
                            </span>
                        </div>
                        
                        <p id="detail-instruksi-bawah" class="text-xs font-bold italic text-slate-500 mt-4">
                            "Yuk, tirukan suara kartu kata ini bersama-sama!"
                        </p>

                        <audio id="audioPlayer" src=""></audio>
                    </div>

                    <div class="w-full">
                        <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-sm flex flex-col justify-between">
                            <div class="space-y-1 mb-4">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">LANGKAH BELAJAR</span>
                                <h4 class="font-black text-sm text-slate-800">Dengarkan Kakak Mengeja</h4>
                                <p class="text-[11px] font-bold text-slate-400 leading-relaxed">Artikulasikan bunyi letup kata di pangkal tenggorokan yang bersih.</p>
                            </div>
                            <button onclick="putarAudio()" class="w-full bg-[#4F46E5] hover:bg-indigo-700 text-white font-black py-3 px-4 rounded-xl flex items-center justify-center gap-2 shadow-sm transition-all text-xs tracking-wider">
                                <i class="fa-solid fa-volume-high"></i> Bunyikan Suara
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        function putarAudio() {
            const player = document.getElementById('audioPlayer');
            if(player && player.getAttribute('src') && player.getAttribute('src') !== '') {
                player.play();
            } else {
                alert('Audio pengucapan belum tersedia!');
            }
        }

        function pilihItem(element) {
            document.querySelectorAll('.item-pelafalan').forEach(item => {
                item.classList.remove('border-orange-400', 'bg-orange-50/10', 'active-card');
                item.classList.add('border-slate-100');
            });

            element.classList.remove('border-slate-100');
            element.classList.add('border-orange-400', 'bg-orange-50/10', 'active-card');

            const judul = element.getAttribute('data-judul');
            const isi = element.getAttribute('data-isi');
            const gambar = element.getAttribute('data-gambar');
            const audio = element.getAttribute('data-audio');

            document.getElementById('detail-judul').innerText = judul;
            document.getElementById('detail-sub-judul').innerText = `(${judul.toUpperCase()})`;
            document.getElementById('detail-suku-kata').innerText = isi;
            
            const imgEl = document.getElementById('detail-gambar');
            const fallbackEl = document.getElementById('detail-fallback-icon');
            if(gambar && gambar !== '') {
                imgEl.src = gambar;
                imgEl.style.display = 'block';
                fallbackEl.style.display = 'none';
            } else {
                imgEl.style.display = 'none';
                fallbackEl.style.display = 'block';
            }

            const audioEl = document.getElementById('audioPlayer');
            if(audio && audio !== '') {
                audioEl.src = audio;
            } else {
                audioEl.removeAttribute('src');
            }
        }

        function filterKategori(kategoriKey, buttonElement) {
            document.querySelectorAll('.btn-kategori').forEach(btn => {
                btn.classList.remove('bg-orange-500', 'text-white', 'shadow-sm', 'shadow-orange-100');
                btn.classList.add('text-slate-400', 'hover:bg-slate-50');
            });
            buttonElement.classList.remove('text-slate-400', 'hover:bg-slate-50');
            buttonElement.classList.add('bg-orange-500', 'text-white', 'shadow-sm', 'shadow-orange-100');

            const items = document.querySelectorAll('.item-pelafalan');
            let itemPertama = null;

            items.forEach(item => {
                // Sekarang filter murni mencocokkan apa isi kolom deskripsi kamu dari DB
                let teksDeskripsi = item.getAttribute('data-deskripsi-kategori');

                if (teksDeskripsi === kategoriKey) {
                    item.style.display = 'flex';
                    if (!itemPertama) itemPertama = item;
                } else {
                    item.style.display = 'none';
                }
            });

            if (itemPertama) {
                pilihItem(itemPertama);
            } else {
                document.getElementById('detail-judul').innerText = '-';
                document.getElementById('detail-sub-judul').innerText = '';
                document.getElementById('detail-suku-kata').innerText = '-';
                document.getElementById('detail-gambar').style.display = 'none';
                document.getElementById('detail-fallback-icon').style.display = 'block';
                document.getElementById('audioPlayer').removeAttribute('src');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const tombolAwal = document.querySelector('.btn-kategori');
            if (tombolAwal) {
                filterKategori('HEWAN', tombolAwal);
            }
        });@extends('layouts.app')

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        .area-pelafalan {
            font-family: 'Nunito', sans-serif;
        }
        .item-pelafalan {
            transition: all 0.2s ease-in-out;
        }
        .item-pelafalan:hover {
            transform: translateY(-2px);
        }
    </style>

    <div class="area-pelafalan text-gray-800 antialiased space-y-5 p-2">
        
        <div class="bg-[#FFFDF0] border border-[#FFF1C5] rounded-2xl p-5 flex justify-between items-center shadow-sm">
            <div class="space-y-1">
                <div class="inline-flex items-center bg-[#FFF8D6] text-[#A07800] font-extrabold text-[10px] px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                    ✨ Area Anak Mandiri (Bermain)
                </div>
                <h2 class="text-2xl font-black text-slate-800 tracking-tight">Pelafalan Kata & Suku Kata Ceria</h2>
                <p class="text-xs font-bold text-orange-600/90">Sentuh gambar, dengarkan suara cara mengejanya!</p>
            </div>
        </div>

        <div class="tab-kategori flex items-center gap-2 overflow-x-auto bg-white border border-slate-200/60 rounded-xl p-1.5 shadow-sm">
            @php
                $categories = [
                    'HEWAN' => '🐱 HEWAN',
                    'ALPHABET' => '🔤 ALPHABET',
                    'ANGKA' => '🔢 ANGKA',
                    'KELUARGA' => '👨‍👩‍👧‍👦 KELUARGA'
                ];
                $first = true;
            @endphp
            @foreach($categories as $key => $label)
                <button onclick="filterKategori('{{ $key }}', this)" 
                    class="btn-kategori whitespace-nowrap px-4 py-2 rounded-xl text-xs font-black tracking-wide uppercase transition-all
                    {{ $first ? 'bg-orange-500 text-white shadow-sm shadow-orange-100' : 'text-slate-400 hover:bg-slate-50' }}">
                    {{ $label }}
                </button>
                @php $first = false; @endphp
            @endforeach
        </div>
            
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-start">
            
            <div class="lg:col-span-4 bg-white border border-slate-100 rounded-2xl p-4 shadow-sm space-y-2 max-h-[480px] overflow-y-auto">
                <span class="text-[10px] font-black text-slate-400 tracking-widest block uppercase mb-1">Daftar Istilah</span>
                
                <div id="wrapper-list-item" class="space-y-2">
                    @foreach($contents as $item)
                        <div data-deskripsi-kategori="{{ strtoupper(trim($item->deskripsi)) }}" 
                             onclick="pilihItem(this)"
                             data-judul="{{ $item->judul }}"
                             data-isi="{{ $item->isi }}"
                             data-deskripsi="{{ $item->deskripsi }}"
                             data-gambar="{{ $item->gambar ? asset('storage/' . $item->gambar) : '' }}"
                             data-audio="{{ $item->audio ? asset('storage/' . $item->audio) : '' }}"
                             class="item-pelafalan flex items-center justify-between p-3 rounded-2xl border transition-all cursor-pointer border-slate-100 hover:bg-slate-50/50">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center border border-slate-100 overflow-hidden shrink-0">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-xl">🎈</span>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-black text-slate-800 text-sm tracking-wide leading-tight">{{ $item->judul }}</h3>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wide mt-0.5">{{ strtoupper($item->judul) }}</p>
                                </div>
                            </div>
                            <span class="text-slate-400 text-xs p-1.5"><i class="fa-solid fa-volume-high"></i></span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-8 space-y-4">
                <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col items-center text-center">
                    <div class="w-32 h-32 flex items-center justify-center mb-3">
                        <img id="detail-gambar" src="" alt="Gambar" class="w-full h-full object-contain" style="display: none;">
                        <div id="detail-fallback-icon" class="text-4xl">🎈</div>
                    </div>
                    
                    <h2 id="detail-judul" class="text-3xl font-black text-slate-800 tracking-wide">-</h2>
                    
                    <div class="flex items-center gap-1.5 mt-2">
                        <span id="detail-suku-kata" class="bg-orange-50 border border-orange-100 text-orange-600 px-2.5 py-0.5 rounded-lg text-xs font-black tracking-wider">
                            -
                        </span>
                        <span id="detail-sub-judul" class="text-xs font-bold text-slate-400 uppercase tracking-wide"></span>
                    </div>
                    
                    <p id="detail-instruksi-bawah" class="text-xs font-bold italic text-slate-500 mt-4">
                        "Yuk, tirukan suara kartu kata ini bersama-sama!"
                    </p>

                    <audio id="audioPlayer" src=""></audio>
                </div>

                <div class="w-full">
                    <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-sm flex flex-col justify-between">
                        <div class="space-y-1 mb-4">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">LANGKAH BELAJAR</span>
                            <h4 class="font-black text-sm text-slate-800">Dengarkan Kakak Mengeja</h4>
                            <p class="text-[11px] font-bold text-slate-400 leading-relaxed">Artikulasikan bunyi letup kata di pangkal tenggorokan yang bersih.</p>
                        </div>
                        <button onclick="putarAudio()" class="w-full bg-[#4F46E5] hover:bg-indigo-700 text-white font-black py-3 px-4 rounded-xl flex items-center justify-center gap-2 shadow-sm transition-all text-xs tracking-wider">
                            <i class="fa-solid fa-volume-high"></i> Bunyikan Suara
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function putarAudio() {
            const player = document.getElementById('audioPlayer');
            if(player && player.getAttribute('src') && player.getAttribute('src') !== '') {
                player.play();
            } else {
                alert('Audio pengucapan belum tersedia!');
            }
        }

        function pilihItem(element) {
            document.querySelectorAll('.item-pelafalan').forEach(item => {
                item.classList.remove('border-orange-400', 'bg-orange-50/10', 'active-card');
                item.classList.add('border-slate-100');
            });

            element.classList.remove('border-slate-100');
            element.classList.add('border-orange-400', 'bg-orange-50/10', 'active-card');

            const judul = element.getAttribute('data-judul');
            const isi = element.getAttribute('data-isi');
            const gambar = element.getAttribute('data-gambar');
            const audio = element.getAttribute('data-audio');

            document.getElementById('detail-judul').innerText = judul;
            document.getElementById('detail-sub-judul').innerText = `(${judul.toUpperCase()})`;
            document.getElementById('detail-suku-kata').innerText = isi;
            
            const imgEl = document.getElementById('detail-gambar');
            const fallbackEl = document.getElementById('detail-fallback-icon');
            if(gambar && gambar !== '') {
                imgEl.src = gambar;
                imgEl.style.display = 'block';
                fallbackEl.style.display = 'none';
            } else {
                imgEl.style.display = 'none';
                fallbackEl.style.display = 'block';
            }

            const audioEl = document.getElementById('audioPlayer');
            if(audio && audio !== '') {
                audioEl.src = audio;
            } else {
                audioEl.removeAttribute('src');
            }
        }

        function filterKategori(kategoriKey, buttonElement) {
            document.querySelectorAll('.btn-kategori').forEach(btn => {
                btn.classList.remove('bg-orange-500', 'text-white', 'shadow-sm', 'shadow-orange-100');
                btn.classList.add('text-slate-400', 'hover:bg-slate-50');
            });
            buttonElement.classList.remove('text-slate-400', 'hover:bg-slate-50');
            buttonElement.classList.add('bg-orange-500', 'text-white', 'shadow-sm', 'shadow-orange-100');

            const items = document.querySelectorAll('.item-pelafalan');
            let itemPertama = null;

            items.forEach(item => {
                let teksDeskripsi = item.getAttribute('data-deskripsi-kategori');

                if (teksDeskripsi === kategoriKey) {
                    item.style.display = 'flex';
                    if (!itemPertama) itemPertama = item;
                } else {
                    item.style.display = 'none';
                }
            });

            if (itemPertama) {
                pilihItem(itemPertama);
            } else {
                document.getElementById('detail-judul').innerText = '-';
                document.getElementById('detail-sub-judul').innerText = '';
                document.getElementById('detail-suku-kata').innerText = '-';
                document.getElementById('detail-gambar').style.display = 'none';
                document.getElementById('detail-fallback-icon').style.display = 'block';
                document.getElementById('audioPlayer').removeAttribute('src');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const tombolAwal = document.querySelector('.btn-kategori');
            if (tombolAwal) {
                filterKategori('HEWAN', tombolAwal);
            }
        });
    </script>
@endsection
    </script>
</body>
</html>