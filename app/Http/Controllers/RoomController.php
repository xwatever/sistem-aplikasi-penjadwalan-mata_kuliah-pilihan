<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Room;

class RoomController extends Controller
{
  public function getRooms()
  {
      $rooms = Room::all();
      return response()->json($rooms);
  }

  public function getSpecificRoom($room)
  {
      $rooms = DB::table('rooms')
                ->select(
                    'rooms.id',
                    'rooms.room_name'
                )
                ->where('rooms.id', '=', $room)
                ->get();

      return response()->json($rooms);
  }

  public function addRoom(Request $request)
  {
      $validated = $request->validate([
          'room_name' => ['required', 'unique:rooms'],
      ]);

      Room::create([
          'room_name' => $request->input('room_name'),
      ]);

      return response()->json('berhasil');
  }

  public function editRoom(Request $request)
  {
      $validated = $request->validate([
          'id' => ['required', 'exists:rooms'],
          'room_name' => ['required'],
      ]);

      Room::where('id', $request->input('id'))
          ->update([
              'room_name' => $request->input('room_name'),
      ]);

      return response()->json('berhasil');
  }

  public function deleteRoom(Request $request)
  {
      Room::where('id', $request->input('id'))
          ->delete();

      return response()->json('berhasil');
  }
}
