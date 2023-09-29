<?php

namespace App\Http\Controllers;

use App\DTOs\App\ErrorDTO;
use App\DTOs\Posts\PostDTO;
use App\Exceptions\AppException;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResourse;
use App\Models\Otp;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function index(Request $request)
    {
        $posts = Post::with('tags')->get();
        return ok(data: PostResource::collection($posts));

    }

    public function show($id)
    {
        $post = Post::with('tags')->findOrFail($id);
        return ok(data: new PostResource($post));
    }

    public function store(PostDTO $request)
    {
        try {
            $post = Post::create(\request()->all());

            $tags = $request->input('tags');
            $post->tags()->sync($tags);

        } catch (AppException $e) {
            return err(error: ErrorDTO::fromArray(array: [
                'title' => $e->getMessage(),
                'desc' => 'Something went wrong, please try again later.',
            ]));
        }
        return ok(data: new PostResource($post));


    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        $tags = $request->input('tags');
        $post->tags()->sync($tags);

        return ok(data: new PostResource($post));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(null, 204);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $posts = Post::whereHas('tags', function ($query) use ($search) {
            $query->where('name', 'LIKE', "%$search%");
        })->orWhere('title', 'LIKE', "%$search%")->get();

        return ok(data: PostResource::collection($posts));

    }

}
