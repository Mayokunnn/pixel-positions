@props(['width' => 90, 'employer'])

<img src="{{asset($employer->logo)}}" class="rounded-xl " alt="{{$employer->name}} Logo" width="{{$width}}">
