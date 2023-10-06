<?php

namespace App\Http\Controllers;
use App\Models\Blogpost;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class BlogpostController extends Controller
{
    public function index(){
        return view('blogs.index',[
            'blogposts'=>Blogpost::with('category','author')->
            latest()->filter(request(['search','category','author']))
            ->paginate(6)
            ->withQueryString()
        ]);
    }
    
    public function show(Blogpost $blogpost){
   
        return view('blogs.show',[
            'blogpost'=>$blogpost,
            'comments'=>Comment::all(),
            'randomBlogs'=>Blogpost::inRandomOrder()->take(3)->get()
        ]);
       
    }
    public function Like(Blogpost $blogpost){
        $user = Auth::user();
            $user->likedBlogposts()->attach($blogpost);
    }
    public function Unlike(Blogpost $blogpost){
        $user = Auth::user();
        $user->likedBlogposts()->detach($blogpost);
}

    public function create()
    {
        return view('blogs.create',[
            'categories'=>Category::all()
        ]);
    }
    public function store(Request $request)
{
    $formData = $request->validate([
        "blogtitle" => ['required'],
        "blogbody" => ['required'],
    "read_duration" => ['required'],
        "category_id" => ['required', Rule::exists('categories', 'id')]
    ]);

    $formData['user_id'] = auth()->id();

    $formData['thumbnail']=request()->file('thumbnail')->store('thumbnails');
    $slug = Str::random(10);

    while (Blogpost::where('filename', $slug)->exists()) {
        $slug = Str::random(10);
    }

    $formData['filename'] = $slug;
 
  
     Blogpost::create($formData); 
     return redirect('/blogposts');
   
}

    public function edit(Blogpost $blogpost)
    {
        return view('blogs.edit',[
            'blogpost'=>$blogpost,
            'categories'=>Category::all()
        ]);
    }
    public function update(Blogpost $blogpost)
    {
        $formData=request()->validate([
            "blogtitle"=>['required'],
            "blogbody"=>['required'],
            "read_duration"=>['required'],
            "category_id"=>['required',Rule::exists('categories','id')]
           ]);
           $formData['user_id']=auth()->id();
           $formData['thumbnail']=request()->file('thumbnail')?
           request()->file('thumbnail')->store('thumbnails')
           :$blogpost->thumbnail;
           $blogpost->update($formData);
           return view('blogs.edit',[
            "blogpost"=>$blogpost,
            'categories'=>Category::all()
           ]);
    }
    public function updatePassword(Request $request)
{
    // Validate the request data for changing the password
    $validator = Validator::make($request->all(), [
        'old_password' => ['required'],
        'new_password' => ['required', 'min:8', 'confirmed'],
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Check if the old password is correct
    if (!Hash::check($request->old_password, auth()->user()->password)) {
        return redirect()->back()->withErrors(['old_password' => 'The old password is incorrect.'])->withInput();
    }

    // Update the user's password
    auth()->user()->update([
        'password' => bcrypt($request->new_password),
    ]);
}
public function destroy(string $filename)
{
    $blogpost = Blogpost::where('filename', $filename)->first();
        $blogpost->delete();
   

    return redirect('/blogposts');
}



}
