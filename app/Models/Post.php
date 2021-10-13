<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;
    protected $guarded = []; //everything can be mass assigned except the provided fields
    //another approach is to never use mass assignment,so it doesn't matter if the guarded array is empty (internal rule)
    //protected $fillable = ['title', 'excerpt', 'body']; //permission to change only these three fields
    /*public function getRouteKeyName() : string
    {
         //return parent::getRouteKeyName(); //the default (id)
        //return 'slug' ; if you want to change the identifier for all routes
    }*/
    //protected $with = ['category', 'author'];
    //if you don't want to populate these fields in some specific queries
    //you can use the without method , Post::without()->first()
    //or if you want to exclude a specific fields, Post::without(['category', ...])
    //this will populate the category and author field every time you fetch a post

    //when you call $post->category, it will search for this relationship and assume that the
    //foreign key is category_id
    public function scopeFilter($query, array $filters): void
    {
       //you can access this method with using only filter on Post instance , $post->filter()
        $query->when($filters['search'] ?? false , function($query, $search){
            return $query->where(fn($query)=>
                   $query->where('title', 'like', '%'.$search.'%')
                         ->orWhere('body', 'like', '%'.$search.'%')
            );
        });

        $query->when($filters['category'] ?? false , function($query, $category){
            return $query->whereExists(function($query) use ($category){
                return $query->from('categories')
                             ->whereColumn('categories.id', 'posts.category_id')
                             ->where('slug', $category);
            });
        });


        $query->when($filters['author'] ?? false, fn($query, $author)=>
                $query->whereHas('author', fn($query)=>$query->where('username', $author))
        );

        //whereHas looks for relationship
        //Posts where each post's category (matches bases on the relationship) has a slug that's equal to the input
        //$query->whereHas('category', fn($query)=>$query->where('slug', $category))


    }
   public function scopeSort($query, string $column='' ) : void{

        if($column === 'comments') {
            $query->withCount('comments')->orderBy('comments_count', 'desc');
        }
        else if($column){
            $query->orderBy($column , 'desc');
        }
        else{
            $query->latest();
        }
   }
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        //in the belongsTo method it assumes that the foreign key is author_id
        //you can pass a second argument to override it
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }

}
