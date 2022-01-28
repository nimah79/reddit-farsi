<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $posts = Post::paginate(12);
        if ($posts->count() == 0) {
            abort(404);
        }
        return view('index', compact('posts'));
    }
}
