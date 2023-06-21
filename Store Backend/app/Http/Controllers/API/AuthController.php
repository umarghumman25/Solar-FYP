<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required',
            'age' => 'required',
            'phonenumber' => 'required',
            'email' => 'required|email|max:191',
            'address' => 'required',
            'password' => 'required|min:8',
            'repassword' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 405,
                'validation_errors' => $validator->messages(),
                'message' => 'Validation',

            ], 405);
        }
        // else
        // {
        //     $user=User::create([
        //         'name'=>$request->name,
        //         'age'=>$request->age,
        //         'phonenumber'=>$request->phonenumber,
        //         'email'=>$request->email,
        //         'address'=>$request->address,
        //         'password'=>$request->password,
        //         'repassword'=>Hash::make($request->password),
        //     ]);
        //    $token=  $user->createToken($user->email.'_Token')->plainTextToken;

        //    return response()->json([
        //     'status'=>200,
        //     'username'=>$user->name,
        //     'token'=> $token,
        //     'message'=> 'Registered successfully',
        //     ]);
        // }
        

        $user = User::create([
            'name' => $request->name,
            'age' => $request->age,
            'phonenumber' => $request->phonenumber,
            'email' => $request->email,
            'address' => $request->address,
            'password' => $request->password,
            'repassword' => $request->repassword,
        ]);
        $token =  $user->createToken($user->email . '_Token')->plainTextToken;
        $user->remember_token = $token;
        $user->save();

        return response()->json([
            'status' => 200,
            'username' => $user->name,
            'token' => $token,
            'message' => 'Registered successfully',
        ]);
    }

    public function login(Request $request)
    {
        $validator = validator::make($request->all(), [

            'email' => 'required|email|max:191',
            'password' => 'required|min:8',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->messages(),
            ]);
        } else {
            $user = User::where('email', $request->email)->first();

            // if (! $user || ! Hash::check($request->password, $user->password)) {
            if (!$user || ($request->password != $user->password)) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid Credentials',
                ]);
            } else {
                $token =  $user->createToken($user->email . '_Token')->plainTextToken;

                return response()->json([
                    'status' => 200,
                    'username' => $user->name,
                    'userid' => $user->id,
                    'token' => $token,
                    'message' => 'Logged In successfully',
                ]);
            }
        }
    }
}
