<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isAdmin = Auth::user()->is_admin;
        if($isAdmin) {
            $comments = Comment::with('post')->orderBy('id', 'desc')->paginate(10);
        } else {
            $userId = Auth::user()->id;
            $comments = Comment::with('post')->orderBy('id', 'desc')->where('user_id', '=', $userId)->paginate(10);
        }

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if($comment->user_id != auth()->user()->id && auth()->user()->is_admin == false) {
            flash()->overlay("You can't delete other peoples comment.");
            return redirect('/admin/posts');
        }

        $comment->delete();
        flash()->overlay('Comment deleted successfully.');

        return redirect('/admin/comments');
    }

}
