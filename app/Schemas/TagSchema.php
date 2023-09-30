<?php

namespace App\Schemas;

use OpenApi\Annotations as OA;



/**
 * @OA\Schema(
 *     schema="Tag",
 *     title="Tag",
 *     description="tag schema",
 * )
 */
class TagSchema
{
    /**
     * @OA\Property(
     *     property="id",
     *     type="integer",
     *     description="The ID of the tag",
     *     example=1
     * )
     *
     * @var int
     */
    private $id;

    /**
     * @OA\Property(
     *     property="name",
     *     type="string",
     *     description="The name of the tag",
     *     example="secure email"
     * )
     *
     * @var string
     */
    private $name;
    /**
     * @OA\Property(
     *     property="slug",
     *     type="string",
     *     description="The slug of the tag",
     *     example="secure-email"
     * )
     *
     * @var string
     */
    private $slug;

}





