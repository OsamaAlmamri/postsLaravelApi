<?php

namespace App\Http\Controllers;

use App\DTOs\App\ErrorDTO;
use App\DTOs\Posts\PostDTO;
use App\Exceptions\AppException;
use App\Http\Resources\PostResource;
use App\Http\Resources\TagResource;
use App\Http\Resources\UserResourse;
use App\Models\Otp;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class TagsController extends Controller
{

    /**

     * @OA\Get  (
     *      path="/api/tags",
     *      operationId="get-tags",
     *      tags={"tags"},
     *      summary=" Tags",
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
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Tag")
     *             )
     *         )
     *     )
     *     )
     */
    public function index(Request $request)
    {
        $tags = Tag::all();

        return ok(data:TagResource::collection($tags));

    }


}
