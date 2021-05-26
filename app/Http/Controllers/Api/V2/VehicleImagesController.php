<?php

namespace App\Http\Controllers\Api\V2;

use App\Models\VehiclePhotos;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class VehicleImagesController extends Controller
{
    protected $model;
    protected $column = "id";
    protected $direction = "asc";
    
    public function __construct(VehiclePhotos $model)
    {
        $this->model = $model;
    }

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

    public function destroy($id)
    {
        $result = $this->model->findOrFail($id);

        $path = 'vehicles/'.auth()->user()->id.'/'.$result->vehicle_id.'/'.$result->image;
        if(Storage::exists($path)) {
            Storage::delete($path);
        }

        $result->delete();

        return response()->json(['message' => 'Deletado com sucesso'], 200);
    }
}
