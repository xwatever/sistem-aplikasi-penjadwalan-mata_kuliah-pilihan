<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::create([
            'class_id' => 1,
            'room_id' => 1,
            'title' => 'Bab 1',
            'start' => '2024-10-24 07:00:00',
            'end' => '2024-10-24 08:40:00'
        ]);

        Schedule::create([
            'class_id' => 2,
            'room_id' => 2,
            'title' => 'Bab 1',
            'start' => '2024-10-24 07:00:00',
            'end' => '2024-10-24 08:40:00'
        ]);

        Schedule::create([
            'class_id' => 3,
            'room_id' => 1,
            'title' => 'Bab 2',
            'start' => '2024-10-24 10:30:00',
            'end' => '2024-10-24 11:55:00'
        ]);

        Schedule::create([
            'class_id' => 4,
            'room_id' => 1,
            'title' => 'Bab 4',
            'start' => '2024-10-24 13:00:00',
            'end' => '2024-10-24 14:40:00'
        ]);

        Schedule::create([
            'class_id' => 5,
            'room_id' => 1,
            'title' => 'Bab 3',
            'start' => '2024-10-24 14:45:00',
            'end' => '2024-10-24 16:30:00'
        ]);
    }
}
