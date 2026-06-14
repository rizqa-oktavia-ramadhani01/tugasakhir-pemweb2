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
        
        <div class="bg-[#E8FAF2] border border-[#BFF3DD] rounded-2xl p-5 flex justify-between items-center shadow-sm">
            <div class="space-y-1">
                <div class="inline-flex items-center bg-[#D1F7E7] text-[#007A5E] font-extrabold text-[10px] px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                    🏆 Kuis Kognitif Seru
                </div>
                <h2 class="text-2xl font-black text-slate-800 tracking-tight">Tantangan Kecerdasan Bahasa Anak</h2>
                <p class="text-xs font-bold text-[#008F64]/90">Jawab kuis bergambar interaktif di bawah demi menstimulasi ketajaman asimilasi kosa kata pendengaran.</p>
            </div>
        </div>

        <!-- Wadah Area Kuis -->
        <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-6">
            
            <!-- Indikator Pertanyaan & Bintang -->
            <div class="flex justify-between items-center border-b border-slate-100 pb-4">
                <span id="kuis-progress-text" class="text-xs font-extrabold text-slate-400 uppercase tracking-widest">
                    PERTANYAAN 1 DARI 5
                </span>
                <!-- Indikator Bintang Kecil -->
                <div class="flex gap-1 text-amber-400 text-sm">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
            </div>

            <!-- Detail Soal Pertanyaan -->
            <div class="space-y-4">
                <h3 class="text-xl md:text-2xl font-black text-slate-800 tracking-wide">
                    Mana gambar <span id="kuis-keyword" class="text-[#4F46E5]">"..."</span> yang bunyinya <span id="kuis-deskripsi">...</span>?
                </h3>

                <!-- Bar Tombol Audio Petunjuk Kakak Peri -->
                <div class="bg-[#F0FDF4] border border-[#DCFCE7] rounded-xl p-3 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="text-xl">🧚‍♀️</span>
                        <p class="text-xs font-bold text-slate-600">Klik tombol hijau untuk mendengar suara petunjuk Kakak Peri!</p>
                    </div>
                    <button onclick="putarAudioKuis()" class="w-10 h-10 bg-[#00A878] hover:bg-[#008F64] text-white rounded-xl flex items-center justify-center shadow-md shadow-emerald-100 transition-all">
                        <i class="fa-solid fa-volume-high"></i>
                    </button>
                </div>
            </div>

            <!-- Element Audio Hidden -->
            <audio id="audioKuisPlayer" src=""></audio>

            <!-- Pilihan Jawaban Opsional (4 Kartu Gambar) -->
            <div id="box-opsi-jawaban" class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-2">
                <!-- Elemen di-generate otomatis via Javascript di bawah -->
            </div>

            <!-- Notifikasi Hasil Feedback (Pop up mini transparan di bawah soal) -->
            <div id="feedback-kuis" class="hidden text-center font-black text-sm py-2.5 rounded-xl transition-all"></div>

        </div>
    </div>

    <!-- Logika Kuis Interaktif 5 Soal Looping Otomatis -->
    <script>
        // Data diambil dari object PHP Laravel $contents yang berkategori Sound_Imitation
        const masterData = @json($contents->where('kategori', 'Sound_Imitation')->values());
        
        let kumpulanSoal = [];
        let indexSekarang = 0;

        // Fungsi mengacak pilihan kartu jawaban agar posisi jawaban benar tidak monoton
        function acakArray(array) {
            return array.sort(() => Math.random() - 0.5);
        }

        // Generate 5 Pertanyaan Tetap dari Database
        function siapkanKuis() {
            if (masterData.length < 4) {
                alert("Peringatan: Isikan minimal 4 data di admin dengan kategori Sound_Imitation agar pilihan kuis muncul sempurna!");
                return;
            }

            // Ambil 5 data teratas atau acak dari masterData
            let salinanMaster = [...masterData];
            let soalTerpilih = salinanMaster.slice(0, 5);

            kumpulanSoal = soalTerpilih.map(itemBenar => {
                // Cari 3 pilihan salah dari database yang judulnya berbeda
                let pilihanSalah = masterData.filter(d => d.id !== itemBenar.id);
                pilihanSalah = acakArray(pilihanSalah).slice(0, 3);

                // Gabungkan jawaban benar + jawaban salah, lalu acak posisinya
                let semuaOpsi = [itemBenar, ...pilihanSalah];
                semuaOpsi = acakArray(semuaOpsi);

                // Helper pembetul path agar tidak double slash atau salah deteksi folder
                const dapatkanPath = (pathMurni) => {
                    if (!pathMurni) return '';
                    // Jika data di DB sudah berawalan storage/ atau /storage, bersihkan dulu
                    let cleanPath = pathMurni.replace(/^\/?(storage\/)?/, '');
                    return `/storage/${cleanPath}`;
                };

                return {
                    jawabanBenarId: itemBenar.id,
                    keyword: itemBenar.judul,
                    deskripsi: itemBenar.isi, // Isian bunyi ejaan/suara dari kolom isi konten
                    audio: dapatkanPath(itemBenar.audio),
                    opsi: semuaOpsi.map(o => ({
                        id: o.id,
                        nama: o.judul,
                        gambar: dapatkanPath(o.gambar)
                    }))
                };
            });

            tampilkanSoal();
        }

        // Fungsi merender soal ke halaman web
        // Fungsi merender soal ke halaman web
