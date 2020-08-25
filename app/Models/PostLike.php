<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    protected $table = 'posts_likes';
    protected $fillable = ['user_id'];

    public function likes_count($post_id)
    {
        return $this->where('post_id', $post_id)->count();
    }

    public function post_like_owner($post_id)
    {
        return $this->where('post_id', $post_id)->where('user_id', auth()->user()->id)->count() > 0 ? true : false;
    }
}
