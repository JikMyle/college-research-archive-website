@props([
    'title' => 'CCIS Archive'
])

<!DOCTYPE html>
<html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col h-screen">
    <header class="flex flex-col z-10 w-full items-center top-0 left-0 bg-white dark:bg-transparent">
        <x-shared.top-nav-bar/>
        <div class="hidden dark:flex w-full border-b-2 border-divider-dark"></div>
    </header>

    <div class="flex flex-grow overflow-auto w-screen">
        {{ $slot }}
    </div>
    

    <div id="background" class="fixed top-0 left-0 bg-white dark:bg-transparent w-screen h-screen -z-10">
        <img 
            class="hidden dark:flex w-full h-full"
            src=" {{ asset('images/bg-dark.png')}} " 
            alt="dark mode background">
    </div>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;800&display=swap"/>
    <script src="{{asset('js/jquery-3.7.1.js')}}"></script>
    @vite('public/js/scripts.js')
</body>
</html>
