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

    /**
     * @return bool
     */
    public function getPostOwnerAttribute()
    {
        return $this->user_id === auth()->user()->id;
    }

    /**
     * @return bool
     */
    public function getPostOwnerLikeAttribute()
    {
        return (new PostLike())->post_like_owner($this->id);
    }

    /**
     * @return mixed
     */
    public function getLikesCountAttribute()
    {
        return (new PostLike())->likes_count($this->id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }

    /**
     * @param $query
     * @param string $type
     * @return mixed
     */
    public function scopeType($query, $type = 'text')
    {
        return $query->where('type', $type);
    }
}
