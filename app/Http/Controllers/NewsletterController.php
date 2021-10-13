<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class NewsletterController extends Controller
{

    public function __invoke(Newsletter $newsletter, Request $request): RedirectResponse
    {


        $attributes =$request->validate([
            'email'=> ['required', 'email']
        ]);

        try{
            $newsletter->subscribe($attributes['email']);
            return back()->with('success','you subscribed to our newsletter');
        }
        catch(\Exception $e){

             return back()->withErrors('Error occurred please retry subscribing again', 'fail');
        }

    }
}
