<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Schedule;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function getSchedules()
    {
        $schedule = Schedule::all();
        return response()->json($schedule);
    }

    public function getSchedules2()
    {
        $dateNow = date("Y-m-d H:i:s");
        $schedule = DB::table('schedules')
                        ->join('classrooms', 'classrooms.id', '=', 'schedules.class_id')
                        ->select('schedules.class_id', 'schedules.title', 'classrooms.group_name', 'schedules.start', 'schedules.end')
                        ->where('start', '>', $dateNow)
                        ->get();
        return response()->json($schedule);
    }

    public function getMySchedules($user)
    {
        $schedule = DB::table('schedules')
                        ->join('classrooms', 'classrooms.id', '=', 'schedules.class_id')
                        ->join('classroom_attendances', 'classroom_attendances.class_id', '=', 'classrooms.id')
                        ->join('users', 'users.identity_number', '=', 'classroom_attendances.identity_number')
                        ->select('schedules.id', 'schedules.title', 'schedules.start', 'schedules.end')
                        ->where('users.identity_number', '=', $user)
                        ->get();
        return response()->json($schedule);
    }

    public function getCurrentSchedule($schedule)
    {
        $scheduled = DB::table('schedules')
                        ->join('classrooms', 'classrooms.id', '=', 'schedules.class_id')
                        ->join('rooms', 'rooms.id', '=', 'schedules.room_id')
                        ->select('schedules.id', 'schedules.class_id', 'schedules.room_id', 'schedules.title', 'classrooms.group_name', 'rooms.room_name', 'schedules.start', 'schedules.end')
                        ->where('schedules.id', $schedule)
                        ->get();

        return response()->json($scheduled);
    }

    public function addSchedule(Request $request)
    {
        $validated = $request->validate([
            'class_id' => ['required', 'exists:classrooms,id'],
            'room_id' => ['required', 'exists:rooms,id', 'unique_with:schedules, start'],
            'title' => ['required'],
            'start' => ['required', 'unique_with:schedules, room_id'],
            'end' => ['required']
    ]);

        Schedule::create([
            'class_id' => $request->input('class_id'),
            'room_id' => $request->input('room_id'),
            'title' => $request->input('title'),
            'start' => $request->input('start'),
            'end' => $request->input('end')
    ]);

        return response()->json('berhasil');
    }

    public function editSchedule(Request $request)
    {
        $validated = $request->validate([
            'class_id' => ['required', 'exists:classrooms,id', 'unique_with:schedules, start'],
            'room_id' => ['required', 'exists:rooms,id', 'unique_with:schedules, start'],
            'title' => ['required'],
            'start' => ['required', 'unique_with:schedules, room_id'],
            'end' => ['required']
        ]);

        Schedule::where('id', $request->input('id'))
                  ->update([
                      'class_id' => $request->input('class_id'),
                      'room_id' => $request->input('room_id'),
                      'title' => $request->input('title'),
                      'start' => $request->input('start'),
                      'end' => $request->input('end')
        ]);

        return response()->json('berhasil');
    }

    public function deleteSchedule(Request $request)
    {
        Schedule::where('id', $request->input('id'))
            ->delete();

        return response()->json('berhasil');
    }
}
