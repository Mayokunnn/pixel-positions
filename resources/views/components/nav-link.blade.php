@props(['active' => false])

@php
    $activeClass = $active  ? ' border-white border-b-2 pb-0.5 font-semibold' : 'border-b-2 pb-0.5 font-semibold border-transparent';
    $defaults = [
        'href' => '/',
        'class' => $activeClass,
    ];
@endphp

<a {{$attributes->merge($defaults)}} >{{$slot}}</a>
