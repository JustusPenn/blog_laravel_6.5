<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        // dd($posts);
        return view('blog.index', compact('posts'));
    }
    
    public function getProfile($username)
    {
        $user = User::where('username', $username)->first();
        return view('user.profile', compact('user'));
    }

    public function showPost($id)
    {
        $post = Post::whereId($id)->first();
        return view('blog.show', compact('post'));
    }
}
