<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| General Routes
|--------------------------------------------------------------------------
*/
//test
Route::get('/test', TestController::class);
Route::get('/',[PostController::class, 'index'])->name('home');

Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth');

Route::get('/posts/{post:slug}', [PostController::class, 'show'])->middleware('auth');

Route::post('/posts/create', [PostController::class, 'store']);

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->middleware('auth');


Route::post('/newsletter', NewsletterController::class);

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');

Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/login', [SessionsController::class, 'create'])->middleware('guest')->name('login');

Route::post('/login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');









/*Route::get('/author/{author:username}', function(User $author){
    return view('posts.index', [
        'posts'=>$author->posts->load('category', 'author'),
        'categories'=>Category::all()
    ]);
});*/


/*Route::get('/posts/{post:slug}', function(Post $post){

   //the wildcard name should match the variable name !!!
    //automatically laravel would treat the wildcard as id
    //if you want it pointing to a  different column you should specify it explicitly
    return view('singlePost',[
        'singlePost'=> $post->load('category', 'author'), //Post::findOrFail($id)
    ]);
    //app_path();database_path(); base_path();
    $path = resource_path("/posts/{$slug}.html");
    if(!File::exists($path)){
         //return redirect('/');
         abort(404);
    }

    $post= cache()->remember("posts.{$slug}", now()->seconds(15), function() use($path){
        return file_get_contents($path);
    });
});*/



/*Route::get('/categories/{category:slug}', function(Category $category){
    return view('posts', [
        'posts'=>$category->posts->load('category', 'author'),
        'currentCategory'=>$category,
        'categories'=>Category::all()
    ]);
});*/

