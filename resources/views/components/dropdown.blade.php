

<div class="relative" x-data="{show : false}" @click.away="show=false" @keyup.escape="show=false">
    <button @click="show = !show"{{$attributes->merge(["class"=>'focus:ring-2 focus:ring-gray-600
                    rounded-xl py-2 px-4 text-sm font-semibold w-full lg:w-36 text-left flex'])}}
    >
        {{$trigger}}
    </button>

    <div x-show="show" class="w-full py-2 absolute bg-gray-100 mt-2 rounded-xl z-50 max-h-52 overflow-auto" style="display:none">
        {{$slot}}
    </div>
</div>
