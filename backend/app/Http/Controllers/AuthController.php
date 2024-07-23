<?php

namespace App\Http\Controllers;

use App\Helpers\Sanitize;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    private string $tokenName = 'auth.token';

    public function login(LoginRequest $request)
    {                
        try {                                     
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => ['email' => 'credentials.invalid'],
                ], 422);                
            }
         
            $token = $user->createToken($this->tokenName)->plainTextToken;

            return response()->json([
                'data' => [
                    'user' => $user,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                    'expiration_at' => env('SANCTUM_EXPIRATION'),
                ]
            ], Response::HTTP_OK);

        }catch(\Exception $e) {                    
            return $this->handleException($e);            
        }        
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = new User();
            $user->name = Sanitize::specialChars($request->name);            
            $user->email = Sanitize::email($request->email);
            $user->password = $request->password;
            $user->save();

            return response()->json([
                'message' => 'user.registered',
            ], Response::HTTP_CREATED);

        }catch(\Exception $e) {
            $this->handleException($e);
        }
    }

    public function refresh(Request $request)
    {
        try {            
            $user = $request->user();
            $user->currentAccessToken()->delete();
            $token = $user->createToken($this->tokenName)->plainTextToken;

            return response()->json([
                'data' => [
                    'user' => $request->user(),
                    'token' => $token,
                    'created_at' => Carbon::now(),
                    'expiration_at' => 3600,
                ]
            ], Response::HTTP_OK);            
        }catch(\Exception $e) {        
            return $this->handleException($e);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json([], Response::HTTP_NO_CONTENT);
        }catch(\Exception $e) {            
            return $this->handleException($e);
        }
    }
}
