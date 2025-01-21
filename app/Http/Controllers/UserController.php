<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Schedule;
use App\Models\Classroom;
use App\Models\ClassroomTask;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function getCurrentlyLoggedUser(User $user)
    {
        $users = $user;
        return response()->json($users);
    }

    public function getSpecificUser($user)
    {
        $users = DB::table('users')
                  ->select(
                      'users.identity_number',
                      'users.fullname',
                      'users.email',
                      'users.birthdate',
                      'users.gender',
                      'users.phone_number',
                      'users.address',
                      'users.role',
                  )
                  ->where('users.identity_number', '=', $user)
                  ->get();

        return response()->json($users);
    }

    public function getStudents()
    {
        $users = DB::table('users')
                  ->select(
                      'users.identity_number',
                      'users.fullname'
                  )
                  ->where('users.role', '=', '3')
                  ->get();

        return response()->json($users);
    }

    public function getScheduleForUser(User $user)
    {
        $ids = [];
        foreach ($user->classrooms as $classroom) {
            $ids[] = $classroom->id;
        }

        $schedules = Schedule::whereIn('class_id', $ids)->get();
        return response()->json($schedules);
    }


    public function addUser(Request $request)
    {
        $validated = $request->validate([
            'identity_number' => ['required', 'unique:users'],
            'fullname' => ['required'],
            'role' => ['required', 'integer'],
            'password' => ['required', 'string', 'min:8']
        ]);

        User::create([
            'identity_number' => $request->input('identity_number'),
            'fullname' => $request->input('fullname'),
            'role' => $request->input('role'),
            'password' => Hash::make($request->input('password'))
        ]);

        return response()->json('berhasil');
    }

    public function editUser(Request $request)
    {
        $validated = $request->validate([
            'identity_number' => ['required'],
            'fullname' => ['required'],
            'role' => ['required'],
            'password' => ['required', 'string', 'min:8']
        ]);

        User::where('identity_number', $request->input('identity_number_lama'))
            ->update([
                'identity_number' => $request->input('identity_number'),
                'fullname' => $request->input('fullname'),
                'role' => $request->input('role'),
                'password' => Hash::make($request->input('password'))
        ]);

        return response()->json('berhasil');
    }

    public function editUser2(Request $request)
    {
        $validated = $request->validate([
            'identity_number' => ['required'],
            'fullname' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'birthdate' => ['required', 'date'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'phone_number' => ['required'],
            'address' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        User::where('identity_number', $request->input('identity_number'))
            ->update([
                'fullname' => $request->input('fullname'),
                'email' => $request->input('email'),
                'birthdate' => $request->input('birthdate'),
                'gender' => $request->input('gender'),
                'phone_number' => $request->input('phone_number'),
                'address' => $request->input('address'),
                'password' => Hash::make($request->input('password'))
        ]);

        return response()->json('berhasil');
    }

    public function deleteUser(Request $request)
    {
        User::where('identity_number', $request->input('identity_number'))
            ->delete();

        return response()->json('berhasil');
    }
}
