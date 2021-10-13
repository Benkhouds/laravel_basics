<x-layout >

    <section class="mt-24 px-6 py-8 flex max-w-6xl mx-auto rounded ring-2 ring-gray-100">
        <aside class="w-1/3">
            <ul class="divide-y-2 divide-gray-200 mr-2 mt-4 ring-2 ring-gray-100 rounded">
                <x-list-item :value="'Account'" />
                <x-list-item :value="'Add Post'" />
            </ul>
        </aside>
        <div class="p-4 flex-grow">
            <form method="POST" action="/posts/create" enctype="multipart/form-data" >
                @csrf
                <x-forms.input :name="'title'"/>
                <x-forms.input :name="'slug'"/>
                <x-forms.input :name="'thumbnail'" :type="'file'"/>
                <x-forms.textarea :name="'excerpt'"/>
                <x-forms.textarea :name="'body'"/>
                <x-forms.button :value="'submit'" />
            </form>
        </div>
    </section>
</x-layout>
