<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::filter(request(['search', 'category', 'sortBy']))
                ->paginate(6)
                ->withQueryString(),

        ]);
    }

    public function show(Post $post)
    {
        $viewed = Session::get('viewed_post', []);
        if (!in_array($post->id, $viewed)) {
            $post->counter();
            Session::push('viewed_post', $post->id);
        }
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $categories = Category::pluck('id')->toArray();
        $validated = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'excerpt' => 'required|max:255',
            'body' => 'required|max:255',
            'category' => Rule::in($categories)

        ]);

        if (auth()->user()) {

            if ($request->file('thumbnail')) {
                $file = $request->file('thumbnail');
                $thumbnail = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('/images'), $thumbnail);
            }
            $post = Post::create([
//                'user_id' => 1,
                'user_id' => auth()->id(),
                'category_id' => $request->category,
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'excerpt' => $request->excerpt,
                'body' => $request->body,
                'thumbnail' => $thumbnail ?? NULL,
            ]);

            return redirect('/')->with('success', 'Post je kreiran!');
        } else {
            return back()->with('error', 'Nemate dozvolu da kreirate post!');

        }
    }

    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('posts.edit', compact(['post', 'categories']));
    }

    public function update(Request $request, Post $post)
    {
        if (auth()->user()) {

            if ($request->file('thumbnail')) {
                $file = $request->file('thumbnail');
                $thumbnail = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('/images'), $thumbnail);
            }

            $post->update([
                'user_id' => auth()->id(),
                'category_id' => $request->category,
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'excerpt' => $request->excerpt,
                'body' => $request->body,
                'thumbnail' => $thumbnail ?? $post->thumbnail,
            ]);
            return redirect('/')->with('success', 'Post je izmenjen');
        } else {
            return back()->with('error', 'Nemate dozvolu da vršite izmene!');
        }
    }

    public function destroy(Post $post)
    {
        if (auth()->user()->isAdmin()) {
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post je uspešno obrisan');
        } else {
            return back()->with('error', 'Nemate dozvolu za brisanje!');
        }
    }

}
