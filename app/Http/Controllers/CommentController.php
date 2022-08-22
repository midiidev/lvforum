<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in the database.
     *
     * @param Post $post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Post $post, Request $request)
    {
        $request->validate([
            'comment-body' => 'required|min:10'
        ]);

        $post->comments()->create([
            'body'    => $request->{'comment-body'},
            'user_id' => auth()->user()->id
        ]);

        return back()->with('success', 'Comment posted successfully');
    }
}
