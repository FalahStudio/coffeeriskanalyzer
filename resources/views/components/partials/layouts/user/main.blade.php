<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ !empty($title) ? $title . ' | Risk Analysis Web Application' : 'Dashboard | Risk Analysis Web Application' }}</title>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    {{-- Resources --}}
    @vite(['resources/css/app.css','resources/js/app.js'])

    {{-- DataTable --}}
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.tailwindcss.min.css" rel="stylesheet">
</head>
<body>
    <x-partials.navbar.user />

    <x-toast/>

    <main class="mt-10 md:mt-20 max-w-screen-2xl mx-auto px-10">
        @yield('content')
    </main>

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    {{-- DataTable --}}
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    {{-- DatePicker --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Toast --}}
    <script src="{{ asset('assets/js/toast.js') }}"></script>

    @stack('scripts')
</body>
</html>