
@props(['active'=>false])
@php
  $classes = "block text-left px-3 leading-6 text-sm hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white";
  if($active) $classes .= ' bg-blue-600 text-white';
@endphp

<a  {{$attributes->merge(['class'=>$classes])}}>
    {{$slot}}
</a>
