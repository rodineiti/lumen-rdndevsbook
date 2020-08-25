<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserFollowing;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('id', $request->user()->id)->first();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'Opss. Usuário não foi encontrado, favor verifique se esta logado.'
            ]);
        }

        $term = $request->term ?? null;

        if ($term) {
            $users = User::where('name', 'LIKE', '%' . $term . '%')->get();
            if (!$users) {
                return response()->json([
                    'error' => true,
                    'message' => 'Opss. Nenhum registro encontrado para o termo: {$term}.'
                ]);
            }
            return response()->json($users);
        }

        return response()->json([
            'error' => true,
            'message' => 'Opss. Nenhum registro encontrado.'
        ]);
    }
}
