<?php

namespace App\Schemas\Requests;

use OpenApi\Annotations as OA;


/**
 * @OA\Schema(
 *      title="Forget Password Otp Send Request Schema",
 *      schema="ForgetPasswordOtpSendRequest",
 *      description="",
 *      type="object",
 *
 * )
 */

class ForgetPasswordOtpSendRequestSchema
{

    /**
     * @OA\Property(
     *      title="email",
     *      description=" email of the user ",
     *     type="string",
     *      example="osama.moh.almamari@gmail.com"
     * )
     *
     * @var integer
     */
    public $email;

}
