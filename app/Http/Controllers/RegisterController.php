<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisterController extends Controller
{

    public function create() : View {
        return view('auth.register');
    }

    public function store(Request $request) : RedirectResponse {

            $attributes = $request->validate([
                'name'=>['required', 'min:4','max:255'] ,
                'username'=> ['required','min:3','max:255',   Rule::unique('users', 'username')],
                'email'=>['required', 'max:255','email',Rule::unique('users', 'email')],
                'password'=>['required','min:6', 'max:255']
            ]);
            $user = User::create($attributes);
             auth()->login($user);
            //session()->flash('success', 'user created successfully');
            return redirect('/')->with('success', 'User has been created successfully');

    }
}
