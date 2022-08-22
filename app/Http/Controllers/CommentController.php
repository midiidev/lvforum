<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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

    /**
     * Make sure the user is authorised to do this,
     * then delete the specified comment from the database.
     *
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Comment $comment)
    {
        // check if the user is the owner of the post or if the user is a mod (role 2 or higher)
        if ($comment->user_id == auth()->user()->id || auth()->user()->role < 3) {
            $comment->delete();
            return back()->with('success', 'Comment successfully deleted.');
        } else {
            return back()->with('error', 'You are not authorised to delete this comment.');
        }
    }
}
