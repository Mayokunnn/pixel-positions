<x-layout>
    <x-page-heading>Results</x-page-heading>

    <x-forms.form action="/search" class="mt-6">
        <x-forms.input name="q" placeholder="Web Developer..."/>
    </x-forms.form>
    @if(count($jobs) > 0)
        <p class="my-3">Search for jobs, employers and tags with <span class="italic font-semibold">"{{$query}}"</span>
        </p>
        <div class="space-y-6">
            @foreach($jobs as $job)
                <x-jobs.job-card :$job type="wide"/>
            @endforeach


        </div>
    @else
        <h1 class="text-center font-bold text-4xl capitalize mt-8"><span
                class="italic lowercase">"{{$query}}" </span>not found
        </h1>

    @endif
</x-layout>
