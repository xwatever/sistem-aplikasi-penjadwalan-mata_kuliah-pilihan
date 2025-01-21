<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Forum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    // public function getForums()
    // {
    //     $forums = Forum::all();
    //     return response()->json($forums);
    // }

    public function getForums()
    {
        $forums = DB::table('forums')
                      ->join('users', 'users.identity_number', '=', 'forums.identity_number')
                      ->select('forums.id', 'forums.identity_number', 'users.fullname', 'users.phone_number', 'forums.created_at', 'forums.title')
                      ->orderByDesc('forums.created_at')
                      ->get();

        return response()->json($forums);
    }

    public function getForumReplies($forum)
    {
        $forum_replies = DB::table('forums')
                              ->join('forum_replies', 'forums.id', '=', 'forum_replies.id_forum')
                              ->select('users.identity_number', 'users.fullname', 'forum_replies.content')
                              ->where('forum_replies.id_forum', '=', $forum)
                              ->get();

        return response()->json($forum_replies);
    }

    public function getForumContent($forum)
    {
        $forum_contents = DB::table('forums')
                              ->join('users', 'users.identity_number', '=', 'forums.identity_number')
                              ->select('users.identity_number', 'users.fullname', 'forums.content')
                              ->where('forums.id', '=', $forum)
                              ->get();

        return response()->json($forum_contents);
    }

    public function addForum(Request $request)
    {
        $validated = $request->validate([
          'identity_number' => ['required', 'exists:users'],
          'title' => ['required', 'min:3', 'max:100'],
          'content' => ['required', 'min:3', 'max:1000']
        ]);

        Forum::create([
          'identity_number' => $request->input('identity_number'),
          'title' => $request->input('title'),
          'content' => $request->input('content')
        ]);
    }
}
