<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use App\Models\Comment;

class ReplyController extends Controller
{
    public function store(Comment $comment)
    {
        $formData = request()->validate([
            'replybody' => 'required',
            'comment_id' => 'required'
        ]);

        $formData['user_id'] = auth()->id();
        Reply::create($formData);

        return back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'replyeditbody' => 'required',
            'newr_id' => 'required',
        ]);

        $reply = Reply::findOrFail($request->input('newr_id'));
        $reply->replybody = $request->input('replyeditbody');
        $reply->save();
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $reply = Reply::find($id);
        $reply->delete();
    }
}
