<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ !empty($title) ? $title . ' | Risk Analysis Web Application' : 'Dashboard | Risk Analysis Web Application' }}</title>

    {{-- Resources --}}
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <x-partials.navbar.admin />

    <main class="mt-20">
        @yield('content')
    </main>
</body>
</html>