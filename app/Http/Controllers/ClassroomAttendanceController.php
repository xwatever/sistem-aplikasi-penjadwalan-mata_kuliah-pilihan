<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ClassroomAttendance;
use Illuminate\Validation\Rule;

class ClassroomAttendanceController extends Controller
{
    public function addClassroomAttendance(Request $request)
    {
        $id = $request->input('class_id');
        $validated = $request->validate([
            'identity_number' => ['required', 'exists:users,identity_number', 'unique_with:classroom_attendances, class_id'],
            'class_id' => ['required', 'exists:classrooms,id', 'unique_with:classroom_attendances, identity_number']
        ]);

        ClassroomAttendance::create([
            'class_id' => $id,
            'identity_number' => $request->input('identity_number')
        ]);

        return response()->json('berhasil');
    }

    public function deleteClassroomAttendance(Request $request)
    {
        ClassroomAttendance::where('class_id', $request->input('class_id'))
              ->where('identity_number', $request->input('identity_number'))
              ->delete();

        return response()->json('berhasil');
    }
}
