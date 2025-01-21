<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'identity_number' => '001',
            'password' => Hash::make('tesAjaDulu'),
            'fullname' => 'Owner Lab T Sipil',
            'role' => 1
        ]);

        User::create([
            'identity_number' => '002',
            'password' => Hash::make('tesAjaDulu'),
            'fullname' => 'Admin Lab T Sipil',
            'role' => 2
        ]);

        User::create([
            'identity_number' => '173110001',
            'password' => Hash::make('tesAjaDulu'),
            'fullname' => 'Andi',
            'role' => 3
        ]);

        User::create([
            'identity_number' => '173110002',
            'password' => Hash::make('tesAjaDulu'),
            'fullname' => 'Badu',
            'role' => 3
        ]);

        User::create([
            'identity_number' => '173110003',
            'password' => Hash::make('tesAjaDulu'),
            'fullname' => 'Candra',
            'role' => 3
        ]);

        User::create([
            'identity_number' => '173110004',
            'password' => Hash::make('tesAjaDulu'),
            'fullname' => 'Dede',
            'role' => 3
        ]);

        User::create([
            'identity_number' => '173110005',
            'password' => Hash::make('tesAjaDulu'),
            'fullname' => 'Enggar',
            'role' => 3
        ]);

    }
}
