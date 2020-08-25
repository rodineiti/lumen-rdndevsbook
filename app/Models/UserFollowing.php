<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFollowing extends Model
{
    protected $table = 'users_following';
    protected $fillable = ['user_id_to'];

    public function checkFollow($user_id_to)
    {
        return $this->where('user_id_from', auth()->user()->id)
            ->where('user_id_to', $user_id_to)->count() > 0 ? true : false;
    }

    public function following()
    {
        return $this->belongsTo(
            User::class,
            'user_id_to',
            'id'
        );
    }

    public function follower()
    {
        return $this->belongsTo(
            User::class,
            'user_id_from',
            'id'
        );
    }
}
