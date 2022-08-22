<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display posts either in all categories or in a specific category.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->first();

            // if non-existent category is set, throw a 404 error
            if (!$category) {
                abort(404);
            }

            return view('home', [
                'posts' => Post::latest()->with('user', 'comments')
                    ->where('category_id', $category->id)
                    ->paginate(10)
                    ->withQueryString(),
                'categories' => Category::all(),
                'category' => $category
            ]);
        } else {
            return view('home', [
                'posts' => Post::latest()->with('category', 'user', 'comments')
                    ->paginate(10)
                    ->withQueryString(),
                'categories' => Category::all()
            ]);
        }
    }

    /**
     * Show the page for creating a post.
     *
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Category $category)
    {
        return view('posts.create-post', [
            'category' => $category
        ]);
    }

    /**
     * Store a newly created post in the database.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title'       => 'required|min:5|max:255',
            'body'        => 'required|min:20|max:3000',
            'category_id' => 'required|exists:categories,id'
        ]);

        $attributes['user_id'] = auth()->user()->id;

        Post::create($attributes);

        return redirect('/')->with('success', 'Post successfully created.');
    }

    /**
     * Show the page for editing a post if a user is authorised to do so,
     * otherwise redirect back.
     *
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
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

    /**
     * Update the specified post in the database,
     * with extra checks to make sure the user is authorised to do so.
     *
     * @param Post $post
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

    /**
     * Delete the specified post from the database.
     *
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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
