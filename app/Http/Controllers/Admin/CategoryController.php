<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name'        => 'required|min:1|max:255',
            'slug'        => 'required|unique:categories,slug|min:1|max:255',
            'description' => 'max:255',
            'icon'        => 'max:255'
        ]);

        Category::create($attributes);

        return back()->with('success', 'Successfully created new category.');
    }

    /**
     * Delete a category
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $c = $request->validate([
            'category' => 'required|exists:categories,slug'
        ]);

        Category::where('slug', $c)->firstOrFail()->delete();

        return back()->with('success', 'Successfully deleted category.');
    }
}
