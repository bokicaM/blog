<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(5);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        if (auth()->user()) {
            $category = Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);

            return redirect('/categories')->with('success', 'Category has been created!');
        } else {
            return back()->with('error', 'You have no permission to create!');
        }
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {

        $validated = $request->validate([
            'name' => ['email' => 'required', Rule::unique('categories')->ignore($category)]
        ]);
        if (auth()->user()) {
            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);
            return redirect('/categories')->with('success', 'Category updated');
        } else {
            return back()->with('error', 'You have no permission to update!');
        }
    }

    public function destroy(Category $category)
    {
        if (auth()->user()->isAdmin()) {
            if ($category->posts->count() > 0) {
                return redirect()->route('categories.index')->with('error', 'You have to delete child rows first');
            } else
                $category->delete();
            return redirect()->route('categories.index')->with('success', 'Category has been deleted successfully');
        } else {
            return back()->with('error', 'You have no permission to delete!');
        }
    }

}
