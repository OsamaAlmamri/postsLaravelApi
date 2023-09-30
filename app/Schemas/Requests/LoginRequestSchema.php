<?php

namespace App\Schemas\Requests;

use OpenApi\Annotations as OA;


/**
 * @OA\Schema(
 *      title="Login Request",
 *      schema="LoginRequest",
 *      description="LoginRequest",
 *      type="object",
 *      required={"name"}
 * )
 */

class LoginRequestSchema
{

    /**
     * @OA\Property(
     *      title="email",
     *      description="email of register account ",
     *     type="string",
     *      example="osama.moh.almamari@gmail.com"
     * )
     *
     * @var integer
     */
    public $email;
    /**
     * @OA\Property(
     *      title="password",
     *      description="password  ",
     *     type="string",
     *      example="123456"
     * )
     *
     * @var integer
     */
    public $password;
}
