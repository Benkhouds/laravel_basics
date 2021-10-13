<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(){
        //File::allFiles does the same thing
        /*DB::listen(function($query){
            logger($query->sql, $query->bindings);
        });*/

        return view('posts.index',[
            //with is used to perform a join query
            //orderBy(field, 'desc'||'asc')
            //you can also order by latest or oldest using the created_at column (you can specify another field)
            //request()->only('search') would return ['search'=> 'searched term'] ====> equivalent to request(['search'])
            'posts'=>Post::sort(request('sort') ?? '')->filter(request(['search', 'category', 'author']))->with('category', 'author')
                                   ->paginate(6)->withQueryString()
        ]);
    }
    public function show(Post $post){
            return view('posts.singlePost',[
                'singlePost'=> $post->load('category', 'author', 'comments'),
            ]);
    }

    public function create() : View {
        return view('posts.create');
    }
    public function store(Request $request) : void {

        $attributes = $request->validate([
            'title'=>'required',
            'slug'=>[Rule::unique('posts', 'slug')],
            'excerpt'=>'required',
            'thumbnail'=> ['required', 'image'],
            'body'=>'required',
        ]);
        if($request->file('thumbnail')){

             $request->file('thumbnail')->store('thumbnail');
        }

    }



}