function tampilkanSoal() {
    if (kumpulanSoal.length === 0) return;

    const soal = kumpulanSoal[indexSekarang];

    // Update teks komponen soal
    document.getElementById('kuis-progress-text').innerText = `PERTANYAAN ${indexSekarang + 1} DARI 5`;
    document.getElementById('kuis-keyword').innerText = `"${soal.keyword.toUpperCase()}"`;
    document.getElementById('kuis-deskripsi').innerText = soal.deskripsi;
    
    // Set audio player petunjuk suara
    const player = document.getElementById('audioKuisPlayer');
    if (soal.audio) {
        player.src = soal.audio;
        // Otomatis putar audio petunjuk saat soal berganti biar interaktif buat anak
        setTimeout(() => { player.play().catch(e => console.log("Autoplay dicegah browser, tunggu user klik tombol peri.")); }, 400);
    } else {
        player.removeAttribute('src');
    }

    // Reset box feedback pemberitahuan
    const feedback = document.getElementById('feedback-kuis');
    feedback.className = "hidden text-center font-black text-sm py-2.5 rounded-xl transition-all";

    // Render 4 Kartu Opsi Pilihan Gambar
    const boxOpsi = document.getElementById('box-opsi-jawaban');
    boxOpsi.innerHTML = '';

    soal.opsi.forEach(pilihan => {
        let kartu = document.createElement('div');
        kartu.className = "opsi-kartu bg-white border-2 border-slate-200/80 rounded-2xl p-5 flex flex-col items-center justify-center text-center cursor-pointer shadow-sm hover:border-indigo-400";
        
        // Logika render: Jika ada file gambar, pasang tag img. Kalau error/gagal load, otomatis ganti jadi balon 🎈
        if (pilihan.gambar) {
            kartu.innerHTML = `
                <img src="${pilihan.gambar}" class="w-24 h-24 object-contain mb-3" alt="${pilihan.nama}" 
                     onerror="this.onerror=null; this.remove(); const ball = document.createElement('span'); ball.className='text-4xl mb-3'; ball.innerText='🎈'; this.parentElement.prepend(ball);">
                <span class="font-extrabold text-sm text-slate-700 tracking-wide">${pilihan.nama}</span>
            `;
        } else {
            // Kalau dari awal emang gak ada gambar di database
            kartu.innerHTML = `
                <span class="text-4xl mb-3">🎈</span>
                <span class="font-extrabold text-sm text-slate-700 tracking-wide">${pilihan.nama}</span>
            `;
        }
        
        // Tambah event klik cek jawaban
        kartu.onclick = () => verifikasiJawaban(pilihan.id, kartu);
        boxOpsi.appendChild(kartu);
    });
}

        function putarAudioKuis() {
            const player = document.getElementById('audioKuisPlayer');
            if (player && player.src && player.src !== window.location.href) {
                player.play().catch(err => alert("Gagal memutar audio, pastikan file format .mp3/.wav valid!"));
            } else {
                alert("Waduh, audio petunjuk soal ini belum diunggah atau path salah!");
            }
        }

        // Validasi jawaban pilihan si anak
        function verifikasiJawaban(opsiId, elemenKartu) {
            const soal = kumpulanSoal[indexSekarang];
            const feedback = document.getElementById('feedback-kuis');

            if (opsiId === soal.jawabanBenarId) {
                // JAWABAN BENAR!
                elemenKartu.className = "opsi-kartu bg-emerald-50 border-2 border-emerald-500 rounded-2xl p-5 flex flex-col items-center justify-center text-center shadow-sm text-emerald-600";
                
                feedback.innerText = "🎉 HEBAT! Jawaban kamu benar, pintar sekali! ✨";
                feedback.className = "block bg-emerald-50 text-emerald-600 border border-emerald-200 text-center font-black text-sm py-2.5 rounded-xl animate-bounce";

                // Block semua interaksi klik kartu sementara sebelum pindah soal
                document.getElementById('box-opsi-jawaban').style.pointerEvents = "none";

                // Otomatis lanjut ke pertanyaan berikutnya setelah 1.5 detik
                setTimeout(() => {
                    document.getElementById('box-opsi-jawaban').style.pointerEvents = "auto";
                    indexSekarang++;
                    
                    // Kalau sudah melebihi soal ke-5 (index 4), balik lagi ke soal nomor 1 (index 0)
                    if (indexSekarang >= kumpulanSoal.length) {
                        indexSekarang = 0;
                        alert("Hore! Semua tantangan sudah selesai dijawab. Yuk kita ulang lagi dari awal bermain!");
                    }
                    
                    tampilkanSoal();
                }, 1500);

            } else {
                // JAWABAN SALAH!
                elemenKartu.className = "opsi-kartu bg-rose-50 border-2 border-rose-400 rounded-2xl p-5 flex flex-col items-center justify-center text-center shadow-sm text-rose-600 animate-headShake";
                
                feedback.innerText = "❌ Ups! Kurang tepat sayang, yuk coba tebak lagi gambar yang lain!";
                feedback.className = "block bg-rose-50 text-rose-600 border border-rose-200 text-center font-black text-sm py-2.5 rounded-xl";
            }
        }

        // Jalankan kuis saat halaman selesai dimuat
        document.addEventListener('DOMContentLoaded', () => {
            siapkanKuis();
        });
    </script>
@endsection