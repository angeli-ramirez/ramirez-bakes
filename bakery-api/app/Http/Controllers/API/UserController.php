<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response; 

class UserController extends Controller
{
    
    private $apiToken;
    public function __construct()
    {
        //create token
        $this->apiToken = uniqid(base64_encode(Str::random(40)));
    }
    /** 
     * Register API 
     * 
     * @return \Illuminate\Http\Response 
     */
    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required',
    //         'address' => 'required',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()]);
    //     }
    
    //     $postArray = $request->all();
    //     $postArray['password'] = bcrypt($postArray['password']);
    //     $user = User::create($postArray);
    
    //     $success['token'] = $this->apiToken;
    //     $success['full_name'] = $user->first_name . ' ' . $user->last_name;
    
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'User registered successfully.',
    //         'data' => [
    //             'first_name' => $user->first_name,
    //             'last_name' => $user->last_name,
    //             'email' => $user->email,
    //             'address' => $user->address,
    //             'id' => $user->id,
    //         ],
    //     ]);
    // }
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $success['token'] = $this->apiToken;
            $success['user'] = [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'id' => $user->id,
            ];

            return response()->json([
                'status' => 'success',
                'data' => $success
            ]);
        } else {
            $userExists = User::where('email', $request->email)->exists();
            $errorMessage = $userExists ? 'Incorrect email or password' : 'User not found.';

            return response()->json([
                'status' => 'error',
                'data' => $errorMessage
            ], $userExists ? Response::HTTP_UNAUTHORIZED : Response::HTTP_NOT_FOUND);
        }
    }
    
}
