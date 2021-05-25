<?php

namespace App\Http\Controllers\Api\V2;

use App\Models\Vehicle;
use App\Models\VehicleFuel;
use App\Models\VehicleType;
use App\Models\VehicleDoors;
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
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class VehicleImagesController extends Controller
{
    public function upload(\Illuminate\Http\Request $request)
    {
        $file = $request->file('file');
        $fileName = md5(uniqid(time())). strrchr($file->getClientOriginalName(), '.');
        $result = auth()->user()->vehicles()->findOrFail($request->vehicle_id);

        if(!$result) {
            return response()->json(['error' => 'Veiculo não encontrado']);
        }

        if($request->hasFile('file') && $file->isValid()){
            $photo = VehiclePhotos::create([
                'user_id' => auth()->user()->id,
                'vehicle_id' => $request->vehicle_id,
                'image' => $fileName
            ]);

            if($photo->id) {
                $img = Image::make($request->file)->orientate();
                $img->resize(1000, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                Storage::put('vehicles/'.auth()->user()->id.'/'.$photo->vehicle_id.'/'.$fileName, $img->encode(), 'public');

                return response()->json(['error' => false, 'data' => $photo]);
            }

            return response()->json(['error' => true, 'message' => 'Erro ao cadastrar imagem']);
        }
    }
}
