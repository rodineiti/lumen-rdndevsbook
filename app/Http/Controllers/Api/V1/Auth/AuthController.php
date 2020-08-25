<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required','string','min:5','max:255'],
            'email' => ['required','string','email','unique:users'],
            'password' => ['required','string','min:6','confirmed'],
            'birthdate' => ['required','date']
        ]);

        try {
            $data = $request->only('name','email','password','birthdate');

            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = $data['password'];
            $user->birthdate = $data['birthdate'];
            $user->save();

            $request = Request::create('oauth/token', 'POST', [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'aClECVmq39o6ToTutTPdfUleMRYWll6AIk2RvHG6',
                'username' => $data['email'],
                'password' => $data['password'],
            ]);

            $response = app()->handle($request);
            return response()->json(json_decode($response->getContent()));
        } catch (\Exception $exception) {
            return response()->json(["error" => true, "message" => $exception->getMessage()], 400);
        }
    }

    public function updateProfile(Request $request)
    {
        $user = User::where('id', $request->user()->id)->first();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'Opss. Usuário não foi encontrado, favor verifique se esta logado.'
            ]);
        }

        $this->validate($request, [
            'name' => ['required','string','min:5','max:255'],
            'email' => ['required','string','email','unique:users,email,'.$user->id],
            'birthdate' => ['required','date']
        ]);

        if (isset($request->password) && !is_null($request->password)) {
            $this->validate($request, [
                'password' => ['required','string','min:6','confirmed'],
            ]);
        }

        $user->update($request->all());

        return response()->json($user);
    }

    public function setAvatar(Request $request)
    {
        $user = User::where('id', $request->user()->id)->first();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'Opss. Usuário não foi encontrado, favor verifique se esta logado.'
            ]);
        }

        $this->validate($request, [
            'avatar' => ['required','image','mimes:jpeg,jpg,png','max:1024'],
        ]);

        $file = $request->file('avatar');
        $fileName = md5(time().rand(0,9999)).".".$file->extension();
        Image::make($file->path())->fit(200, 200)
            ->save('./media/avatars/'.$fileName);

        $user->avatar = $fileName;
        $user->save();

        return response()->json($user);
    }

    public function setCover(Request $request)
    {
        $user = User::where('id', $request->user()->id)->first();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'Opss. Usuário não foi encontrado, favor verifique se esta logado.'
            ]);
        }

        $this->validate($request, [
            'cover' => ['required','image','mimes:jpeg,jpg,png','max:1024'],
        ]);

        $file = $request->file('cover');
        $fileName = md5(time().rand(0,9999)).".".$file->extension();
        Image::make($file->path())->fit(850, 310)
            ->save('./media/covers/'.$fileName);

        $user->cover = $fileName;
        $user->save();

        return response()->json($user);
    }

    public function me(Request $request)
    {
        $limit = $request->limit ?? self::LIMIT;

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
        ])->where('id', $request->user()->id)->first();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'Opss. Usuário não foi encontrado, favor verifique se esta logado.'
            ]);
        }

        return response()->json(["user" => $user]);
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->oauthAccessToken()->delete();
        }

        return response()->json(['status' => 'success']);
    }
}
