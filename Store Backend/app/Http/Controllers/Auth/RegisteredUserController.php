<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // $request->validate([
        //     'name' => $request->name,
        //     'age' => $request->age,
        //     'phonenumber' => $request->phonenumber,
        //     'email' => $request->email,
        //     'address' => $request->address,
        //     'password' => Hash::make($request->password),
        //     'repassword' => Hash::make($request->repassword),
        // ]);

        $user = User::create([
            'name' => $request->name,
            'age' => 999,
            'phonenumber' => 9877777,
            'email' => $request->email,
            'address' => 'ooooooo',
            'password' => Hash::make($request->password),
            'repassword' => Hash::make($request->repassword),
        ]);
        return response()->json(['status' => 'here']);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
