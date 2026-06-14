<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Milestone;

class MilestoneSeeder extends Seeder
{
    public function run()
    {
        $milestones = [
            // ========== USIA 1-2 TAHUN ==========
            [
                'kategori_usia' => '1-2 Tahun',
                'milestone' => 'Mengucapkan 3-5 kata pertama',
                'deskripsi' => 'Anak mulai mengucapkan kata-kata sederhana'
            ],
            [
                'kategori_usia' => '1-2 Tahun',
                'milestone' => 'Menunjuk bagian tubuh',
                'deskripsi' => 'Anak dapat menunjuk mata, hidung, mulut'
            ],
            [
                'kategori_usia' => '1-2 Tahun',
                'milestone' => 'Mengikuti instruksi 1 langkah',
                'deskripsi' => 'Anak dapat melakukan perintah sederhana'
            ],
            
            // ========== USIA 2-3 TAHUN ==========
            [
                'kategori_usia' => '2-3 Tahun',
                'milestone' => 'Membentuk kalimat 2 kata',
                'deskripsi' => 'Anak dapat menggabungkan 2 kata'
            ],
            [
                'kategori_usia' => '2-3 Tahun',
                'milestone' => 'Kosakata mencapai 50+ kata',
                'deskripsi' => 'Anak memiliki lebih dari 50 kata'
            ],
            [
                'kategori_usia' => '2-3 Tahun',
                'milestone' => 'Menjawab pertanyaan "Apa ini?"',
                'deskripsi' => 'Anak dapat menjawab pertanyaan sederhana'
            ],
            
            // ========== USIA 3-4 TAHUN ==========
            [
                'kategori_usia' => '3-4 Tahun',
                'milestone' => 'Membentuk kalimat 3-4 kata',
                'deskripsi' => 'Anak dapat menyusun kalimat sederhana'
            ],
            [
                'kategori_usia' => '3-4 Tahun',
                'milestone' => 'Menceritakan pengalaman sederhana',
                'deskripsi' => 'Anak dapat menceritakan apa yang dilakukannya'
            ],
            [
                'kategori_usia' => '3-4 Tahun',
                'milestone' => 'Mengajukan pertanyaan "Mengapa?"',
                'deskripsi' => 'Anak mulai bertanya tentang sebab-akibat'
            ],
            
            // ========== USIA 4-5 TAHUN ==========
            [
                'kategori_usia' => '4-5 Tahun',
                'milestone' => 'Membentuk kalimat 5-6 kata',
                'deskripsi' => 'Anak dapat menyusun kalimat lebih panjang'
            ],
            [
                'kategori_usia' => '4-5 Tahun',
                'milestone' => 'Menceritakan cerita pendek berurutan',
                'deskripsi' => 'Anak bisa bercerita dengan alur yang jelas'
            ],
            [
                'kategori_usia' => '4-5 Tahun',
                'milestone' => 'Menyebutkan huruf abjad A-Z',
                'deskripsi' => 'Anak mulai mengenal huruf'
            ],
            
            // ========== USIA 5+ TAHUN ==========
            [
                'kategori_usia' => '5+ Tahun',
                'milestone' => 'Membaca kata-kata sederhana',
                'deskripsi' => 'Anak mulai bisa membaca'
            ],
            [
                'kategori_usia' => '5+ Tahun',
                'milestone' => 'Menulis nama sendiri',
                'deskripsi' => 'Anak bisa menulis namanya'
            ],
            [
                'kategori_usia' => '5+ Tahun',
                'milestone' => 'Berhitung 1-20',
                'deskripsi' => 'Anak bisa menghitung benda'
            ],
            [
                'kategori_usia' => '5+ Tahun',
                'milestone' => 'Berkomunikasi dengan lancar',
                'deskripsi' => 'Anak dapat berbincang dengan orang lain'
            ],
            [
                'kategori_usia' => '5+ Tahun',
                'milestone' => 'Memahami konsep waktu',
                'deskripsi' => 'Anak mengerti hari ini, besok, kemarin'
            ],
            [
                'kategori_usia' => '5+ Tahun',
                'milestone' => 'Berpikir kritis sederhana',
                'deskripsi' => 'Anak bisa mengevaluasi informasi'
            ],
        ];
        
        foreach ($milestones as $m) {
            Milestone::updateOrCreate(
                ['milestone' => $m['milestone'], 'kategori_usia' => $m['kategori_usia']],
                $m
            );
        }
        
        $this->command->info('✅ ' . count($milestones) . ' milestone berhasil ditambahkan!');
    }
}