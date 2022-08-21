<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(Category $category)
    {
        return view('posts.create-post', [
            'category' => $category
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'title'       => 'required|min:5|max:255',
            'body'        => 'required|min:20|max:3000',
            'category_id' => 'required|exists:categories,id'
        ]);

        $attributes['user_id'] = auth()->user()->id;

        Post::create($attributes);

        return redirect('/')->with('success', 'Post successfully created.');
    }

    public function edit(Post $post)
    {
        if (auth()->user()->id !== $post->user_id && auth()->user()->role == 3) {
            return back()->with('error', 'You cannot edit this post.');
        } else {
            return view('posts.edit-post', [
                'post' => $post
            ]);
        }
    }

    public function update(Post $post, Request $request)
    {
        $request->validate([
            'body'  => 'required|min:20|max:3000'
        ]);

        if (auth()->user()->role == 3 && $request->title != $request->old_title) {
            return back()->with('error', 'You cannot change the title of this post.');
        }

        if (auth()->user()->role < 3) {
            $request->validate([
                'title' => 'required|min:5|max:255',
            ]);

            $post->title = $request->title;
        }

        $post->body = $request->body;

        $post->save();

        return redirect('/posts/post/' . $post->id)->with('success', 'Post successfully updated.');
    }

    public function destroy(Post $post)
    {
        // check if the user is the owner of the post or if the user is a mod (role 2 or higher)
        if ($post->user_id == auth()->user()->id || auth()->user()->role < 3) {
            $post->delete();
            return redirect('/')->with('success', 'Post successfully deleted.');
        } else {
            return redirect('/')->with('error', 'You are not authorized to delete this post.');
        }
    }
}
