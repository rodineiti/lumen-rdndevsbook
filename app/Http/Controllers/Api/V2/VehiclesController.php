<?php

namespace App\Http\Controllers\Api\V2;

use App\Models\Vehicle;
use App\Models\VehicleFuel;
use App\Models\VehicleType;
use App\Models\VehicleDoor;
use App\Models\VehicleBrand;
use App\Models\VehicleModel;
use App\Models\VehicleVersion;
use App\Models\VehiclePhotos;
use App\Models\VehicleRegdate;
use App\Models\VehicleGearbox;
use App\Models\VehicleFeatures;
use App\Models\VehicleCarcolor;
use App\Models\VehicleExchange;
use App\Models\VehicleCubiccms;
use App\Models\VehicleFinancial;
use App\Models\VehicleMotorpower;
use App\Models\VehicleCarSteering;

use App\Traits\ApiAuthTraitCrud;
use App\Http\Controllers\Controller;

class VehiclesController extends Controller
{
    use ApiAuthTraitCrud;

    protected $model;
    protected $column = "id";
    protected $direction = "asc";
    protected $rules;
    protected $relations = "vehicles";
    protected $relationships = ['vehicle_photos'];

    public function __construct(Vehicle $model)
    {
        $this->model = $model;
        $this->rules = $this->model->rules();
    }

    public function getCombo()
    {
        return response()->json(['error' => false, 'data' => $this->getData()]);
    }

    private function getData()
    {
        return [
            'vehicle_types' => VehicleType::all(),
            'regdate' => VehicleRegdate::orderBy('label', 'ASC')->get(),
            'gearbox' => VehicleGearbox::all(),
            'fuel' => VehicleFuel::all(),
            'car_steering' => VehicleCarSteering::all(),
            'motorpower' => VehicleMotorpower::all(),
            'doors' => VehicleDoor::all(),
            'features' => VehicleFeatures::all(),
            'carcolor' => VehicleCarcolor::all(),
            'exchange' => VehicleExchange::all(),
            'financial' => VehicleFinancial::all(),
            'cubiccms' => VehicleCubiccms::all(),
        ];
    }

    public function brand($vehicle_type)
    {
        $vehicle_brand = VehicleBrand::where('vehicle_type_id', $vehicle_type)
                            ->get();
                            
        return response()->json(['error' => false, 'data' => $vehicle_brand]);
    }

    public function model($vehicle_type, $vehicle_brand)
    {
        $vehicle_model = VehicleModel::where('vehicle_type_id', $vehicle_type)
                            ->where('brand_id', $vehicle_brand)
                            ->orderBy('label')
                            ->get();

        return response()->json(['error' => false, 'data' => $vehicle_model]);
    }

    public function version($vehicle_brand, $vehicle_model)
    {
        $vehicle_version = VehicleVersion::where('brand_id', $vehicle_brand)
                            ->where('model_id', $vehicle_model)
                            ->orderBy('label')
                            ->get();
                        
        return response()->json(['error' => false, 'data' => $vehicle_version]);
    }
}
