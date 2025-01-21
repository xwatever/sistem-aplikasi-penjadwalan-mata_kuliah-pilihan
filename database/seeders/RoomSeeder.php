<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::create([
            'room_name' => 'Lab Material Keras'
        ]);

        Room::create([
            'room_name' => 'Lab Material Ringan'
        ]);

        Room::create([
            'room_name' => 'Lab Luar'
        ]);
    }
}
