<?php 

namespace App\Annotations;

/**
 * Use annotations to document code.
 * Using ghost classes can help with code pollution.
 * It is recommended to keep the common schemas in the Schemas file
 * */

/**
 * @OA\Info(
 *     title="Deppes Library API",
 *     version="1.0.0",
 *     description="API for book management.",
 *     @OA\Contact(
 *         email="Imagine an email",
 *         name="Victor Lucas Rodrigues"
 *     ),
 *     @OA\License(
 *         name="MIT License",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 */

abstract class Annotation {}

/**
* @OA\Schema(
*     schema="PaginateLinksResponse",
*     title="PaginateLinksResponse",
*     description="Links are included in answers that have pagination",
*     @OA\Property(property="links", type="array", @OA\Items(
*          @OA\Property(property="url", type="string", example="http://localhost:8000/api/books?page=1"),
*          @OA\Property(property="label", type="string", example="1"),
*          @OA\Property(property="active", type="boolean", example="true")
*     )
* )
*/