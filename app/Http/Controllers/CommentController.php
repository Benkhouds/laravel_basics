<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store($post, Request $request): RedirectResponse
    {
         $attributes = $request->validate([
             'body'=>['required']
         ]);
         Comment::create([
             'user_id'=>$request->user()->id,
             'post_id'=>$post,
             'body'=>$attributes['body']
         ]);
         return back()->with('success', 'comment added successfully');

    }
}
