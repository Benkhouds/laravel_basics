@props(['comment'])
<article class="bg-gray-50 rounded ring-1 ring-gray-200 shadow p-4">
    <div>
        <header class="flex">
            <img src="https://i.pravatar.cc/60/?u={{$comment->author->id}}" alt="" width="60" height="60" class="rounded-xl">
            <div class="ml-4">
                <h3 class="font-semibold">{{$comment->author->name}}</h3>
                <p class="text-sm text-gray-400">Posted <time>{{$comment->created_at->diffForHumans()}}</time></p>
            </div>
        </header>
        <p class="mt-4 text-gray-600">
            {{$comment->body}}
        </p>
    </div>
</article>
