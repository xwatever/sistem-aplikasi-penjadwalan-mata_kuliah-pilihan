<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Classroom;
use App\Models\ClassroomAttendance;
use App\Models\Subject;
use Illuminate\Validation\Rule;

class ClassroomController extends Controller
{
    public function getClassrooms()
    {
        $classrooms = DB::table('classrooms')
                          ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
                          ->select('classrooms.id', 'classrooms.group_name', 'subjects.subject_name')
                          ->get();

        return response()->json($classrooms);
    }

    public function getCurrentClassroom($classroom)
    {
        $classrooms = DB::table('classrooms')
                          ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
                          ->select('classrooms.id', 'subjects.subject_name', 'classrooms.group_name')
                          ->where('classrooms.id', $classroom)
                          ->get();
        return response()->json($classrooms);
    }

    public function getCurrentClassroomAttendances($classroom)
    {
        $attendances = DB::table('classroom_attendances')
                          ->join('classrooms', 'classrooms.id', '=', 'classroom_attendances.class_id')
                          ->join('subjects', 'subjects.id', '=', 'classrooms.subject_id')
                          ->join('users', 'users.identity_number', '=', 'classroom_attendances.identity_number')
                          ->select('classrooms.id', 'users.identity_number', 'users.fullname', 'users.phone_number')
                          ->where('class_id', $classroom)
                          ->get();

        return response()->json($attendances);
    }

    public function addClassroom(Request $request)
    {
        $subject_name = $request->input('subject_name');
        $validated = $request->validate([
            'subject_name' => [
                                  'required',
                                  Rule::exists('subjects')
                                  ->where('subject_name', $subject_name)
                             ],
            'group_name' => ['required', 'unique:classrooms']
        ]);

        $subject_id = Subject::where('subject_name', $subject_name)->value('id');

        $classroom = Classroom::create([
            'subject_id' => $subject_id,
            'group_name' => $request->input('group_name')
        ]);
        return response()->json('berhasil');
    }

    public function deleteClassroom(Request $request)
    {
        Classroom::where('id', $request->input('id'))
            ->delete();

        return response()->json('berhasil');
    }
}
