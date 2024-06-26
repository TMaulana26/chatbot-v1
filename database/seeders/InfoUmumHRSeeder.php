<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\InfoUmumHR;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InfoUmumHRSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InfoUmumHR::create([
            'title' => 'Jam Kerja',
            'description' => "Senin - Jumat: 09.00 - 17.00 WIB\nIstirahat: 12.00 - 13.00 WIB"
        ]);

        InfoUmumHR::create([
            'title' => 'Visi & Misi',
            'description' => "Visi: Menjadi solusi ekosistem transportasi terbaik untuk Indonesia.\nMisi:\n- Menyelenggarakan bisnis perkeretaapian dan bisnis lainnya yang berorientasi pada layanan prima berbasis teknologi.\n- Meningkatkan nilai perusahaan dan memberikan kontribusi terbaik bagi bangsa."
        ]);

        InfoUmumHR::create([
            'title' => 'Menggunakan Chatbot untuk Absen',
            'description' => 'Jika user ingin menggunakan chatbot untuk absen masuk maka tulis "/masuk" dan "/keluar" jika absen keluar, user hanya bisa absen keluar jika sudah absen masuk.'
        ]);

        InfoUmumHR::create([
            'title' => 'Menggunakan Chatbot untuk Izin Sakit atau Cuti',
            'description' => 'Jika user ingin menggunakan chatbot untuk pengajuan izin sakit maka tulis "/sakit" dan "/cuti" jika pengajuan izin cuti.'
        ]);

        InfoUmumHR::create([
            'title' => 'Menggunakan Chatbot untuk Memulai sesi baru',
            'description' => 'Jika user ingin menggunakan chatbot untuk memulai sesi baru, tulis "/clear".'
        ]);

        $pelatihanDate = Carbon::now()->addDays(2)->format('d-m-Y');
        $inspeksiDate = Carbon::now()->addWeek()->format('d-m-Y');
        $renovasiDate = Carbon::now()->addDays(3)->format('d-m-Y');

        InfoUmumHR::create([
            'title' => 'Pelatihan',
            'description' => "Akan dilakukan pelatihan pada tanggal $pelatihanDate."
        ]);

        InfoUmumHR::create([
            'title' => 'Inspeksi Kantor',
            'description' => "Akan dilakukan inspeksi kantor pada tanggal $inspeksiDate."
        ]);

        InfoUmumHR::create([
            'title' => 'Pembukaan Penyelesaian Renovasi Stasiun di Juanda',
            'description' => "Pembukaan penyelesaian renovasi stasiun di Juanda pada tanggal $renovasiDate."
        ]);
    }
}
