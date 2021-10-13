<x-layout>

    <main class="max-w-lg mx-auto mt-6 lg:mt-16 px-6 py-8 border border-gray-100 shadow rounded-lg">

        <form action="/register" method="POST">
            @csrf
            <h1 class="mb-4 font-bold text-gray-700 text-center text-2xl">Register</h1>
            <x-forms.input :name="'name'" />
            <x-forms.input :name="'username'" />
            <x-forms.input :name="'email'" :type="'email'"/>
            <x-forms.input :name="'password'" :type="'password'"/>

            <div>
                <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white tracking-wider font-medium
                         rounded shadow hover:bg-blue-600 "
                >
                    Register
                </button>
            </div>

        </form>
        @if($errors->any())
            <ul class="list-disc ml-3">
                @foreach($errors->all() as $error)
                     <li class="text-red-400 text-sm mt-2">{{$error}}</li>
                @endforeach
            </ul>
        @endif



    </main>
</x-layout>
