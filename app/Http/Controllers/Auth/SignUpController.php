<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SignUpController extends Controller
{
    public function __invoke(Request $data)
    {
        $user = new User();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = Hash::make($data->password);

        $user->save();

        $role = Role::where('name', '=', $data->type)->get()[0];
        $user->roles()->attach($role);

        if (!$token = auth()->attempt($data->only('email', 'password'))) {
            return response(null, 401);
        }
        return response()->json(compact('token'));
    }
}
