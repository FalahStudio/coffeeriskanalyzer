@extends('components.partials.layouts.user.main')

@section('content')
    <section class="mx-auto h-full max-w-4xl w-full flex flex-col justify-between gap-5">
        
        <div class="flex flex-col justify-center  gap-10 h-full">
            <div class="flex flex-col gap-6 items-center">
                <h5 class="text-md-display-semibold text-neutral-950">Harap Tunggu</h5>
                <p class="text-md-body-regular text-center text-neutral-600 w-full lg:w-3/4">Anda dapat melanjutkan pengisian dan melihat hasil analisis resiko setelah 2 pakar lainnya telah mengisi</p>
            </div>

            <div class="w-full h-[204px]">
                <div class="w-full h-full overflow-hidden rounded-lg">
                    <img src="{{ asset('assets/images/background/bg-waiting.png') }}" alt="Background for waiting from unsplah" class="w-full h-full object-cover object-center">
                </div>
            </div>
        </div>
        
    </section>
@endsection