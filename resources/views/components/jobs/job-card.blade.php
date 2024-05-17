@props(['type' => 'normal', 'job'])
@if($type === 'normal')
    <x-jobs.panel class="text-center flex-col">
        <div class="self-start text-sm">{{$job->employer->name}}</div>
        <div class="py-8 ">
            <h3 class="group-hover:text-blue-600 text-xl font-bold transition-colors duration-300">
                <a target="_blank" href="{{$job->url}}">{{$job->title}}</a>
            </h3>
            <p class="text-sm mt-4">{{$job->schedule}} - From {{$job->salary}}</p>
        </div>
        <div class="flex justify-between items-center mt-auto">
            <div>
                @foreach($job->tags as $tag)
                    <x-jobs.tag size="small" :$tag/>
                @endforeach

            </div>

            <x-jobs.employer-logo :employer="$job->employer" :width="42"/>
        </div>
    </x-jobs.panel>
@endif
@if($type === 'wide')
    <x-jobs.panel class="gap-x-6 ">
        <div>
            <x-jobs.employer-logo :employer="$job->employer"/>
        </div>
        <div class="flex-1 flex flex-col">
            <a href="#" class="text-sm text-gray-400">{{$job->employer->name}}</a>
            <h3 class="group-hover:text-blue-600 font-bold text-xl mt-3 transition-colors duration-300 ">
                <a target="_blank" href="{{$job->url}}">{{$job->title}}</a></h3>
            <p class="text-sm text-gray-500 mt-auto">{{$job->schedule}} - From {{$job->salary}}</p>
        </div>
        <div class="">
            <div>
                @foreach($job->tags as $tag)
                    <x-jobs.tag :$tag/>
                @endforeach
            </div>

        </div>
    </x-jobs.panel>
@endif
