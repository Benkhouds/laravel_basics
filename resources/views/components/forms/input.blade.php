
@props(['name', 'type'=>'text'])
<div class="mb-6">
    <label for="{{$name}}" class="block capitalize font-semibold text-gray-600 mb-3">{{$name}}</label>
    <input type="{{$type}}"
           name="{{$name}}"
           id="{{$name}}"
           class="p-2 w-full border border-gray-100 rounded outline-none ring-1 ring-gray-200
                               focus:ring-gray-400 focus:shadow "
           required
    >
    @error($name)
        <p class="text-red-400 text-sm font-medium mt-2 ">{{$message}}</p>
    @enderror
</div>
