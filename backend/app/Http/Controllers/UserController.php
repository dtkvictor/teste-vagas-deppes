<?php

namespace App\Http\Controllers;

use App\Helpers\Sanitize;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Resources\Collection\BookCollection;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function me(Request $request)
    {
        return new UserResource($request->user());
    }

    public function myBooks(Request $request) 
    {
        try {                        
            $books = $request->user()->books()->paginate(5);    
            return new BookCollection($books);
            
        }catch(\Exception $e) {            
            return $this->handleException($e);
        }
    }

    public function update(UpdateUserRequest $request)
    {
        try {
            $user = $request->user();            
            $user->name = Sanitize::specialChars($request->name);
            $user->email = Sanitize::email($request->email);    
            $user->save();

            return response()->json([
                'message' => 'user.updated',
            ], Response::HTTP_CREATED); 

        }catch(\Exception $e) {
            $this->handleException($e);
        }
    }

    public function updatePassword(UpdatePasswordRequest $request) {
        try {
            $user = $request->user(); 

            if(!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'message' => 'Unprocessable Content',
                    'errors' => [
                        'current_password' => 'current_password.invalid'
                    ]
                ], 422);
            }           

            $user->password = $request->password;            
            $user->save();            

            return response()->json([
                'message' => 'user.password_updated',
            ], Response::HTTP_CREATED); 

        }catch(\Exception $e) {
            $this->handleException($e);
        }
    }

    public function delete(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            $request->user()->delete();        
            return response()->json([
                'message' => 'user.deleted',
            ], Response::HTTP_OK);
        }catch(\Exception $e) {
            $this->handleException($e);
        }
    }
}
