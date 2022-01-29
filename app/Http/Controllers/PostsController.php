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

    public function like(Post $post)
    {
        $userId = auth()->user()->id;
        if ($dislike = $post->dislikes()->whereUserId($userId)->first()) {
            $dislike->delete();
            $post->likes()->create(['user_id' => $userId]);
            $post->refresh();
            $result = [
                'liked' => true,
                'disliked' => false,
                'likes_count' => to_persian_digits($post->likes_count),
                'dislikes_count' => to_persian_digits($post->dislikes_count),
            ];
        } elseif ($like = $post->likes()->whereUserId($userId)->first()) {
            $like->delete();
            $post->refresh();
            $result = [
                'liked' => false,
                'disliked' => false,
                'likes_count' => to_persian_digits($post->likes_count),
                'dislikes_count' => to_persian_digits($post->dislikes_count),
            ];
        } else {
            $post->likes()->create(['user_id' => $userId]);
            $post->refresh();
            $result = [
                'liked' => true,
                'disliked' => false,
                'likes_count' => to_persian_digits($post->likes_count),
                'dislikes_count' => to_persian_digits($post->dislikes_count),
            ];
        }

        return response()->json($result);
    }

    public function dislike(Post $post)
    {
        $userId = auth()->user()->id;
        if ($like = $post->likes()->whereUserId($userId)->first()) {
            $like->delete();
            $post->dislikes()->create(['user_id' => $userId]);
            $post->refresh();
            $result = [
                'disliked' => true,
                'liked' => false,
                'dislikes_count' => to_persian_digits($post->dislikes_count),
                'likes_count' => to_persian_digits($post->likes_count),
            ];
        } elseif ($dislike = $post->dislikes()->whereUserId($userId)->first()) {
            $dislike->delete();
            $post->refresh();
            $result = [
                'disliked' => false,
                'liked' => false,
                'dislikes_count' => to_persian_digits($post->dislikes_count),
                'likes_count' => to_persian_digits($post->likes_count),
            ];
        } else {
            $post->dislikes()->create(['user_id' => $userId]);
            $post->refresh();
            $result = [
                'disliked' => true,
                'liked' => false,
                'dislikes_count' => to_persian_digits($post->dislikes_count),
                'likes_count' => to_persian_digits($post->likes_count),
            ];
        }

        return response()->json($result);
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
