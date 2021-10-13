<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class SessionsController extends Controller
{

    public function create(): View {
        return view('auth.login');
    }

    public function store(Request $request) : RedirectResponse{

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials)) {


            $request->session()->regenerate();
            //if you have a protected route and the user is not yet authenticated
            //use redirect()->intended() after logging the user in
            //for example the user wanted to access '/premium_content'
            //you would register the intended route using redirect()->guest('login')
            //and then in the login controller or middleware you redirect them to the intended route
            //if none provided the user would be redirected to the default path (in this case '/')
            return redirect()->intended('/')->with('success', "You're logged in");
        }

        //auth fail
       // throw ValidationException::withMessages([ 'auth' => 'The provided credentials do not match our records.']);
        return back()->withErrors(['auth'=>'The provided credentials do not match our records.', 'second'=>'king']);

    }
    public function destroy(Request $request) : RedirectResponse {
        auth()->logout();
        //deleting the current session
        $request->session()->invalidate();
        //regenerating a new session token
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You logged out');

        //Auth::logoutOtherDevices($currentPassword); check guards

        //confirming the password before taking an action
        /*
         * Route::get('/confirm-password', function () {
            return view('auth.confirm-password');
            })->middleware('auth')->name('password.confirm');
        */

        /*
         * Route::post('/confirm-password', function (Request $request) {
                if (! Hash::check($request->password, $request->user()->password)) {
                    return back()->withErrors([
                        'password' => ['The provided password does not match our records.']
                    ]);
                }

                $request->session()->passwordConfirmed();

                return redirect()->intended();
            })->middleware(['auth', 'throttle:6,1'])->name('password.confirm');
            */

            /*Route::get('/settings', function () {
                // ...
            })->middleware(['password.confirm']);

            Route::post('/settings', function () {
                // ...
            })->middleware(['password.confirm']);*/

    }
}
