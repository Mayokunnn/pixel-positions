<x-layout>
    <div class="space-y-10">
        <section class="text-center pt-6">
            <h1 class="font-bold text-4xl">Let's Find Your Next Job</h1>

            <x-forms.form action="/search" class="mt-6">
                <x-forms.input name="q" placeholder="Web Developer..."/>
            </x-forms.form>
        </section>
        <section class="pt-10">
            <x-jobs.section-heading>Top Jobs</x-jobs.section-heading>

            <div class="grid lg:grid-cols-3 gap-8 mt-6">
                @foreach($featured_jobs as $job)
                    <x-jobs.job-card :$job type="normal"/>
                @endforeach
            </div>

        </section>
        <section>
            <x-jobs.section-heading>Tags</x-jobs.section-heading>

            <div class="flex flex-wrap mt-6 gap-1">
                @foreach($tags as $tag)
                    <x-jobs.tag :$tag/>
                @endforeach
            </div>
        </section>
        <section>
            <x-jobs.section-heading>Recent Jobs</x-jobs.section-heading>

            <div class="mt-6 space-y-6">
                @foreach($jobs as $job)
                    <x-jobs.job-card :$job type="wide"/>
                @endforeach
            </div>
        </section>
    </div>
</x-layout>
