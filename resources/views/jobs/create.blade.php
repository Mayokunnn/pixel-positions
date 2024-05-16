<x-layout>
    <x-page-heading>New Job</x-page-heading>

    <x-forms.form method="POST" action="/jobs" enctype="multipart/form-data">
        <x-forms.input label="Job Title" name="title" placeholder="CEO"/>
        <x-forms.input label="Salary" name="salary" placeholder="$ 50,000 USD"/>
        <x.forms.input label="Location" name="location" placeholder="Kofo Abayomi, Victoria Island"/>
        <x.forms.input label="URL" name="url" placeholder="https://acme.com.jobs/ceo-wanted"/>


        <x-forms.button>Post</x-forms.button>
    </x-forms.form>
</x-layout>
