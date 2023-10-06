<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(Request $request)
{
    $search = $request->input('searchcategory');
    
    $categories = Category::when($search, function ($query) use ($search) {
        $query->where('name', 'LIKE', '%' . $search . '%');
    })->get();

    return view('category.create', compact('categories'));
}

    
    public function store(Category $category)
    {
        $formData=request()->validate([
            'name'=>['required']
        ]);
        $slug = Str::random(10);

    while (Category::where('filename', $slug)->exists()) {
        $slug = Str::random(10);
    }

    $formData['filename'] = $slug;
 
  
     Category::create($formData); 
    return back();
    }
    public function edit(string $id)
    {
        $category=Category::find($id);
        $categories=Category::all();
        return view('category.create',compact('category','categories'));
    }
    public function update(Request $request, string $id)
    {
        $category=Category::find($id);
        $formData=$request->validate([
            'name'=>['required']
        ]);
        $category->name=$formData['name'];
        $category->save();
        return back();
    }
    public function destroy(string $id)
    {
        $category=Category::find($id);
        $category->delete();
        return back();
    }
  
}
