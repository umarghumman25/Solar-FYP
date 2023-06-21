<?php

namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Admin;
use Illuminate\Foundation\Auth\Registersadmins;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class AController extends BaseController
{
    use DispatchesJobs, ValidatesRequests;
}

class RegisterController extends AController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new admins as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    // public function create(Request $request)
    // {
    //     return Admin::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => $request->password,
    //         'repassword' => $request->password_confirmation,
    //     ]);
    // }

    public function register(Request $request)
    {
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);

        return response()->json([
            'status' => 200,           
            'message' => 'Admin created In successfully',
        ]);
    }

    static public function login(Request $request)
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
            $admin = Admin::where('email', $request->email)->where('password', $request->password)->first();


            // $token =  $admin->createToken($admin->email . '_Token')->plainTextToken;

            return response()->json([
                'status' => 200,
                'adminname' => $admin->name,
                // 'token' => $token,
                'message' => 'Logged In successfully',
            ]);
        }
    }

    static public function ind(){
        
    }
}
