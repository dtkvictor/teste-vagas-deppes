<?php

namespace App\Http\Controllers;

use App\Helpers\Sanitize;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\Collection\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {                            
            return new CategoryCollection(Category::get());            
        }catch(\Exception $e) {            
            return $this->handleException($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->books = $category->books()->paginate(5);
        return new CategoryCollection($category);
    }

    /**
     * Show categories recommended to user
     */
    public function recommended()
    {

    }

    /**
     * Show categories most viewed
     */
    public function mostViewed()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = new Category();
            $category->thumb = $request->file('thumb')->store($category->getThumbStoragePath());
            $category->name = Sanitize::specialChars($request->name);
            $category->description = Sanitize::htmlspecialchars($request->description);
            $category->save();
            
            return response()->json([
                'message' => 'category.created',
                'data' => new CategoryResource($category)
            ], Response::HTTP_CREATED);

        }catch(\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {            
            if($request->has('thumb')) {
                if(Storage::exists($category->thumb)) Storage::delete($category->thumb);
                $category->thumb = $request->file('thumb')->store(Category::storageThumbPath());
            }                        

            $category->thumb = $request->file('thumb')->store($category->getThumbStoragePath());
            $category->name = Sanitize::specialChars($request->name);
            $category->description = Sanitize::htmlspecialchars($request->description);
            $category->save();
            
            return response()->json([
                'message' => 'category.updated',                
            ], Response::HTTP_OK);

        }catch(\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            if(Storage::exists($category->thumb)) Storage::delete($category->thumb);
            $category->delete();
        }catch(\Exception $e) {
            return $this->handleException($e);
        }

    }
}
