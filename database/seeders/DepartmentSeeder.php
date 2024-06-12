<?php

namespace Database\Seeders;

use App\Models\Department;
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

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
