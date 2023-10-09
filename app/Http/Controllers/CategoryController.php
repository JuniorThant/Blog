<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        $categories = Category::getFilteredCategories($request->input('searchcategory'));

        return view('category.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $formData = $request->validate([
            'name' => ['required'],
        ]);

        $slug = $this->generateUniqueSlug();

        Category::create([
            'name' => $formData['name'],
            'filename' => $slug,
        ]);

        return back();
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::all();

        return view('category.create', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $formData = $request->validate([
            'name' => ['required'],
        ]);

        $category->name = $formData['name'];
        $category->save();

        return back();
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return back();
    }

    private function generateUniqueSlug()
    {
        $slug = Str::random(10);

        while (Category::where('filename', $slug)->exists()) {
            $slug = Str::random(10);
        }

        return $slug;
    }
}

