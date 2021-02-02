<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function __invoke(Request $request)
    {
        if(!$token = Auth::attempt($request->only('email', 'password'))){
            return response(['message'=>'The username or password is incorrect!'],401);
        }
        return response()->json($token);
    }
}
