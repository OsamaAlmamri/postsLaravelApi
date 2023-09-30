<?php

namespace App\Schemas\Requests;

use OpenApi\Annotations as OA;


/**
 * @OA\Schema(
 *      title="Register Request",
 *      schema="RegisterRequest",
 *      description="RegisterRequest",
 *      type="object",
 *      required={"name"}
 * )
 */

class RegisterRequest
{

    /**
     * @OA\Property(
     *      title="name",
     *      description="name ",
     *     type="string",
     *      example="osama almamari"
     * )
     *
     * @var string
     */

       public $name;
    /**
     * @OA\Property(
     *      title="email",
     *      description="email ",
     *     type="string",
     *      example="osama.moh.almamari@gmail.com"
     * )
     *
     * @var string
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
     * @var string
     */
    public $password;
    /**
     * @OA\Property(
     *      title="password_confirmation",
     *      description="password_confirmation  ",
     *     type="string",
     *      example="123456"
     * )
     *
     * @var integer
     */
    public $password_confirmation;
}
