<x-dropdown>
    <x-slot name="trigger">
        {{isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories'}}
        <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;"/>
    </x-slot>

    <x-dropdown-item href="/" :active="request()->routeIs('home') && !request()->query('category')">All</x-dropdown-item>
    {{--request()->is('categories/category_slug') ==> checking the uri  --}}
    @php
         $queryString= '';
          if(count(request()->except('category', 'page'))){
             $queryString = '&'.http_build_query(request()->except('category', 'page')) ;
           }
    @endphp
    @foreach($categories as $category)
        <x-dropdown-item href="/?category={{$category->slug}}{{$queryString}}"
                         {{--:active="isset($currentCategory) && $currentCategory->is($category)"--}}
                         :active=' request("category") === $category->slug'
                         {{--request()->query('name') --}}
                         {{--request()->input('name') ==> retrieves inputs from both post and get requests  --}}
                         {{--request()->all() retrieves all the inputs (both post and get) --}}
                         {{--request()->collect() retrieves all the inputs into a collection (both post and get) --}}
        >
            {{ucwords($category->name)}}
        </x-dropdown-item>
    @endforeach
</x-dropdown>
