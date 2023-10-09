<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogpost;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Blogpost $blogpost)
    {
        $data = request()->validate([
            'body' => 'required',
        ],[
            'body.required'=>"Write Something, Please!",
        ]);

        $this->createComment($blogpost, $data['body']);
    }

    public function destroy(Request $request, $filename)
    {
        $id = $request->input('id');
        $comment = $this->findComment($id, $filename);

        if ($comment) {
            $comment->delete();
        }
    }

    public function edit(string $id)
    {
        $comment = Comment::find($id);
        $comments = Comment::all();

        return view('blogs.show', compact('comment', 'comments'));
    }

    public function update(Request $request, $filename)
    {
        $request->validate([
            'edited_body' => 'required',
            'new_id' => 'required',
        ]);

        $this->updateComment($request->input('new_id'), $request->input('edited_body'));
    }

    private function createComment(Blogpost $blogpost, $body)
    {
        $blogpost->comments()->create([
            'body' => $body,
            'user_id' => auth()->id()
        ],[
            'body.required'=>"Write Something, Please!",
        ]);
    }

    private function findComment($id, $filename)
    {
        return Comment::where('id', $id)
            ->whereHas('blogpost', function ($query) use ($filename) {
                $query->where('filename', $filename);
            })
            ->first();
    }

    private function updateComment($id, $editedBody)
    {
        $comment = Comment::findOrFail($id);
        $comment->body = $editedBody;
        $comment->save();
    }
}

