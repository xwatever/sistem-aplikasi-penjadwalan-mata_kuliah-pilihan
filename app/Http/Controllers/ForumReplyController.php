<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ForumReply;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ForumReplyController extends Controller
{
    public function getForumReplies($forum)
    {
        $forum_replies = DB::table('forum_replies')
                            ->join('users', 'users.identity_number', '=', 'forum_replies.identity_number')
                            ->join('forums', 'forums.id', '=', 'forum_replies.id_forum')
                            ->select('users.identity_number', 'users.fullname', 'forum_replies.content')
                            ->where('forum_replies.id_forum', '=', $forum)
                            ->get();

        return response()->json($forum_replies);
    }

    public function addForumReply(Request $request)
    {
        $validated = $request->validate([
            'identity_number' => ['required', 'exists:users'],
            'id' => ['required', 'exists:forums'],
            'content' => ['required', 'min:3', 'max:1000']
        ]);

        ForumReply::create([
            'id_forum' => $request->input('id'),
            'identity_number' => $request->input('identity_number'),
            'content' => $request->input('content')
        ]);

    }
}
