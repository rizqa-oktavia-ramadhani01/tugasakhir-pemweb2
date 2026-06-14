<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Education;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        Education::insert([
            [
                'title' => 'Keterlambatan Bicara (Speech Delay) vs Gangguan Bahasa',
                'category' => 'Speech Therapy Tips',
                'reading_time' => '6 MIN READ',
                'excerpt' => 'Bagaimana mendeteksi perbedaan sejak dini antara anak kesulitan memproses bahasa dan speech delay.',
                'content' => 'Keterlambatan bicara (speech delay) adalah kondisi ketika kemampuan berbicara anak berkembang lebih lambat dibandingkan anak seusianya. Berbeda dengan gangguan bahasa yang memengaruhi kemampuan memahami maupun menggunakan bahasa dalam komunikasi sehari-hari. Orang tua perlu memperhatikan tanda seperti kosakata yang terbatas, sulit memahami instruksi sederhana, serta kurang merespons ketika diajak berbicara. Jika gejala berlangsung terus-menerus, konsultasikan dengan tenaga profesional untuk mendapatkan penanganan yang tepat.',
                'banner_color' => '#4F7CF3',
                'badge' => 'Speech Therapy Tips',
            ],

            [
                'title' => 'Metode Dialogis: Rahasia Membacakan Buku Interaktif',
                'category' => 'Storytelling Guide',
                'reading_time' => '8 MIN READ',
                'excerpt' => 'Menggunakan teknik PEER dan CROWD untuk meningkatkan interaksi anak saat membaca.',
                'content' => 'Membacakan buku secara dialogis membantu anak lebih aktif selama kegiatan membaca. Orang tua dapat mengajukan pertanyaan sederhana, meminta anak menunjuk gambar, atau mengajak anak menebak alur cerita. Teknik ini membantu meningkatkan kosakata, kemampuan memahami cerita, serta keterampilan berkomunikasi. Luangkan waktu 10–15 menit setiap hari agar anak terbiasa berinteraksi melalui kegiatan membaca.',
                'banner_color' => '#14C6A3',
                'badge' => 'Storytelling Guide',
            ],

            [
                'title' => 'Mengatasi GTM (Gerakan Tutup Mulut) & Memicu Komunikasi Makan',
                'category' => 'Article',
                'reading_time' => '5 MIN READ',
                'excerpt' => 'Memanfaatkan momen makan sebagai kesempatan emas stimulasi komunikasi anak.',
                'content' => 'GTM atau Gerakan Tutup Mulut sering membuat orang tua khawatir. Selain memperhatikan asupan nutrisi, waktu makan juga dapat dimanfaatkan untuk melatih komunikasi anak. Ajak anak menyebut nama makanan, memilih menu yang diinginkan, atau mengungkapkan rasa makanan yang sedang dimakan. Suasana makan yang menyenangkan dapat membantu meningkatkan kemampuan komunikasi secara alami.',
                'banner_color' => '#FFA000',
                'badge' => 'Article',
            ],

            [
                'title' => 'Panduan Memilih Mainan Edukasi Bebas Layar',
                'category' => 'Article',
                'reading_time' => '7 MIN READ',
                'excerpt' => 'Mainan sederhana dapat membantu perkembangan bahasa dan motorik anak.',
                'content' => 'Mainan edukasi tidak harus mahal atau berbasis teknologi. Balok susun, puzzle, kartu bergambar, dan buku cerita merupakan pilihan yang baik untuk merangsang perkembangan bahasa dan motorik anak. Pilih mainan yang sesuai usia, aman digunakan, serta mendorong interaksi antara anak dan orang tua. Bermain bersama dapat menjadi kesempatan berharga untuk melatih komunikasi dan kreativitas anak.',
                'banner_color' => '#FF4F9A',
                'badge' => 'Article',
            ]
        ]);
    }
}