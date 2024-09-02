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

    <main class="grid grid-cols-1 mx-auto h-screen max-w-4xl w-full gap-10">
        <div class="w-full h-full hidden lg:block">
            <div class="relative w-full h-full">
                <div class="h-screen overflow-hidden w-full">
                    <img src="{{ asset('assets/images/bg-auth.png') }}" alt="background auth from unsplash" class="h-full w-full object-cover object-center" />
                </div>
            </div>
        </div>
        
        <div class="w-full h-full py-8 px-8 flex flex-col justify-between gap-8">
            <div class="flex flex-col gap-16 justify-center h-full">
                <div class="flex flex-col gap-6 items-center">
                    <h5 class="font-semibold text-3xl text-center">Risk Analysis Web Application</h5>
                    <p class="text-base text-neutral-600 w-full lg:w-3/4 text-center">Aplikasi web yang mempermudah dan meningkatkan akurasi dalam menganalisis risiko kopi untuk kebutuhan Anda.</p>
                </div>

                @yield('content')
            </div>

            <p class="text-center w-full text-neutral-500">
                &copy; {{ date('Y') }} Aiman - All Right Reserved
            </p>
        </div>
    </main>

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    @stack('scripts')
</body>
</html>