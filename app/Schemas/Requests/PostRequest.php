<?php

namespace App\Schemas\Requests;

use OpenApi\Annotations as OA;


/**
 * @OA\Schema(
 *      title="Post Request",
 *      schema="PostRequest",
 *      description="Post Request  body data",
 *      type="object",
 * )
 */

class PostRequest
{

    /**
     * @OA\Property(
     *     property="title",
     *     type="string",
     *     description="The title of the post",
     *     example="test title name"
     * )
     *
     * @var string
     */
    private $title;

    /**
     * @OA\Property(
     *     property="description",
     *     type="string",
     *     description="The description of the post",
     *     example="The description of the post "
     * )
     *
     * @var string
     */
    private $description;

    /**
     * @OA\Property(property="tags", type="array", @OA\Items(type="integer"), example={1, 2})
     */
    public $tags;

}
