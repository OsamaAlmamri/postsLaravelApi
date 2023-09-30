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
        $posts = Post::with('tags')->paginate(5);
        PostResource::collection($posts);
        return ok(data:$posts);

    }

    public function show($id)
    {
        $post = Post::with('tags')->findOrFail($id);
        return ok(data: new PostResource($post));
    }

    /**

     * @OA\POST (
     *      path="/api/posts",
     *      operationId="crate-post",
     *      tags={"posts"},
     *      summary=" Add new Post",
     *      description=" ",
     *        security={
     *         {"Authorization": {}}
     *     },
     *        @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/PostRequest")
     *      ),

     *     @OA\Response(
     *         response=400,
     *         description="Error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="error",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Error")
     *             )
     *         )
     *     ),
     *  @OA\Response(
     *          response=422,
     *              description="Error in Requried Inputs",
     *        @OA\JsonContent(
     *          type="object",
     *       * @OA\Property(
     *          property="message",
     *          type="string",
     *          description="Error Message",
     *          example="Unprocessable Entity"
     *      ),
     *        @OA\Property(
     *          property="errors",
     *          type="Object",
     *          description="Errors",
     *
     *          example= "{'email': ['العنوان مطلوب'   ]}"
     *                  )
     *              )
     *          ),
     *
     *   *   @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                property="data",
     *                 oneOf={
     *                 @OA\Schema(ref="#/components/schemas/Post")
     *
     *             },
     *             )
     *         )
     *     )
     *     )
     */
    public function store(PostDTO $request)
    {
        try {
            $post = Post::create([
                'title' => request()->title,
                'description' => request()->description,
                'user_id' => auth()->id(),
            ]);

            $post->tags()->sync(request()->tags);

        } catch (AppException $e) {
            return err(error: ErrorDTO::fromArray(array: [
                'title' => $e->getMessage(),
                'desc' => 'Something went wrong, please try again later.',
            ]));
        }
        return ok(data: new PostResource($post));


    }

    /**

     * @OA\Put (
     *      path="/api/posts/{id}",
     *      operationId="update-post",
     *      tags={"posts"},
     *      summary=" Update the Post",
     *      description=" ",
     *        security={
     *         {"Authorization": {}}
     *     },
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Example ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *        @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/PostRequest")
     *      ),

     *     @OA\Response(
     *         response=400,
     *         description="Error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="error",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Error")
     *             )
     *         )
     *     ),
     *  @OA\Response(
     *          response=422,
     *              description="Error in Requried Inputs",
     *        @OA\JsonContent(
     *          type="object",
     *       * @OA\Property(
     *          property="message",
     *          type="string",
     *          description="Error Message",
     *          example="Unprocessable Entity"
     *      ),
     *        @OA\Property(
     *          property="errors",
     *          type="Object",
     *          description="Errors",
     *
     *          example= "{'email': ['العنوان مطلوب'   ]}"
     *                  )
     *              )
     *          ),
     *
     *   *   @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                property="data",
     *                 oneOf={
     *                 @OA\Schema(ref="#/components/schemas/Post")
     *
     *             },
     *             )
     *         )
     *     )
     *     )
     */
    public function update(PostDTO $request, $id)
    {
        $post = Post::where('user_id',auth()->id())->findOrFail($id);

        try {
            $post->update([
                'title' => request()->title,
                'description' => request()->description,
                'user_id' => auth()->id(),
            ]);

            $post->tags()->sync(request()->tags);

        } catch (AppException $e) {
            return err(error: ErrorDTO::fromArray(array: [
                'title' => $e->getMessage(),
                'desc' => 'Something went wrong, please try again later.',
            ]));
        }
        return ok(data: new PostResource($post));

    }


    /**

     * @OA\Delete (
     *      path="/api/posts/{id}",
     *      operationId="delete-post",
     *      tags={"posts"},
     *      summary=" Update the Post",
     *      description=" ",
     *        security={
     *         {"Authorization": {}}
     *     },
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Example ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="error",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Error")
     *             )
     *         )
     *     ),
     *   *   @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                property="data",
     *
     *             )
     *         )
     *     )
     *     )
     */
    public function destroy($id)
    {
        $post = Post::where('user_id',auth()->id())->findOrFail($id);
        $post->delete();

        return ok(data: null);
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
