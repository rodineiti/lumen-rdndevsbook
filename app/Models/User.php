<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Laravel\Passport\HasApiTokens;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use HasApiTokens, Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'birthdate', 'city', 'work', 'avatar', 'cover'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @var array
     */
    protected $appends = ['avatar_url','cover_url','birthdate_age','photos_count'];

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        if (!is_null($value)) {
            $this->attributes['password'] = app("hash")->make($value);
        }
    }

    /**
     * @return string|null
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return url('media/avatars') . '/' . $this->avatar;
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getCoverUrlAttribute()
    {
        if ($this->cover) {
            return url('media/covers') . '/' . $this->cover;
        }
        return null;
    }

    /**
     * @return int|null
     */
    public function getBirthdateAgeAttribute()
    {
        if ($this->birthdate) {
            try {
                $from = new \DateTime($this->birthdate);
                $to = new \DateTime('today');
                return $from->diff($to)->y;
            } catch (\Exception $exception) {
                return null;
            }
        }
        return null;
    }

    /**
     * @return mixed
     */
    public function getPhotosCountAttribute()
    {
        return $this->posts()->type('photo')->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function oauthAccessToken()
    {
        return $this->hasMany('\App\Models\OauthAccessToken');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function followings()
    {
        return $this->hasMany(
            UserFollowing::class,
            'user_id_from',
            'id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function followers()
    {
        return $this->hasMany(
            UserFollowing::class,
            'user_id_to',
            'id'
        );
    }
}
