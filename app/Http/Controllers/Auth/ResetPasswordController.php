<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function forgot(Request $request){
        $validator = Validator::make($request->only('email'), [
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $email = $request->input('email');
        if(User::where('email', $email)->doesntExist()){
            return response([
                'message'=> 'User desn\'t exist'
            ], 400);
        }

      try{
        $token = Str::random(10);
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token
        ]);
        //send email
        Mail::send('mails.forgot', ['token'=> $token], function(Message $message) use($email) {
            $message->to($email);
            $message->subject('Reset your password');
        });
        return response([
            'message'=>'Check your email'
        ]);
      }catch(\Exception $exception){
        return response([
            'message'=> $exception->getMessage()
        ], 400);
      }
    }
    
    public function reset(Request $request){
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'password' => 'required',
            'password_confirmation' =>'required|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $token = $request->input('token');
        if(!$passwordResets = DB::table('password_resets')->where('token', $token)->first()){
            return response([
                'message'=>'Invalid token'
            ], 400);
        }

        if(!$user = User::where('email', $passwordResets->email)->first()){
            return response([
                'message'=>'User doesn\'t exist'
            ], 404);
        }

        $user->password= Hash::make($request->password);

        $user->save();
        return response([
            'message'=>'Your password reset successfully!'
        ], 200);

    }
}
