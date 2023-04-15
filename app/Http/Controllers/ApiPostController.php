<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ApiPostController extends Controller
{
    public function index()
    {
        $posts = Post::filter(request(['search', 'category', 'sortBy']))
            ->paginate(6)
            ->withQueryString();

        return response()->json([
            'title' => $posts
        ]);
    }

    public function store(Request $request)
    {
        $categories = Category::pluck('id')->toArray();
        $validate = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'excerpt' => 'required|max:255',
            'body' => 'required|max:255',
            'user_id' => 'required',
            'slug' => 'required|max:50',
            'category_id' => Rule::in($categories)
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validate->messages()
            ], 422);
        } else {
            $post = Post::create([
                'title' => $request->title,
                'excerpt' => $request->excerpt,
                'body' => $request->body,
                'category_id' => $request->category,
                'user_id' => $request->user_id,
                'slug' => $request->slug
            ]);
            if ($post) {
                return response()->json([
                    'status' => 200,
                    'message' => "Uspesno"
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Neuspesno"
                ], 500);
            }
        }
    }
}
