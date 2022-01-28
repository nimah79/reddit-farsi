<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $posts = Post::with(['community', 'user'])->paginate(12);
        return view('index', compact('posts'));
    }
}