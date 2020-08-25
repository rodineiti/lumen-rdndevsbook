<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserFollowing;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function byUser(Request $request, $user_id)
    {
        $limit = $request->limit ?? self::LIMIT;

        $user = User::where('id', $request->user()->id)->first();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'Opss. Usuário não foi encontrado, favor verifique se esta logado.'
            ]);
        }

        $user = User::with([
            'posts' => function ($query) use ($limit) {
                $query->with([
                    'comments' => function ($query) {
                        $query->with('user');
                    }
                ])->type()->paginate($limit);
            },
            'photos' => function ($query) use ($limit) {
                $query->with([
                    'comments' => function ($query) {
                        $query->with('user');
                    }
                ])->type('photo')->paginate($limit);
            },
            'followings' => function ($query) use ($limit) {
                $query->with('following');
            },
            'followers' => function ($query) use ($limit) {
                $query->with('follower');
            }
        ])->where('id', $user_id)->first();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'Opss. Usuário não foi encontrado.'
            ]);
        }

        $isFollowing = (new UserFollowing())->checkFollow($user->id);

        return response()->json(["user" => $user, "isFollowing" => $isFollowing]);
    }
}
