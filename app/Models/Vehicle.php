<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'user_id',
        'user_id',
        'tag_id',
        'zipcode',
        'city',
        'city_url',
        'uf',
        'uf_url',
        'vehicle_type',
        'vehicle_brand',
        'vehicle_model',
        'vehicle_version',
        'vehicle_regdate',
        'vehicle_gearbox',
        'vehicle_fuel',
        'vehicle_steering',
        'vehicle_motorpower',
        'vehicle_doors',
        'vehicle_color',
        'vehicle_cubiccms',
        'vehicle_owner',
        'vehicle_mileage',
        'vehicle_features',
        'vehicle_moto_features',
        'vehicle_financial',
        'vehicle_price',
        'title',
        'description',
        'status',
    ];

    protected $casts = [
        'vehicle_features' => Json::class,
        'vehicle_financial' => Json::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicle_photos()
    {
        return $this->hasMany(VehiclePhotos::class, 'vehicle_id', 'id')->orderBy('order', 'ASC');
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',            
            'zipcode' => 'required',            
            'city' => 'required',            
            'uf' => 'required',            
            'vehicle_type' => 'required',
            'vehicle_brand' => 'required',
            'vehicle_model' => 'required',
            'vehicle_version' => 'required',
            'vehicle_gearbox' => 'required',
            'vehicle_fuel' => 'required',
            'vehicle_steering' => 'required',
            'vehicle_motorpower' => 'required',
            'vehicle_doors' => 'required',
            'vehicle_regdate' => 'required',
            'vehicle_color' => 'required',
            'vehicle_mileage' => 'required',
            'vehicle_price' => 'required',
        ];
    }

    public function cover() 
    {
        return $this->hasOne(VehiclePhotos::class, 'vehicle_id', 'id')->orderBy('order', 'ASC');
    }

    public function vehicle_brand()
    {
        return $this->hasOne(VehicleBrand::class, 'value', 'vehicle_brands');
    }

    public function vehicle_model()
    {
        return VehicleModel::where('value', $this->vehicle_model)
                            ->where('brand_id', $this->vehicle_brand)
                            ->first();
    }

    public function vehicle_version()
    {
        return VehicleVersion::where('value', $this->vehicle_version)
                            ->where('brand_id', $this->vehicle_brand)
                            ->where('model_id', $this->vehicle_model->value)
                            ->first();
    }

    public function vehicle_color()
    {
        return $this->hasOne(VehicleCarcolor::class, 'value', 'vehicle_carcolors');
    }

    public function vehicle_fuel()
    {
        return $this->hasOne(VehicleFuel::class, 'value', 'vehicle_fuels');
    }

    public function vehicle_gearbox()
    {
        return $this->hasOne(VehicleGearbox::class, 'value', 'vehicle_gearboxes');
    }
}
