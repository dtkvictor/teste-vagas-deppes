<?php

namespace App\Http\Controllers;
use App\Helpers\Sanitize;
use App\Http\Filters\BookFilter;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\Collection\BookCollection;
use App\Models\Book;
use App\Models\BookVisited;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{   
    /**
     * Show all books with pagination 
     */
    public function index(Request $request)
    {                                 
        try {                        
            $book = Book::query();
            $book = new BookFilter($book);
            $book = $book->apply($request->query());
            $book = $book->with(['user', 'category'])
                         ->paginate(10)
                         ->withQueryString();    
            return new BookCollection($book);
            
        }catch(\Exception $e) {            
            return $this->handleException($e);
        }
    }

    /**
     * Show books recommended to user
     */
    public function recommended(Request $request)
    {
        /*
        $lastVisitedBooks = $request->user()->visitedBooks()
            ->orderBy('created_at')
            ->take(3)
            ->get();

        $lastVisitedBooksIds = $lastVisitedBooks->pluck('category_id')->unique();
        $lastVisitedBooksCategory = $lastVisitedBooks->pluck('category_id')->unique();

        $recommendedBooks = Book::whereHas('categories', function($query) use ($lastVisitedBooksCategory) {
            $query->whereIn('id', $lastVisitedBooksCategory);
        })    
        ->whereNotIn('id', $lastVisitedBooksIds)
        ->take(5)
        ->get();    
        */

        return new BookCollection(
            Book::inRandomOrder()->limit(10)->get()
        );
    }

    /**
     * Show books most viewed
     */
    public function mostViewed(Request $request)
    {
        $books = $request->user()->visitedBooks()->get();
        return new BookCollection($books);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Book $book)
    {
        if(auth()->check()) {
            $visited = new BookVisited();
            $visited->user_id = $request->user()->id;
            $visited->book_id = $request->book()->id;
        }        
        $book->load(['category']);
        return new BookResource($book);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {        
        try {
            $book = new Book();
            $book->thumb = $request->file('thumb')->store($book->getThumbStoragePath());
            $book->title = Sanitize::specialChars($request->title);
            $book->author = Sanitize::specialChars($request->author);
            $book->isbn = Sanitize::specialChars($request->isbn);
            $book->description = Sanitize::htmlSpecialChars($request->description);
            $book->number_pages = $request->number_pages;            
            $book->publisher = Sanitize::specialChars($request->publisher);
            $book->user_id = $request->user()->id;            
            $book->category_id = $request->category;            
            $book->save();

            return response()->json([
                'message' => 'book.created',
                'data' => new BookResource($book)
            ], Response::HTTP_CREATED);

        }catch(\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {        
        try {
            if($request->has('thumb')) {
                if(Storage::exists($book->thumb)) Storage::delete($book->thumb);
                $book->thumb = $request->file('thumb')->store($book->getThumbStoragePath());
            }            
            $book->title = Sanitize::specialChars($request->title);
            $book->author = Sanitize::specialChars($request->author);
            $book->isbn = Sanitize::specialChars($request->isbn);
            $book->description = Sanitize::htmlSpecialChars($request->description);
            $book->number_pages = $request->number_pages;
            $book->publisher = Sanitize::specialChars($request->publisher);
            $book->category_id = $request->category;
            
            $book->save();

            return response()->json([
                'message' => 'book.updated',
            ], Response::HTTP_OK);

        }catch(\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        try {
            if(Storage::exists($book->thumb)) Storage::delete($book->thumb);            
            $book->delete();            
            return response()->json([
                'message' => 'book.deleted',
            ], Response::HTTP_NO_CONTENT);

        }catch(\Exception $e) {
            return $this->handleException($e);
        }
    }
}
