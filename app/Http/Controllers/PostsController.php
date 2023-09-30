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

    /**
     * @OA\Schema(
     *     schema="PostPagnations",
     *     type="object",
     *     @OA\Property(
     *         property="data",
     *         type="object",
     *         @OA\Property(property="current_page",example=1 ,type="integer"),
     *         @OA\Property(
     *             property="data",
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="title", type="string"),
     *                 @OA\Property(property="description", type="string"),
     *                 @OA\Property(
     *                     property="user",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="name", type="string"),
     *                     @OA\Property(property="email", type="string"),
     *                 ),
     *                 @OA\Property(
     *                     property="tags",
     *                     type="array",
     *                     @OA\Items(
     *                         @OA\Property(property="id", type="integer"),
     *                         @OA\Property(property="name", type="string"),
     *                         @OA\Property(property="slug", type="string"),
     *                     ),
     *                 ),
     *             ),
     *         ),
     *         @OA\Property(property="first_page_url", type="string"),
     *         @OA\Property(property="from", type="integer"),
     *         @OA\Property(property="last_page", type="integer"),
     *         @OA\Property(property="last_page_url", type="string"),
     *         @OA\Property(
     *             property="links",
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="url", type="string", nullable=true),
     *                 @OA\Property(property="label", type="string"),
     *                 @OA\Property(property="active", type="boolean"),
     *             ),
     *         ),
     *         @OA\Property(property="next_page_url", type="string", nullable=true),
     *         @OA\Property(property="path", type="string"),
     *         @OA\Property(property="per_page",example=10, type="integer"),
     *         @OA\Property(property="prev_page_url", type="string", nullable=true),
     *         @OA\Property(property="to", example=10,type="integer"),
     *         @OA\Property(property="total", example=100,type="integer"),
     *     ),
     * )

     * @OA\Get  (
     *      path="/api/posts",
     *      operationId="all -posts with pagnation",
     *      tags={"posts"},
     *      summary=" Posts with the pagnation",

     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="tag",
     *         in="query",
     *         description="Tag id or slug to retrive all relates posts ",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="search key in post title or desrption or tags",
     *         required=false,
     *         @OA\Schema(type="string")
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
     *
     *   *   @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                property="data",
     *                 oneOf={
     *                 @OA\Schema(ref="#/components/schemas/PostPagnations")
     *
     *             },
     *             )
     *         )
     *     )
     *     )
     */
    public function index(Request $request)
    {
        $posts = Post::with('tags')->search()->paginate(10);
        PostResource::collection($posts);
        return ok(data:$posts);

    }

    /**

     * @OA\Get  (
     *      path="/api/posts/{id}",
     *      operationId="get-post",
     *      tags={"posts"},
     *      summary=" show the Post",
     *      description=" ",
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
     *                 oneOf={
     *                 @OA\Schema(ref="#/components/schemas/Post")
     *
     *             },
     *             )
     *         )
     *     )
     *     )
     */
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




}
