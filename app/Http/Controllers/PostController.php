<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
  
    public function index()
    {
        $posts=Post::all();
        return view('index',compact('posts'));
    }


    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        $post=new Post;
        $post->title=$request->title;
        $post->author=$request->author;
        $post->save();
        return redirect('/');
    }

 
    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $post=Post::find($id);
        $posts=Post::all();
        return view('index',compact('post','posts'));
    }


    public function update(Request $request, string $id)
    {
         $post=Post::find($id);
        $post->title=$request->title;
        $post->author=$request->author;
        $post->save();
        return redirect('/');
    }

    public function destroy(string $id)
    {
        $post=Post::find($id);
        $post->delete();
        return redirect('/');
    }
}
