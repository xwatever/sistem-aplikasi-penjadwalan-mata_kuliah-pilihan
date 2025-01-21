<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\ForumReply;

class ForumReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ForumReply::create([
            'id_forum' => 1,
            'identity_number' => '002',
            'content' =>
            'Waalaikumsalam, Wr, Wb.

            Kamu sudah dipindahkan ke grup 4, jika ada pertanyaan lain tanyakan aja kembali kesini'
        ]);

        ForumReply::create([
            'id_forum' => 1,
            'identity_number' => '173110001',
            'content' => 'Baik pak, terimakasih'
        ]);

        ForumReply::create([
            'id_forum' => 2,
            'identity_number' => '002',
            'content' =>
            'Waalaikumsalam, Wr, Wb.

            Kamu sudah dipindahkan ke grup 1, jika ada pertanyaan lain tanyakan aja kembali kesini'
        ]);
    }
}
