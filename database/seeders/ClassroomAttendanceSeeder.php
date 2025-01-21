<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\ClassroomAttendance;

class ClassroomAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          // Grup 1
        ClassroomAttendance::create([
            'class_id' => 1,
            'identity_number' => '173110001'
        ]);

        ClassroomAttendance::create([
            'class_id' => 1,
            'identity_number' => '173110003'
        ]);

        ClassroomAttendance::create([
            'class_id' => 1,
            'identity_number' => '173110005'
        ]);


          // Grup 2
        ClassroomAttendance::create([
            'class_id' => 2,
            'identity_number' => '173110002'
        ]);

        ClassroomAttendance::create([
            'class_id' => 2,
            'identity_number' => '173110004'
        ]);


          // Grup 3
        ClassroomAttendance::create([
            'class_id' => 3,
            'identity_number' => '173110001'
        ]);

        ClassroomAttendance::create([
            'class_id' => 3,
            'identity_number' => '173110003'
        ]);

        ClassroomAttendance::create([
            'class_id' => 3,
            'identity_number' => '173110005'
        ]);


          // Grup 4
        ClassroomAttendance::create([
            'class_id' => 4,
            'identity_number' => '173110002'
        ]);

        ClassroomAttendance::create([
            'class_id' => 4,
            'identity_number' => '173110004'
        ]);


          // Grup 5
        ClassroomAttendance::create([
            'class_id' => 5,
            'identity_number' => '173110001'
        ]);

        ClassroomAttendance::create([
            'class_id' => 5,
            'identity_number' => '173110003'
        ]);

        ClassroomAttendance::create([
            'class_id' => 5,
            'identity_number' => '173110005'
        ]);
    }
}
