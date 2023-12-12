<?php

namespace App\Http\Controllers;

use App\Models\Blogpost;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogpostController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Blogpost::with('category', 'author')
            ->latest()
            ->filter($request->only(['search', 'category', 'author']))
            ->paginate(6)
            ->withQueryString();

        return view('blogs.index', ['blogposts' => $query]);
    }

    public function aboutus()
    {
        return view('blogs.aboutus');
    }

    public function show(Blogpost $blogpost)
    {
        $randomBlogs = Blogpost::inRandomOrder()->take(3)->get();

        return view('blogs.show', [
            'blogpost' => $blogpost,
            'comments' => Comment::all(),
            'randomBlogs' => $randomBlogs,
        ]);
    }

    public function like(Blogpost $blogpost)
    {
        Auth::user()->likedBlogposts()->attach($blogpost);
    }

    public function unlike(Blogpost $blogpost)
    {
        Auth::user()->likedBlogposts()->detach($blogpost);
    }

    public function create()
    {
        return view('blogs.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $formData = $this->validateBlogpostRequest($request);
        $formData['user_id'] = auth()->id();
        $formData['thumbnail'] = $this->storeThumbnail($request);
        $formData['filename'] = $this->storeFilename();

        Blogpost::create($formData);

        return redirect('/blogposts#blogs');
    }

    public function edit(Blogpost $blogpost)
    {
        return view('blogs.edit', [
            'blogpost' => $blogpost,
            'categories' => Category::all(),
        ]);
    }

    public function update(Blogpost $blogpost, Request $request)
    {
        $formData = $this->validateBlogpostRequest($request);
        $formData['user_id'] = auth()->id();
        $formData['thumbnail'] = $this->storeThumbnail($request, $blogpost->thumbnail);
        $blogpost->update($formData);

        return redirect()->back()->with('success', 'Blog Updated Successfully!');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return redirect()->back()->withErrors(['old_password' => 'The old password is incorrect.'])->withInput();
        }

        auth()->user()->update([
            'password' => bcrypt($request->new_password),
        ]);
    }

    public function destroy(Blogpost $blogpost)
    {
        $blogpost->delete();

        return redirect('/blogposts#blogs');
    }

    private function validateBlogpostRequest(Request $request)
    {
        return $request->validate([
            'blogtitle' => ['required'],
            'blogbody' => ['required'],
            'read_duration' => ['required'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);
    }

    private function storeThumbnail(Request $request, $existingThumbnail = null)
    {
        if ($request->hasFile('thumbnail')) {
            return $request->file('thumbnail')->store('thumbnails');
        }
        return $existingThumbnail;
    }

    private function storeFilename()
    {
        $slug = Str::random(10);
        while (Blogpost::where('filename', $slug)->exists()) {
            $slug = Str::random(10);
        }
        return $slug;
    }

}

