<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->limit ?? self::LIMIT;

        $user = User::where('id', $request->user()->id)->first();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'Opss. Usuário não foi encontrado, favor verifique se esta logado.'
            ]);
        }

        $ids = [];
        foreach ($user->followings()->get() as $following) {
            $ids[] = $following->user_id_to;
        }
        $ids[] = $user->id;

        $posts = Post::with(['user','comments' => function ($query) {
            $query->with('user');
        }])
        ->whereIn('user_id', $ids)
        ->orderBy('created_at', 'DESC')
        ->paginate($limit);

        return response()->json($posts);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $user = User::where('id', $request->user()->id)->first();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'Opss. Usuário não foi encontrado, favor verifique se esta logado.'
            ]);
        }

        $this->validate($request, [
            'type' => ['required'],
            'body' => ['required_if:type,text','max:5000'],
        ]);

        $data = $request->all();
        if ($data['type'] === 'photo') {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $fileName = md5(time().rand(0,9999)).".".$file->extension();
                Image::make($file->path())->fit(800, 800)
                    ->save('./media/uploads/'.$fileName);
                $data['body'] = $fileName;
            }
        }

        $user->posts()->create([
            "body" => $data['body'],
            "type" => $data['type'],
        ]);

        return response()->json([
            'error' => false,
            'message' => 'Post adicionado com sucesso.'
        ]);
    }

    /**
     * @param Request $request
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function byUser(Request $request, $user_id)
    {
        $user = User::where('id', $request->user()->id)->first();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'Opss. Usuário não foi encontrado, favor verifique se esta logado.'
            ]);
        }

        $limit = $request->limit ?? self::LIMIT;

        $user = User::with([
            'posts' => function ($query) use ($limit) {
                $query->with([
                    'comments' => function ($query) {
                        $query->with('user');
                    }
                ])->paginate($limit);
            },
            'followings',
            'followers'
        ])->where('id', $user_id)->first();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'Opss. Usuário não foi encontrado.'
            ]);
        }

        return response()->json(["user" => $user]);
    }

    /**
     * @param Request $request
     * @param $post_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function like(Request $request, $post_id)
    {
        $user = User::where('id', $request->user()->id)->first();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'Opss. Usuário não foi encontrado, favor verifique se esta logado.'
            ]);
        }

        $post = Post::where('id', $post_id)->first();

        if (!$post) {
            return response()->json([
                'error' => true,
                'message' => 'Opss. Post não foi encontrado.'
            ]);
        }

        $check = $post->likes()->where('user_id', $user->id)->first();

        $message = null;

        if ($check) {
            $check->delete();
            $message = "Você descurtiu com sucesso";
            $isLiked = false;
        } else {
            $post->likes()->create(['user_id' => $user->id]);
            $message = "Você curtiu com sucesso";
            $isLiked = true;
        }

        $count = $post->likes()->count();

        return response()->json(["error" => false, "message" => $message, "isLiked" => $isLiked, "likesCount" => $count]);
    }

    /**
     * @param Request $request
     * @param $post_id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function comment(Request $request, $post_id)
    {
        $user = User::where('id', $request->user()->id)->first();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'Opss. Usuário não foi encontrado, favor verifique se esta logado.'
            ]);
        }

        $this->validate($request, [
            "body" => ['required','string','min:5']
        ]);

        $post = Post::where('id', $post_id)->first();

        if (!$post) {
            return response()->json([
                'error' => true,
                'message' => 'Opss. Post não foi encontrado.'
            ]);
        }

        $post->comments()->create(['user_id' => $user->id, 'body' => $request->body]);
        $count = $post->comments()->count();

        return response()->json(["error" => false, "message" => "Comentário adicionado com sucesso", "countComments" => $count]);
    }
}
