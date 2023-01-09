<?php

namespace App\Http\Controllers\Api;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Fiat Lux api documentation",
 *      description="Fiat Lux School OpenApi documentation",
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server"
 * )
 *
 * @OA\Tag(
 *     name="Auth",
 *     description="API Endpoints of Auth operations"
 * )
 *
 * @OA\Tag(
 *     name="Tests",
 *     description="API Endpoints of Tests"
 * )
 *
 * @OA\Tag(
 *     name="Questions",
 *     description="API Endpoints of Test Questions"
 * )
 *
 * @OA\Tag(
 *     name="Options",
 *     description="API Endpoints of Question Options"
 * )
 *
 * @OA\Tag(
 *     name="Answers",
 *     description="API Endpoints of Answers"
 * )
 *
 * @OA\Tag(
 *     name="Users",
 *     description="API Endpoints of Users"
 * )
 *
 * @OA\SecurityScheme(
 *     type="http",
 *     in="header",
 *     securityScheme="bearerAuth",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     name="Bearer"
 * )
 */
class Controller
{

}
