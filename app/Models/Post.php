<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    public static $post;

    public static function storePost($request)
    {
        self::$post = new Post();
        self::$post->title = $request->title;
        self::$post->description = $request->description;
        self::$post->user_id = Auth::user()->id;
        self::$post->save();
        return self::$post;
    }

    public function postImage() : HasMany
    {
        return $this->hasMany(PostImage::class);
    }

    public function likeCount() : HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function comment() : HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
