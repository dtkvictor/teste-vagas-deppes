<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Filters\BookFilter;
use App\Http\Resources\BookResource;
use App\Http\Resources\Collection\BookCollection;

class BookcaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {        
        try {                                    
            $books = $request->user()->books()->query();
            $books = new BookFilter($books);
            $books = $books->apply($request->query());
            $books = $books->with(['user', 'category'])
                         ->paginate(5)
                         ->withQueryString();    
            return new BookCollection($books);
            
        }catch(\Exception $e) {            
            return $this->handleException($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $book = $request->user()->books()->find($id);
        if(!$book) return abort(404);

        $book->load(['category']);
        return new BookResource($book);
    }
}