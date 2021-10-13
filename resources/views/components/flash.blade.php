@props(['type'])
<div x-data="{visible:true}"
         x-init="setTimeout(()=>visible=false, 3000)"
         x-show="visible"
         {{$attributes(['class'=>"fixed top-3 left-1/2 transform -translate-x-1/2 text-white px-4 py-2 rounded-xl"])}}
    >
       @if($type==='success')
         <p>{{session()->get('success') }}</p>
       @elseif($type === 'fail')
         <p>{{session()->get('errors')->fail->first() }}</p>
       @endif
</div>



