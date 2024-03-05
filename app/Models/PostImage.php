<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;
    public static $image,$imageUrl,$imagePath,$imageName;
    public static function storeImages($postId,$images)
    {
        foreach ($images as $image){
            self::$imageUrl = self::getImageUrl($image);
            self::$image = new PostImage();
            self::$image->post_id = $postId;
            self::$image->image = self::$imageUrl;
            self::$image->save();
        }

    }

    public static function getImageUrl($image)
    {
        self::$imageName = $image->getClientOriginalName();
        self::$imagePath = 'uploads/post/';
        $image->move(self::$imagePath,self::$imageName);
        self::$imageUrl = self::$imagePath.self::$imageName;
        return self::$imageUrl;
    }

}
