<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * @param Request $request
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function follow(Request $request, $user_id)
    {
        $user = User::where('id', $request->user()->id)->first();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'Opss. Usuário não foi encontrado, favor verifique se esta logado.'
            ]);
        }

        $userFollow = User::find($user_id);

        if (!$userFollow) {
            return response()->json([
                'error' => true,
                'message' => 'Opss. Usuário não foi encontrado.'
            ]);
        }

        if ($userFollow->id === $user->id) {
            return response()->json([
                'error' => true,
                'message' => 'Opss. Você não pode seguir você mesmo :)'
            ]);
        }

        $check = $user->followings()->where('user_id_to', $userFollow->id)->first();

        $message = null;

        if ($check) {
            $check->delete();
            $message = "Você parou de seguir com sucesso";
        } else {
            $user->followings()->create(['user_id_to' => $userFollow->id]);
            $message = "Você seguiu com sucesso";
        }

        return response()->json(["error" => false, "message" => $message]);
    }
}
