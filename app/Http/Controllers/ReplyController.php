<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use App\Models\Comment;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ReplyController extends Controller
{
    public function store(Comment $comment)
    {
        $formData=request()->validate([
            'replybody'=>'required',
            'comment_id'=>'required'
        ]);
        $formData['user_id']=auth()->id();
        Reply::create($formData); 
        return back();
    }
    public function update(Request $request, $filename)
    {
        // Validate the request data
        $request->validate([
            'replyeditbody' => 'required',
            'newr_id' => 'required',
        ]);
    
        // Find the comment by its ID
        $reply = Reply::findOrFail($request->input('newr_id'));
    
        // Check if the user is authorized to update the comment (you can implement your authorization logic here)
    
        // Update the comment's body
        $reply->replybody = $request->input('replyeditbody');
        $reply->save();
    
    }
    public function destroy(Request $request, $filename)
{
    $id = $request->input('id'); // Get the 'id' from the request data

    // Find the reply by ID
    $reply = Reply::find($id);

  
    // Check if the user is authorized to delete the reply (you can implement your authorization logic here)

    // Delete the reply
    $reply->delete();

}

}
