<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function getSubjects()
    {
        $subjects = Subject::all();
        return response()->json($subjects);
    }

    public function getSpecificSubject($subject)
    {
        $subjects = DB::table('subjects')
                  ->select(
                      'subjects.id',
                      'subjects.subject_name',
                      'subjects.acs'
                  )
                  ->where('subjects.id', '=', $subject)
                  ->get();

        return response()->json($subjects);
    }

    public function getClassroomsEnrollingCurrentSubject(Subject $subject)
    {
        $classrooms = $subject->classrooms;
        return response()->json($classrooms);
    }

    public function addSubject(Request $request)
    {
        $validated = $request->validate([
            'subject_name' => ['required', 'unique:subjects'],
            'acs' => ['required', 'integer']
        ]);

        Subject::create([
            'subject_name' => $request->input('subject_name'),
            'acs' => $request->input('acs')
        ]);

        return response()->json('berhasil');
    }

    public function editSubject(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'exists:subjects'],
            'subject_name' => ['required'],
            'acs' => ['required', 'integer']
        ]);

        Subject::where('id', $request->input('id'))
            ->update([
                'subject_name' => $request->input('subject_name'),
                'acs' => $request->input('acs')
        ]);

        return response()->json('berhasil');
    }

    public function deleteSubject(Request $request)
    {
        Subject::where('id', $request->input('id'))
            ->delete();

        return response()->json('berhasil');
    }
}
