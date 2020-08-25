<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['body', 'type'];

    /**
     * @var array
     */
    protected $appends = ['body_url','post_owner','post_owner_like'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return string|null
     */
    public function getBodyUrlAttribute()
    {
        if ($this->type === 'photo') {
            return url('media/uploads') . '/' . $this->body;
        }
        return null;
    }

    public function getPostOwnerAttribute()
    {
        return $this->user_id === auth()->user()->id;
    }

    public function getPostOwnerLikeAttribute()
    {
        return (new PostLike())->post_like_owner($this->id);
    }

    public function getLikesCountAttribute()
    {
        return (new PostLike())->likes_count($this->id);
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }

    public function scopeType($query, $type = 'text')
    {
        return $query->where('type', $type);
    }
}
