<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create-post');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required|min:5|max:255',
            'body'  => 'required|min:20|max:3000'
        ]);

        $attributes['user_id'] = auth()->user()->id;

        Post::create($attributes);

        return redirect('/')->with('success','Post successfully created.');
    }
}
