<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehiclePhotos extends Model
{
    protected $fillable = ['user_id','vehicle_id','image','order'];

    /**
     * @var array
     */
    protected $appends = ['image_url'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * @return string|null
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return url('media/vehicles/'.auth()->user()->id.'/'.$this->vehicle_id) . '/' . $this->image;
        }
        return null;
    }
}
