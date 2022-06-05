<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function regist(Request $request){

        $validate= Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if ($validate->fails()) {
            return response()->json(["messege"=>"Registration failed"]);
        }
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return response()->json(["messege"=>"Registration succese"]);

    }
    public function login(Request $request){
        $validate= Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if ($validate->fails()) {
            return response()->json(["messege"=>"login faildown!, rewrite email or password"]);
        }

        $date = request(['email','password']);
        if (!Auth::attempt($date )) {
            return response()->json(["messege"=>"unauthorized"]);
        }
        return $user=User::where('email',$request['email'])->first();
        $token=$user->createToken('token')->plainTextToken;
        return response()->json(["your token is"=>$token]);

    }
    public function logout(Request $request){

        $request->user()->currentAccessToken()->delete();
        return response()->json(["messege"=>"goodbye!"]);
    }
}
