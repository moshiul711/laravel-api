<?php

namespace App\Http\Controllers\Task\Post;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $post,$images;

    public function index()
    {
        return view('post.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->post = Post::storePost($request);
        $like = Like::likeCount($this->post->id);
//        $comment = Post::storePost($request);
        if ($request->file('images'))
        {
            $this->images = PostImage::storeImages($this->post->id,$request->file('images'));
        }
        return redirect('/')->with('message','Post Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
