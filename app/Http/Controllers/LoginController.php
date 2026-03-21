<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Controllers\EventController;

class LoginController extends Controller
{
    public function login(LoginRequest $request){
        if (Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'token' => $request->user()->createToken("token")->plainTextToken,
                'message' => 'Success',
                'status' => true
            ]);
        }
        return response()->json([
            'message' => 'Unauthorized',
            'status' => false
        ], Response::HTTP_UNAUTHORIZED);
    }
}