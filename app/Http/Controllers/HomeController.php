<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isAdmin = Auth::user()->is_admin;
        if($isAdmin) {
            $posts      = Post::count();
            $comments   = Comment::count();
            $tags       = Tag::count();
            $categories = Category::count();
        } else {
            $userId = Auth::user()->id;
            $posts      = Post::where('user_id', '=', $userId)->count();
            $comments   = Comment::where('user_id', '=', $userId)->count();
        }

        return view('home', get_defined_vars());
    }
}
