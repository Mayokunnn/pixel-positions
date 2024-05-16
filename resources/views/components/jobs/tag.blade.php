@props(['size' => 'base', 'tag'])
@php
    $classes = "bg-white/10 rounded-xl font-bold transition-colors duration-300 hover:bg-white/25";
        if($size === 'base'){
             $classes .= " px-4 py-1 text-sm ";
        }
        if($size === 'small'){
            $classes .= " px-3 py-1 text-2xs ";
        }
@endphp

<a href="/tags/{{strtolower($tag->name)}}" {{$attributes->merge(['class' => $classes])}} >{{$tag->name}}</a>
