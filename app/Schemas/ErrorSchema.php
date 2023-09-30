<?php

namespace App\Schemas;

use OpenApi\Annotations as OA;



/**
 * @OA\Schema(
 *     schema="Error",
 *     title="Error",
 *     description="Error schema",
 * )
 */
class ErrorSchema
{
    /**
     * @OA\Property(
     *     property="title",
     *     type="string",
     *     description="Error Message",
     *     example="  error meassage "
     * )
     *
     * @var string
     */
    private $title;

    /**
     * @OA\Property(
     *     property="desc",
     *     type="string",
     *     description="Error description",
     *     example= "Something went wrong, please try again later."
     * )
     *
     * @var string
     */
    private $desc;

}





