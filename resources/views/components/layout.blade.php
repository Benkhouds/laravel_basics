<!doctype html>

<title>Laravel From Scratch Blog</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>
    html{
        scroll-behavior: smooth;
    }

    ::-webkit-scrollbar {
        width: 8px;
        background: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 5px;
        height: 150px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
<body style="font-family: Open Sans, sans-serif">
<section class="px-6 py-8">
    <nav class="md:flex md:justify-between md:items-center">
        <div>
            <a href="/">
                <img src="/images/logo.svg" alt="Laracasts Logo" width="165" height="16">
            </a>
        </div>

        <div class="mt-8 md:mt-0 flex items-center">
            @guest
                <a href="/register" class="text-xs font-bold uppercase">Register</a>
                <a href="/login" class="text-xs font-bold uppercase ml-4">Login</a>
            @else
                <x-dropdown class="lg:w-max ring-1 ring-gray-300 rounded-full">
                    <x-slot name="trigger">
                           {{auth()->user()->name }}
                    </x-slot>

                     <x-dropdown-item href="/posts/create" :active="request()->routeIs('/posts/create')">
                         Posts
                     </x-dropdown-item>
                    <x-dropdown-item href="/dashboard" :active="request()->is('/dashboard')">
                        Dashboard
                    </x-dropdown-item>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit"
                                class="block text-left px-3 leading-6 text-sm
                                hover:bg-blue-500 focus:bg-blue-500 hover:text-white
                                focus:text-white w-full"
                        >
                            Logout
                        </button>
                    </form>

                </x-dropdown>

            @endguest
            <a href="#newsletter" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                Subscribe for Updates
            </a>
        </div>
    </nav>
    {{$slot}}
    <footer id="newsletter" class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
        <img src="/images/lary-newsletter-icon.svg" alt="" class="mx-auto -mb-6" style="width: 145px;">
        <h5 class="text-3xl">Stay in touch with the latest posts</h5>
        <p class="text-sm mt-3">Promise to keep the inbox clean. No bugs.</p>

        <div class="mt-10">
            <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

                <form method="POST" action="/newsletter" class="lg:flex text-sm">
                    @csrf
                    <div class="lg:py-3 lg:px-5 flex items-center">
                        <label for="email" class="hidden lg:inline-block">
                            <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                        </label>
                        <div>
                            <input id="email"
                                   type="text"
                                   name="email"
                                   placeholder="Your email address"
                                   class="lg:bg-transparent  py-2 lg:py-0 pl-4 focus-within:outline-none">

                        </div>
                    </div>
                    <button type="submit"
                            class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8"
                    >
                        Subscribe
                    </button>
                    @error('email')
                        <span class="absolute -bottom-7 left-6 text-sm text-red-400">{{$message}}</span>
                    @enderror
                </form>
            </div>
        </div>
    </footer>
    @if(session()->has('success'))
        <x-flash class="bg-green-300" :type="'success'"/>
    @elseif(session()->has('errors') && count($errors->fail))
        <x-flash class="bg-red-400" :type="'fail'"/>
    @endif
</section>
</body>

