<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call([
          UserSeeder::class,
          SubjectSeeder::class,
          RoomSeeder::class,
          ClassroomSeeder::class,
          ClassroomAttendanceSeeder::class,
          ScheduleSeeder::class,
          ForumSeeder::class,
          ForumReplySeeder::class,
      ]);
    }
}
