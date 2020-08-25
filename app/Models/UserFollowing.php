<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFollowing extends Model
{
    /**
     * @var string
     */
    protected $table = 'users_following';
    /**
     * @var array
     */
    protected $fillable = ['user_id_to'];

    /**
     * @param $user_id_to
     * @return bool
     */
    public function checkFollow($user_id_to)
    {
        return $this->where('user_id_from', auth()->user()->id)
            ->where('user_id_to', $user_id_to)->count() > 0 ? true : false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function following()
    {
        return $this->belongsTo(
            User::class,
            'user_id_to',
            'id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function follower()
    {
        return $this->belongsTo(
            User::class,
            'user_id_from',
            'id'
        );
    }
}
