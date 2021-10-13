@auth

<article class="rounded ring-1 ring-gray-200 shadow p-4">
    <form action="/posts/{{$singlePost->id}}/comments" method="POST">
        @csrf
        <header class="flex items-center mb-4">
            <img src="https://i.pravatar.cc/60/?u=12" alt="" width="60" height="60" class="rounded-full">
            <div class="ml-4">
                <h3 class="font-semibold">Hamza Ben Khoud</h3>
            </div>
        </header>
        <div>
            <textarea
                rows="5"
                placeholder="Write your comment"
                name="body"
                class="ring-1 ring-gray-200 w-full rounded p-2 outline-none focus:ring-gray-400 text-sm"
            ></textarea>
        </div>
        <div class="flex w-full justify-end mt-2">
            <button type="submit" class="py-3  px-5 bg-blue-500 rounded-full text-white"> Submit</button>
        </div>
    </form>

</article>
@else
    <article class="rounded ring-1 ring-gray-200 shadow p-4">
       <h3>Want to join the community ? <a href="/login" class="text-blue-500 hover:underline">Login</a>
           or <a href="/register"  class="text-blue-500 hover:underline">Register</a>
       </h3>
    </article>

@endauth
