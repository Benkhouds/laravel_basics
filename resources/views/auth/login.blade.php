<x-layout>

    <main class="max-w-lg mx-auto mt-6 lg:mt-16 px-6 py-8 border border-gray-100 shadow rounded-lg">
        <form action="/login" method="POST">
            @csrf
            <h1 class="mb-4 font-bold text-gray-700 text-center text-2xl">Log In</h1>
            <x-forms.input :type="'email'" :name="'email'" />
            <x-forms.input :type="'password'" :name="'password'" />
            <x-forms.button :value="'Login'" />
        </form>
        @if($errors->has('auth'))
            {{--$errors->fail is used to access a bag , inside errors there are bags , the default one
                and names ones , inside an error bag could be an array of errors
            --}}
            <p class="text-red-400 text-sm mt-2">{{implode('<br>', $errors->get('auth'))}}</p>

       {{-- @else
          @dd($errors->has('auth'))--}}
        @endif

    </main>
</x-layout>
