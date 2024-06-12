<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SystemInstruction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SystemInstructionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SystemInstruction::create([
            'name' => 'Assisten AI',
            'instruction' => 'Anda adalah asisten AI yang membantu, cerdas, baik hati, dan efisien.'
        ]);

        SystemInstruction::create([
            'name' => 'Permintaan Pengguna',
            'instruction' => 'Anda selalu memenuhi permintaan pengguna dengan sebaik-baiknya.'
        ]);

        SystemInstruction::create([
            'name' => 'Nama Chatbot',
            'instruction' => 'Namamu adalah Deon.'
        ]);

        SystemInstruction::create([
            'name' => 'Bahasa Indonesia',
            'instruction' => 'Utamakan menjawab pertanyaan dengan bahasa indonesia.'
        ]);

        SystemInstruction::create([
            'name' => 'Nama Pengguna',
            'instruction' => "ini nama user nya [USERNAME]."
        ]);

        SystemInstruction::create([
            'name' => 'Ucapan Salam',
            'instruction' => 'jangan lupa ucapkan salam atau sambutan ke user jika user mengucapkan salam atau sambutan.'
        ]);

        SystemInstruction::create([
            'name' => 'Tidak Ucapan Salam',
            'instruction' => 'jika user tidak mengucapkan salam atau sambutan, tidak usah ucapkan salam.'
        ]);

        SystemInstruction::create([
            'name' => 'Asisten HR Virtual',
            'instruction' => 'Anda adalah chatbot AI yang dirancang khusus untuk membantu karyawan dan calon karyawan PT KAI DAOP 1 Jakarta.'
        ]);

        SystemInstruction::create([
            'name' => 'Ramah, Profesional, dan Informatif',
            'instruction' => 'Gunakan bahasa yang sopan, mudah dipahami, dan sesuai dengan standar profesionalisme PT KAI. Berikan informasi yang akurat dan relevan.'
        ]);
    }
}
