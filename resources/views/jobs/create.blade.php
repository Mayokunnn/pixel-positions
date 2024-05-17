<x-layout>
    <x-page-heading>New Job</x-page-heading>

    <x-forms.form method="POST" action="/jobs" enctype="multipart/form-data">
        <x-forms.input label="Job Title" name="title" placeholder="CEO"/>

        <x-forms.input label="Salary" name="salary" placeholder="$ 50,000 USD"/>

        <x-forms.input label="Location" name="location" placeholder="Kofo Abayomi, Victoria Island"/>

        <x-forms.select name="schedule" label="Schedule">
            <option>Full Time</option>
            <option>Part Time</option>
        </x-forms.select>

        <x-forms.input label="URL" name="url" placeholder="https://acme.com.jobs/ceo-wanted"/>

        <x-forms.checkbox name="featured" label="Featured(Costs Extra)"/>

        <x-forms.divider/>

        <x-forms.input label="Tags (comma seperated)" name="tags" placeholder="frontend, video, education"/>

        <x-forms.button>Publish</x-forms.button>
    </x-forms.form>
</x-layout>


