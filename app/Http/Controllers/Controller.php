<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations\JsonContent;
use OpenApi\Annotations\Parameter;
use OpenApi\Annotations\Property;
use OpenApi\Annotations\Response;
use OpenApi\Annotations\SecurityScheme;

/**
 * @Parameter(name="id", in="path", description="id de model", required=true,@OA\Schema(type="integer"))
 *
 * @Response(
 *     response="NotFound",
 *     description="le ressource n'existe pas",
 *     @JsonContent(
 *          @Property(property="message", type="string", description="message erreur", example="utulisateur n'existe pas")
 *      )
 * )
 *
 * @OA\SecurityScheme(
 *     type="oauth2",
 *     name="petstore_auth",
 *     securityScheme="petstore_auth",
 *     @OA\Flow(
 *         flow="implicit",
 *         authorizationUrl="http://blog.me/oauth/authorize",
 *         scopes={
 *             "write:pets": "modify pets in your account",
 *             "read:pets": "read your pets",
 *         }
 *     )
 * )
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     securityScheme="api_key",
 *     name="api_key"
 * )
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
