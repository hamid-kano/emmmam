<?php

namespace Database\Seeders;

use App\Models\Backup;
use Illuminate\Database\Seeder;

class BackupsSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Backup::create([
                'filename' => 'backup_hisp_' . date('Y_m_d_H_i_s', strtotime("-{$i} days")),
                'path' => '/backups/database/',
                'size' => rand(50, 500) . ' MB',
                'backup_date' => now()->subDays($i),
                'description' => 'نسخة احتياطية يومية لقاعدة بيانات مشفى الرقة',
                'backups_data_path' => '/backups/data/'
            ]);
        }
    }
}