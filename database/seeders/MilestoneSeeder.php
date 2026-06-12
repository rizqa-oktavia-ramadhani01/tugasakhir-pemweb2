<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Milestone;

class MilestoneSeeder extends Seeder
{
    public function run()
    {
        $milestones = [
            // Usia 1-2 Tahun
            ['kategori_usia' => '1-2 Tahun', 'milestone' => 'Mengucapkan 3-5 kata', 'deskripsi' => 'Anak dapat mengucapkan minimal 3 kata bermakna'],
            ['kategori_usia' => '1-2 Tahun', 'milestone' => 'Menunjuk bagian tubuh', 'deskripsi' => 'Anak dapat menunjuk mata, hidung, mulut saat diminta'],
            ['kategori_usia' => '1-2 Tahun', 'milestone' => 'Mengikuti instruksi sederhana', 'deskripsi' => 'Contoh: "Ambil bola"'],
            
            // Usia 2-3 Tahun
            ['kategori_usia' => '2-3 Tahun', 'milestone' => 'Kalimat 2 kata', 'deskripsi' => 'Anak dapat menggabungkan 2 kata (contoh: "mau makan")'],
            ['kategori_usia' => '2-3 Tahun', 'milestone' => '50+ kosakata', 'deskripsi' => 'Anak memiliki lebih dari 50 kata dalam kosakatanya'],
            ['kategori_usia' => '2-3 Tahun', 'milestone' => 'Menjawab pertanyaan sederhana', 'deskripsi' => 'Contoh: "Apa ini?"'],
            
            // Usia 3-4 Tahun
            ['kategori_usia' => '3-4 Tahun', 'milestone' => 'Kalimat 3-4 kata', 'deskripsi' => 'Anak dapat menyusun kalimat sederhana'],
            ['kategori_usia' => '3-4 Tahun', 'milestone' => 'Menceritakan pengalaman', 'deskripsi' => 'Anak dapat menceritakan apa yang dilakukannya'],
            ['kategori_usia' => '3-4 Tahun', 'milestone' => 'Mengerti preposisi', 'deskripsi' => 'Mengerti kata "di atas", "di bawah", "di dalam"'],
        ];
        
        foreach ($milestones as $m) {
            Milestone::create($m);
        }
    }
}