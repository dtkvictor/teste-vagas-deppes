<?php

namespace App\Http\Controllers;

use App\Helpers\Sanitize;
use App\Http\Requests\StorePublisherRequest;
use App\Http\Requests\UpdatePublisherRequest;
use App\Http\Resources\Collection\PublisherCollection;
use App\Http\Resources\PublisherResource;
use App\Models\Publisher;
use Illuminate\Http\Response;

class PublisherController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {                                        
            return new PublisherCollection(Publisher::get());
        }catch(\Exception $e) {            
            return $this->handleException($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        $publisher->books = $publisher->books()->paginate(5);
        return new PublisherCollection($publisher);
    }

    /**
     * Show publishers recommended to user
     */
    public function recommended()
    {

    }

    /**
     * Show publishers most viewed
     */
    public function mostViewed()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePublisherRequest $request)
    {
        try {            
            $publisher = new Publisher();            
            $publisher->name = Sanitize::specialChars($request->name);
            $publisher->description = Sanitize::htmlspecialchars($request->description);
            $publisher->save();
            
            return response()->json([
                'message' => 'publisher.created',
                'data' => new PublisherResource($publisher)
            ], Response::HTTP_CREATED);            

        }catch(\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePublisherRequest $request, Publisher $publisher)
    {
        try {                        
            $publisher->name = Sanitize::specialChars($request->name);
            $publisher->description = Sanitize::htmlspecialchars($request->description);
            $publisher->save();
            
            return response()->json([
                'message' => 'publisher.updated',
            ], Response::HTTP_OK);

        }catch(\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(publisher $publisher)
    {
        try {        
            $publisher->delete();
            return response()->json([
                'message' => 'publisher.deleted',
            ], Response::HTTP_NO_CONTENT);
        }catch(\Exception $e) {
            return $this->handleException($e);
        }

    }
}
