<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      x={
 *          "logo": {
 *              "url": "https://via.placeholder.com/190x90.png?text=L5-Swagger"
 *          }
 *      },
 *      title="L5 OpenApi",
 *      description="L5 Swagger OpenApi description",
 *      @OA\Contact(
 *          email="darius@matulionis.lt"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 *  *
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     securityScheme="Authorization",
 *     name="Authorization"
 * )
 *

 * @OA\PathItem(path="/")

 * @OA\Schema(
 *  schema="Result",
 *  title="Sample schema for using references",
 * 	@OA\Property(
 * 		property="status",
 * 		type="string"
 * 	),
 * 	@OA\Property(
 * 		property="error",
 * 		type="string"
 * 	)
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
