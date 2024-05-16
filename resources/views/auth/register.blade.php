<x-layout>
    <x-page-heading>Register</x-page-heading>

    <x-forms.form method="POST" action="/register" enctype="multipart/form-data">
        <x-forms.input label="Name" name="name"/>
        <x-forms.input label="Email" name="email" type="email"/>
        <x-forms.input label="Password" name="password" type="password"/>
        <x-forms.input label="Confirm Password" name="password_confirmation" type="password"/>

        <x-forms.divider/>

        <x-forms.input label="Employer Name" name="employer"/>
        <x-forms.input label="Logo" name="logo" type="file"
                       class="file:rounded-lg file:text-white file:bg-blue-500 file:border-0 file:px-2 file:py-1.5"/>


        <x-forms.button>Create Account</x-forms.button>
    </x-forms.form>
</x-layout>
