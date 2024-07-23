<?php

namespace App\Annotations;

/**
 * @OA\Schema(
 *     schema="Publisher",
 *     title="Publisher",
 *     description="A publisher object",
 *     @OA\Property(property="id", type="int", example=1),    
 *     @OA\Property(property="name", type="string", example="Pinguin Books"),
 *     @OA\Property(property="description", type="string", example="This is a book description."),     
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-07-18T12:30:45Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-07-18T12:30:45Z")
 * )
 */

class PublisherAnnotation {}

/**
 * @OA\Schema(
 *     schema="BookFormRequest",
 *     title="BookFormRequest",
 *     description="A form request to create a book.",
 *     @OA\Property(property="thumb", type="string", format="binary", description="Image file."),
 *     @OA\Property(property="title", type="string", example="Sample Book"),
 *     @OA\Property(property="author", type="string", example="John Doe"),     
 *     @OA\Property(property="isbn", type="string", example="978-3-16-148410-0"),
 *     @OA\Property(property="description", type="string", example="This is a book description."),
 *     @OA\Property(property="number_pages", type="integer", example=200),
 *     @OA\Property(property="language", type="string", example="en"),
 *     @OA\Property(property="category", type="integer", example=1, description="Category ID"),
 *     @OA\Property(property="publisher", type="integer", example=3, description="Publisher ID"),
 * )
 */
class BookFormRequestAnnotation {}

/**
 * @OA\Schema(
 *      schema="BookResponse",
 *      title="BookResponse",
 *      description="Returns an object containing book information",
 *      @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Book"))
 * )
 */
class BookResourceResponse {}

/**
 * @OA\Schema(
 *      schema="BookCollectionResponse",
 *      title="BookCollectionResponse",
 *      description="Returns an array of books object and, if necessary, links for pagination.",
 *      @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Book")),
 *      @OA\Property(property="links", type="array", @OA\Items(
 *              @OA\Property(property="url", type="string", example="http://localhost:8000/api/books?page=1"),
 *              @OA\Property(property="label", type="string", example="1"),
 *              @OA\Property(property="active", type="boolean", example="true")
 *          )
 *      )
 * )
 */
 class BookCollectionResponse {}


/**
 * Controller annotations must be inside the controller class.
 */
class BookControllerAnnotation
{
    /**
     * @OA\Get(
     *      path="/api/books",    
     *      tags={"Books"},
     *      summary="Get all books",
     *      description="This route returns all books with pagination and a limit of 5 books per request.",
     *      @OA\Parameter(
     *          description="Order by title asc or desc title.",
     *          in="query",
     *          name="order",
     *          required=false,
     *          @OA\Schema(type="string"),
     *          @OA\Examples(example="title.asc", value="Ascending order by title", summary="Order books by title ascending"),
     *          @OA\Examples(example="title.desc", value="Descending order by title", summary="Order books by title descending")
     *      ),
     *      @OA\Parameter(
     *          description="Search books by title, category, or publisher.",
     *          in="query",
     *          name="search",
     *          required=false,
     *          @OA\Schema(type="string"),
     *          @OA\Examples(example="action", value="Search books by category", summary="Search books where category name equals 'action'.")
     *      ),
     *      @OA\Parameter(
     *          description="Define the min number of pages in a book.",
     *          in="query",
     *          name="min-page",
     *          required=false,
     *          @OA\Schema(type="string"),
     *          @OA\Examples(example="10", value="Return books with min pages equal to 'min-page'", summary="Filter books by min number of pages")
     *      ),
     *      @OA\Parameter(
     *          description="Define the max number of pages in a book.",
     *          in="query",
     *          name="max-page",
     *          required=false,
     *          @OA\Schema(type="string"),
     *          @OA\Examples(example="100", value="Return books with max pages equal to 'max-page'", summary="Filter books by max number of pages")
     *      ),
     *      @OA\Parameter(
     *          description="Filter books by category name.",
     *          in="query",
     *          name="category",
     *          required=false,
     *          @OA\Schema(type="string"),
     *          @OA\Examples(example="fiction", value="Return books belonging to the 'fiction' category.", summary="Filter books by category")
     *      ),
     *      @OA\Parameter(
     *          description="Filter books by publisher name.",
     *          in="query",
     *          name="publisher",
     *          required=false,
     *          @OA\Schema(type="string"),
     *          @OA\Examples(example="penguin-books", value="Return books published by 'Penguin Books'.", summary="Filter books by publisher")
     *      ),
     *      @OA\Parameter(
     *          description="Filter books by language.",
     *          in="query",
     *          name="language",
     *          required=false,
     *          @OA\Schema(type="string"),
     *          @OA\Examples(example="en", value="Return books written in English.", summary="Filter books by language")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK",    
     *          @OA\JsonContent(ref="#/components/schemas/BookCollectionResponse"))    
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal error server"
     *      )   
     * )
     */
    public function index() {}

    /**
     * @OA\Get(
     *      path="/api/books/{book_id}",
     *      tags={"Books"},
     *      summary="Get book by ID",
     *      description="This route return a book based on the given ID.",
     *      @OA\Parameter(
     *          description="ID to show book.",
     *          in="path",
     *          name="id",
     *          required=true,
     *          @OA\Schema(type="int"),
     *          @OA\Examples(example="/api/books/1", value="1", summary="Book id example")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(ref="#/components/schemas/BookResponse")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Book not found"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal error server"
     *      )            
     * )
     */
    public function show() {}

    /**
     * @OA\Post(
     *      path="api/books",
     *      tags={"Books"},
     *      summary="Create new book.",
     *      description="This route is used to create a new book.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/BookFormRequest")
     *         )
     *      ),
     *      @OA\Response(
     *          response="201",
     *          description="Book created successfully.",
     *          @OA\JsonContent(ref="#/components/schemas/Book")
     *       ),
     *       @OA\Response(
     *          response=500,
     *          description="Internal error server"
     *       )
     * )
     */
    public function store() {}

    /**
     * @OA\Put(
     *      path="api/books/{book_id}",
     *      tags={"Books"},
     *      summary="Update book by ID.",
     *      description="This route update a book based on the given ID.",
     *      @OA\Parameter(
     *          description="ID to update book.",
     *          in="path",
     *          name="id",
     *          required=true,
     *          @OA\Schema(type="int"),
     *          @OA\Examples(example="/api/books/1", value="1", summary="Book id example")
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/BookFormRequest")
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Book updated successfully"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Book not found"
     *       ),
     *       @OA\Response(
     *          response=500,
     *          description="Internal error server"
     *       )   
     * )
     */
    public function update() {}

    /**
     * @OA\Delete(
     *      path="api/books/{book_id}",
     *      tags={"Books"},
     *      summary="Delete a book by id.",
     *      description="This route delete a book based on the given ID.",
     *      @OA\Parameter(
     *          description="ID to delete book.",
     *          in="path",
     *          name="id",
     *          required=true,
     *          @OA\Schema(type="int"),
     *          @OA\Examples(example="int", value="10", summary="Book id example.")
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Book deleted successfully"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Book not found"
     *       ),
     *       @OA\Response(
     *          response=500,
     *          description="Internal error server"
     *       )            
     * )
     */
    public function delete() {}
}
