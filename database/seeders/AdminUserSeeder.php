<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Cek apakah admin sudah ada
        $adminExists = DB::table('users')->where('email', 'admin@tuturo.com')->exists();
        
        if (!$adminExists) {
            DB::table('users')->insert([
                'name' => 'Administrator',
                'email' => 'admin@tuturo.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->command->info('✅ Admin user berhasil dibuat!');
            $this->command->info('📧 Email: admin@tuturo.com');
            $this->command->info('🔑 Password: admin123');
        } else {
            $this->command->info('⚠️ Admin user sudah ada!');
        }
    }
}