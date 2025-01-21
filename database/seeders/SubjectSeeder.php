<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create([
            'subject_name' => 'Sipil A',
            'acs' => 3
        ]);

        Subject::create([
            'subject_name' => 'Sipil B',
            'acs' => 3
        ]);

        Subject::create([
            'subject_name' => 'Sipil C',
            'acs' => 4
        ]);
    }
}
