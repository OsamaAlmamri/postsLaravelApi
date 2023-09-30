<?php

namespace App\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Post",
 *     title="Post",
 *     description="Post schema",
 * )
 */
class PostSchema
{
    /**
     * @OA\Property(
     *     property="id",
     *     type="integer",
     *     description="The ID of the country",
     *     example=59
     * )
     *
     * @var int
     */
    private $id;

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
     * @OA\Property(
     *     property="created_at",
     *     type="string",
     *     format="date-time",
     *     description="The creation timestamp of the service",
     *     example="2023-09-04T21:07:52.000000Z"
     * )
     *
     * @var string
     */
    public $created_at;

    /**
     * @OA\Property(
     *     property="updated_at",
     *     type="string",
     *     format="date-time",
     *     description="The update timestamp of the service",
     *     example="2023-09-04T22:29:09.000000Z"
     * )
     *
     * @var string
     */
    public $updated_at;


    /**
     * @OA\Property(
     *     property="tags",
     *     type="array",
     *     description="The tags of the post",
     *     @OA\Items(ref="#/components/schemas/Tag")
     * )
     *
     * @var array
     */
    private $tags;
}
