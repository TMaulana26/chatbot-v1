<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\DepartmentTask;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Operasi',
                'description' => 'Departemen yang bertanggung jawab atas operasi sehari-hari PT KCI.',
            ],
            [
                'name' => 'Sarana',
                'description' => 'Departemen yang mengelola perawatan dan pemeliharaan sarana kereta api.',
            ],
            [
                'name' => 'SDM',
                'description' => 'Departemen Sumber Daya Manusia yang mengurus kepegawaian dan pengembangan karyawan.',
            ],
            [
                'name' => 'Keuangan',
                'description' => 'Departemen yang bertanggung jawab atas manajemen keuangan perusahaan.',
            ],
            [
                'name' => 'Teknologi Informasi',
                'description' => 'Departemen yang mengelola sistem informasi dan teknologi di PT KCI.',
            ],
            [
                'name' => 'Media Relations',
                'description' => 'Departemen Media Relations bertugas membangun dan memelihara hubungan baik antara organisasi/perusahaan dengan media massa melalui komunikasi proaktif, penyiapan materi publikasi, penanganan permintaan media, pengelolaan krisis, monitoring, dan evaluasi untuk membangun citra positif dan mencapai tujuan bisnis.',
            ],
            [
                'name' => 'Community and Event',
                'description' => 'Departemen Community and Event bertugas membangun dan memelihara hubungan baik dengan komunitas serta merencanakan dan melaksanakan berbagai acara untuk meningkatkan keterlibatan dan loyalitas komunitas melalui komunikasi dua arah, program komunitas, perencanaan dan pelaksanaan acara, evaluasi, dan pelaporan.',
            ],
        ];

        $tasks = [
            [
                'title' => 'Rapat Harian Operasi',
                'description' => 'Mengadakan rapat harian untuk koordinasi operasi.',
                'department_id' => 1,
                'status' => 'pending',
                'due_date' => '2024-07-20',
            ],
            [
                'title' => 'Inspeksi Rutin Sarana',
                'description' => 'Melakukan inspeksi rutin terhadap sarana kereta api.',
                'department_id' => 2,
                'status' => 'pending',
                'due_date' => '2024-07-21',
            ],
            [
                'title' => 'Pelatihan SDM',
                'description' => 'Mengadakan pelatihan untuk pengembangan karyawan.',
                'department_id' => 3,
                'status' => 'pending',
                'due_date' => '2024-07-22',
            ],
            [
                'title' => 'Laporan Keuangan Bulanan',
                'description' => 'Menyiapkan laporan keuangan untuk bulan ini.',
                'department_id' => 4,
                'status' => 'pending',
                'due_date' => '2024-07-23',
            ],
            [
                'title' => 'Pembaruan Sistem Informasi',
                'description' => 'Melakukan pembaruan sistem informasi perusahaan.',
                'department_id' => 5,
                'status' => 'pending',
                'due_date' => '2024-07-24',
            ],
            [
                'title' => 'Digital Media',
                'description' => 'Memanfaatkan media sosial dan platform digital lainnya untuk berkomunikasi dengan media dan publik.',
                'department_id' => 6,
                'status' => 'pending',
                'due_date' => '2024-07-24',
            ],
            [
                'title' => 'Publikasi',
                'description' => 'Menyiapkan materi promosi untuk acara dan kegiatan komunitas.',
                'department_id' => 7,
                'status' => 'pending',
                'due_date' => '2024-07-24',
            ],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }

        foreach ($tasks as $task) {
            DepartmentTask::create($task);
        }
    }
}
