<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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

    public function addComment(Post $post, Request $request)
    {
        $rules = [
            'comment' => ['required'],
        ];

        if ($request->parent_id) {
            $rules['parent_id'] = ['required', 'numeric', 'exists:comments,id'];
        }

        $attributes = $request->validate($rules);

        $commentAttributes = [
            'user_id' => auth()->user()->id,
            'body' => $attributes['comment'],
        ];

        if (!empty($attributes['parent_id'])) {
            $commentAttributes['parent_id'] = $attributes['parent_id'];
        }

        $post->comments()->create($commentAttributes);

        return back();
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

    public function likeComment(Comment $comment)
    {
        $userId = auth()->user()->id;
        if ($dislike = $comment->dislikes()->whereUserId($userId)->first()) {
            $dislike->delete();
            $comment->likes()->create(['user_id' => $userId]);
            $comment->refresh();
            $result = [
                'liked' => true,
                'disliked' => false,
                'likes_count' => to_persian_digits($comment->likes_count),
                'dislikes_count' => to_persian_digits($comment->dislikes_count),
            ];
        } elseif ($like = $comment->likes()->whereUserId($userId)->first()) {
            $like->delete();
            $comment->refresh();
            $result = [
                'liked' => false,
                'disliked' => false,
                'likes_count' => to_persian_digits($comment->likes_count),
                'dislikes_count' => to_persian_digits($comment->dislikes_count),
            ];
        } else {
            $comment->likes()->create(['user_id' => $userId]);
            $comment->refresh();
            $result = [
                'liked' => true,
                'disliked' => false,
                'likes_count' => to_persian_digits($comment->likes_count),
                'dislikes_count' => to_persian_digits($comment->dislikes_count),
            ];
        }

        return response()->json($result);
    }

    public function dislikeComment(Comment $comment)
    {
        $userId = auth()->user()->id;
        if ($like = $comment->likes()->whereUserId($userId)->first()) {
            $like->delete();
            $comment->dislikes()->create(['user_id' => $userId]);
            $comment->refresh();
            $result = [
                'disliked' => true,
                'liked' => false,
                'dislikes_count' => to_persian_digits($comment->dislikes_count),
                'likes_count' => to_persian_digits($comment->likes_count),
            ];
        } elseif ($dislike = $comment->dislikes()->whereUserId($userId)->first()) {
            $dislike->delete();
            $comment->refresh();
            $result = [
                'disliked' => false,
                'liked' => false,
                'dislikes_count' => to_persian_digits($comment->dislikes_count),
                'likes_count' => to_persian_digits($comment->likes_count),
            ];
        } else {
            $comment->dislikes()->create(['user_id' => $userId]);
            $comment->refresh();
            $result = [
                'disliked' => true,
                'liked' => false,
                'dislikes_count' => to_persian_digits($comment->dislikes_count),
                'likes_count' => to_persian_digits($comment->likes_count),
            ];
        }

        return response()->json($result);
    }

    public function toggleBookmark(Post $post)
    {
        $userId = auth()->user()->id;
        if ($bookmark = $post->savedPosts()->whereUserId($userId)->first()) {
            $bookmark->delete();
        } else {
            $post->savedPosts()->create(['user_id' => $userId]);
        }

        return back();
    }

    public function delete(Post $post)
    {
        if (!$post->community->admins()->whereUserId(auth()->user()->id)->exists()) {
            abort(403);
        }
        $post->delete();

        return redirect()->back();
    }

    public function bookmarks(Request $request)
    {
        $q = $request->query('q') ?? $request->q;
        if ($q) {
            $q = strip_tags($q);
        }
        $posts = Post::join('saved_posts', 'posts.id', '=', 'saved_posts.post_id')
            ->select('posts.*')
            ->where('saved_posts.user_id', auth()->user()->id)
            ->orderBy('id', 'desc');
        if ($q) {
            $posts = $posts->join('users', 'posts.user_id', '=', 'users.id')
                ->join('communities', 'posts.community_id', '=', 'communities.id')
                ->where('title', 'like', '%' . $q . '%')
                ->orWhere('body', 'like', '%' . $q . '%')
                ->orWhere('users.username', 'like', '%' . $q . '%')
                ->orWhere('communities.name', 'like', '%' . $q . '%');
        }
        $posts = $posts->paginate(12)->withQueryString();

        return view('bookmarks', compact('posts', 'q'));
    }
}
