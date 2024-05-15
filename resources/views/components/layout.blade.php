<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pixel Positions</title>
    @vite('resources/css/app.js')
</head>
<body>
    <div>
        <nav>
            <div>
                <a href="/">
                    <img src="{{Vite::asset('resources/images/logo.svg')}}" alt="Pixel Positions" >
                </a>
            </div>
            <div>Links</div>
            <div>Post</div>
        </nav>
        <main>
            {{$slot}}
        </main>
    </div>
</body>
</html>
