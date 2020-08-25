<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    /**
     * @var string
     */
    protected $table = 'posts_likes';
    /**
     * @var array
     */
    protected $fillable = ['user_id'];

    /**
     * @param $post_id
     * @return mixed
     */
    public function likes_count($post_id)
    {
        return $this->where('post_id', $post_id)->count();
    }

    /**
     * @param $post_id
     * @return bool
     */
    public function post_like_owner($post_id)
    {
        return $this->where('post_id', $post_id)->where('user_id', auth()->user()->id)->count() > 0 ? true : false;
    }
}
