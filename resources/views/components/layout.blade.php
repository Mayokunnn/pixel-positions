<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pixel Positions</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..600;1,100..60000&display=swap"
          rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-white font-hanken-grotesk pb-10">
<div class="px-10">
    <nav class="flex justify-between items-center py-4 border-b border-white/10">
        <div class="">
            <a href="/">
                <img src="{{Vite::asset('resources/images/logo.svg')}}" alt="Pixel Positions">
            </a>
        </div>
        <div class="space-x-6">
            <x-nav-link href="/" :active="request()->is('/')">Jobs</x-nav-link>
            <x-nav-link href="/careers" :active="request()->is('careers')">Careers</x-nav-link>
            <x-nav-link href="/salaries" :active="request()->is('salaries')">Salaries</x-nav-link>
            <x-nav-link href="/companies" :active="request()->is('companies')">Companies</x-nav-link>
        </div>
        @auth()
            <div class="flex gap-x-5">
                <a href="/jobs/create">Post a Job</a>
                <form action="/logout" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 cursor-pointer font-semibold">Log Out
                    </button>
                </form>
            </div>
        @endauth

        @guest()
            <div class="space-x-6">
                <x-nav-link href="/register" :active="request()->is('register')">Sign Up</x-nav-link>
                <x-nav-link href="/login" :active="request()->is('login')">Log In</x-nav-link>
            </div>
        @endguest
    </nav>
    <main class="mt-10 max-w-[986px] mx-auto">
        {{$slot}}
    </main>
</div>

</body>
</html>
