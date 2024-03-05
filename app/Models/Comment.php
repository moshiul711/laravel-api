<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;
    public static $comment;
    public static function storeComment($request,$post_id)
    {
        self::$comment = new Comment();
        self::$comment->post_id = $post_id;
        self::$comment->user_id = Auth::user()->id;
        self::$comment->comment = $request->comment;
        self::$comment->save();
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
