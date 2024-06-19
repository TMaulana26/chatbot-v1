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
                'description' => 'Departemen yang bertanggung jawab atas operasi sehari-hari PT KAI DAOP 1.',
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
                'description' => 'Departemen yang mengelola sistem informasi dan teknologi di PT KAI DAOP 1.',
            ],
        ];

        $tasks = [
            [
                'title' => 'Rapat Harian Operasi',
                'description' => 'Mengadakan rapat harian untuk koordinasi operasi.',
                'department_id' => 1,
                'status' => 'pending',
                'due_date' => '2024-06-20',
            ],
            [
                'title' => 'Inspeksi Rutin Sarana',
                'description' => 'Melakukan inspeksi rutin terhadap sarana kereta api.',
                'department_id' => 2,
                'status' => 'pending',
                'due_date' => '2024-06-21',
            ],
            [
                'title' => 'Pelatihan SDM',
                'description' => 'Mengadakan pelatihan untuk pengembangan karyawan.',
                'department_id' => 3,
                'status' => 'pending',
                'due_date' => '2024-06-22',
            ],
            [
                'title' => 'Laporan Keuangan Bulanan',
                'description' => 'Menyiapkan laporan keuangan untuk bulan ini.',
                'department_id' => 4,
                'status' => 'pending',
                'due_date' => '2024-06-23',
            ],
            [
                'title' => 'Pembaruan Sistem Informasi',
                'description' => 'Melakukan pembaruan sistem informasi perusahaan.',
                'department_id' => 5,
                'status' => 'pending',
                'due_date' => '2024-06-24',
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
