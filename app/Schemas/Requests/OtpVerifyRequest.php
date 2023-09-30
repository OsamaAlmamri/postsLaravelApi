<?php

namespace App\Schemas\Requests;

use OpenApi\Annotations as OA;


/**
 * @OA\Schema(
 *      title="OtpVerify Request",
 *      schema="OtpVerifyRequest",
 *      description="Otp Verify",
 *
 *
 * )
 */

class OtpVerifyRequest
{

    /**
     * @OA\Property(
     *      title="email",
     *      description=" email ",
     *     type="string",
     *      example="osama.moh.almamari@gmail.com"
     * )
     *
     * @var integer
     */
    public $email;
    /**
     * @OA\Property(
     *      title="otp",
     *      description="otp  ",
     *     type="string",
     *      example="1236"
     * )
     *
     * @var integer
     */
    public $otp;
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
