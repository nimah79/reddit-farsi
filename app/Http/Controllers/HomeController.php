<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $q = $request->query('q') ?? $request->q;
        if ($q) {
            $q = strip_tags($q);
        }
        $sortType = $request->query('sort') ?? $request->sort ?? 'created_at';
        if (!in_array($sortType, ['created_at', 'comments_count', 'likes_count'])) {
            $sortType = 'created_at';
        }
        $posts = Post::orderBy($sortType, 'desc')->orderBy('id', 'desc');
        if ($q) {
            $posts = $posts->join('users', 'posts.user_id', '=', 'users.id')
                ->join('communities', 'posts.community_id', '=', 'communities.id')
                ->where('title', 'like', '%' . $q . '%')
                ->orWhere('body', 'like', '%' . $q . '%')
                ->orWhere('users.username', 'like', '%' . $q . '%')
                ->orWhere('communities.name', 'like', '%' . $q . '%');
        }
        $posts = $posts->paginate(12)->withQueryString();
        if ($posts->count() == 0) {
            abort(404);
        }

        return view('index', compact('posts', 'sortType', 'q'));
    }
}
