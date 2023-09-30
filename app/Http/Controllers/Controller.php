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
 *      title="Osama Almamari (779558800)",
 *      description="Posts Api Documntion",
 *      @OA\Contact(
 *          email="osama.moh.almamari@gmail.com"
 *      ),
 *     @OA\License(
 *         name="Post api 1.0",
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
