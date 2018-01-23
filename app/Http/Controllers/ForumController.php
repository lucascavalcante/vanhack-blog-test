<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Show the list of posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::when($request->search, function($query) use($request) {
            $search = $request->search;
            return $query->where('title', 'like', "%$search%")
                ->orWhere('body', 'like', "%$search%");
        })->with('tags', 'category', 'user')
            ->withCount('comments')
            ->published()
            ->simplePaginate(5);

        return view('frontend.index', compact('posts'));
    }

    /**
     * Show a post.
     *
     * @return \Illuminate\Http\Response
     */
    public function post(Post $post)
    {
        $post = $post->load(['comments.user', 'tags', 'user', 'category']);

        return view('frontend.post', compact('post'));
    }

    /**
     * Add a comment in a post.
     *
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request, Post $post)
    {
        $this->validate($request, ['body' => 'required']);

        $post->comments()->create([
            'body' => $request->body
        ]);
        flash()->overlay('Comment successfully created');

        return redirect("/posts/{$post->id}");
    }

    /**
     * Show the list of post from specific category.
     *
     * @return \Illuminate\Http\Response
     */
    public function postsByCategory($category)
    {
        $posts = Post::with('tags', 'category', 'user')
            ->where('category_id', '=', $category)
            ->withCount('comments')
            ->published()
            ->simplePaginate(5);

        return view('frontend.index', compact('posts'));
    }
}
