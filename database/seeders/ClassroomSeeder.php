<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Classroom;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Classroom::create([
          'subject_id' => 1,
          'group_name' => 'Kelompok 1'
        ]);

        Classroom::create([
          'subject_id' => 1,
          'group_name' => 'Kelompok 2'
        ]);

        Classroom::create([
          'subject_id' => 2,
          'group_name' => 'Kelompok 3'
        ]);

        Classroom::create([
          'subject_id' => 2,
          'group_name' => 'Kelompok 4'
        ]);

        Classroom::create([
          'subject_id' => 3,
          'group_name' => 'Kelompok 5'
        ]);
    }
}
