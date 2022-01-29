<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function showCreateForm(Post $post)
    {
        return view('posts.create');
    }

    public function create(Request $request)
    {
        $attributes = $request->validate([
            'community_id' => ['required', 'exists:communities,id'],
            'title' => ['required'],
            'body' => ['required'],
        ]);

        $attributes['user_id'] = auth()->user()->id;

        Post::create($attributes);

        return redirect('/');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function delete(Post $post)
    {
        if (!$post->community->admins()->whereUserId(auth()->user()->id)->exists()) {
            abort(403);
        }
        $post->delete();

        return redirect()->back();
    }
}
