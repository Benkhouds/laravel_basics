
<x-layout>

    @include('posts._header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-16 space-y-6">
        @if($posts->count())
            <x-featured-post :post="$posts[0]"/>
            @if($posts->count() > 1)
                <x-posts-grid :posts="$posts->skip(1)"/>
            @endif
            {{$posts->links()}}
        @else
           <p class="font-bold text-gray-600 text-center"> No post has been published yet  </p>
        @endif
    </main>

</x-layout>
















{{--second approach--}}
{{-- @extends('components.layout')

 @section('content')
     @foreach($posts as $post)
         <article>
             <h1><a href="/posts/{{ $post->slug }}">{{ $post->title }} </a> </h1>
             <p>
                 {{$post->excerpt}}
                 --}}{{--escaped html--}}{{--
             </p>
         </article>
     @endforeach
 @endsection--}}
