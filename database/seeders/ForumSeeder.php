<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Forum;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Forum::create([
            'identity_number' => '173110001',
            'title' => 'Mengenai Pemindahan Kelas',
            'content' =>
            'Assalamualaikum, Wr, Wb.

            Saya Budi, ingin pindah grup dikarenakan waktu pada grup sebelumnya bentrok dengan jadwal saya yang lain. Apakah grup saya bisa dipindahkan ke grup 4? Terimakasih dan maaf sebelumnya..'
        ]);

        Forum::create([
            'identity_number' => '173110004',
            'title' => 'Pindah Kelas',
            'content' =>
            'Assalamualaikum, Wr, Wb.

            Saya Dika, Apakah saya bisa pindah ke grup 1 buk / pak?'
        ]);
    }
}
