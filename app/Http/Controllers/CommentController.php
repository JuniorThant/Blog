<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogpost;
use App\Models\Comment;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Blogpost $blogpost)
    {
        request()->validate([
            'body'=>'required'
        ]);
        $blogpost->comments()->create([
            'body'=>request('body'),
            'user_id'=>auth()->id()

        ]);
       
    }
    public function destroy(Request $request, $filename)
    {
        $id = $request->input('id'); // Get the 'id' from the request data
            // Find the comment by ID and ensure it belongs to the specified blog post
            $comment = Comment::where('id', $id)
                ->whereHas('blogpost', function ($query) use ($filename) {
                    $query->where('filename', $filename);
                })
                ->firstOrFail();

            // Delete the comment
            $comment->delete();

    }
    public function edit(string $id)
    {
        $comment=Comment::find($id);
        $comments=Comment::all();
        return view('blogs.show',compact('comment','comments'));
    }

    public function update(Request $request, $filename)
    {
        // Validate the request data
        $request->validate([
            'edited_body' => 'required',
            'new_id' => 'required',
        ]);
    
        // Find the comment by its ID
        $comment = Comment::findOrFail($request->input('new_id'));
    
        // Check if the user is authorized to update the comment (you can implement your authorization logic here)
    
        // Update the comment's body
        $comment->body = $request->input('edited_body');
        $comment->save();
    
    }
}
