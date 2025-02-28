<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, $commentId)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $reply = new Reply();
        $reply->content = $request->content;
        $reply->comment_id = $commentId;
        $reply->user_id = auth()->id();
        $reply->save();

        return redirect()->back();
    }
}
