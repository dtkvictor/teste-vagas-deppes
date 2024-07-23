<?php 

namespace App\Annotations;

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