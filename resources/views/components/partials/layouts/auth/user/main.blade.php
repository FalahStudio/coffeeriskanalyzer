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

    {{-- Icon --}}
    <link href="https://iconsax.gitlab.io/i/icons.css" rel="stylesheet">

    {{-- Custom CSS --}}
    @yield('style')
</head>
<body>
    <x-toast/>

    <main class="grid {{ request()->is('/') ? 'md:grid-cols-2' : 'grid-cols-1 mx-auto max-w-4xl w-full' }} items-center h-screen gap-10">
        <div class="w-full h-full {{ request()->is('/') ? 'hidden lg:block' : 'hidden' }}">
            <div class="relative w-full h-full">
                <div class="h-screen overflow-hidden w-full">
                    <img src="{{ asset('assets/images/background/bg-auth.png') }}" alt="background auth from unsplash" class="h-full w-full object-cover object-center" />
                </div>
            </div>
        </div>

        <div class="w-full h-full py-8 px-8 flex flex-col justify-between gap-8 items-center">

            <div class="w-full flex justify-end">
                <div class="py-2.5 px-3.5 border border-neutral-400 rounded-lg cursor-pointer" data-tooltip-target="user-guide" data-tooltip-placement="left" onclick="location.href='{{ route('userguide')  }}'">
                    <i class="iconsax" icon-name="info-circle"></i>
                </div>

                <div id='user-guide' role='tooltip' class='absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-neutral-600 transition-opacity duration-300 bg-white rounded-lg tooltip shadow-[0px_4px_8px_-2px_#10182810,0px_4px_8px_-2px_#10182806] border border-neutral-300'>
                    Panduan Pemakaian
                    <div class='tooltip-arrow' data-popper-arrow></div>
                </div>
            </div>

            <div class="flex flex-col gap-16 justify-center h-full w-full">
                <div class="flex flex-col gap-6 items-center">
                    <h5 class="text-md-display-semibold text-center">{{ config('app.name')  }}</h5>
                    <p class="text-md-body-regular text-neutral-600 w-full text-center">
                       Aplikasi web yang mempermudah dan meningkatkan akurasi dalam menganalisis risiko kopi untuk kebutuhan Anda.
                    </p>
                </div>

                @yield('content')
            </div>

            <p class="text-center w-full text-neutral-600 text-sm-body-regular">
                &copy; {{ date('Y') . ' ' . config('app.name')}} - All Right Reserved
            </p>
        </div>
    </main>

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    {{-- Toast --}}
    <script src="{{ asset('assets/js/toast.js') }}"></script>

    @stack('scripts')
</body>
</html>
