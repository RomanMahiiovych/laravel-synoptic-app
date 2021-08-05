<?php

namespace App\Http\Controllers\API;
/**
 * @OA\OpenApi(
 *     @OA\Server(
 *         url="http://localhost:8000/api",
 *         description="Laravel API server"
 *     ),
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Laravel Swagger API Documentation",
 *         description="A simple API for display synoptic data",
 *         termsOfService="http://swagger.io/terms/",
 *         @OA\Contact(name="Roman Mah"),
 *         @OA\License(name="MIT"),
 *     ),
 *     @OA\Tag(
 *     name="Weather",
 *     description="Weather data"
 *     ),
 * )
 */
class Controller extends \App\Http\Controllers\Controller
{
}
