<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Like extends Model
{
    use HasFactory;

    public static $likeCount,$like;
    public static function likeCount($postId)
    {
        self::$like = new Like();
        self::$like->post_id  = $postId;
        self::$like->user_id  = Auth::user()->id;
        self::$like->save();
    }





}
