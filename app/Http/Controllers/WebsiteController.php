<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(2);
        return view('post.index',compact('posts'));
    }

    public function like($post_id)
    {
        Like::likeCount($post_id);
        return redirect('/')->with('message','You liked a post..');
    }

    public function comment(Request $request, $post_id)
    {
        Comment::storeComment($request,$post_id);
        return redirect('/')->with('message','You comment on a post..');
    }
}
