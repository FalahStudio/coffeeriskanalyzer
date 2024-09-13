@extends('components.partials.layouts.auth.user.main')

@section('content')
    <section class="flex flex-col gap-16">
        <div class="flex flex-col gap-10 items-center w-full">
            <form method="post" class="flex flex-col gap-5 w-full">
                @csrf 
                <x-input.inputField
                    inputId="email"
                    type="email"
                    label="Masukkan email anda yang telah didaftarkan admin"
                    placeholder="Masukkan email anda disini"
                    :required="false"
                />

                <x-button.index
                    title="Masuk"
                    color="primary"
                    buttonClass="justify-center w-full"
                    weight="regular"
                    type="submit"
                />
            </form>         
        </div>

        <div class="flex flex-col gap-2 text-neutral-600 text-md-body-regular">
            <p>Catatan:</p>
            <p>Jika anda sudah pernah mengakses sebelumnya dan dalam proses mengisi analisis, silahkan pilih sebagai pengguna lama</p>
        </div>
    </section>

    <section class="mt-4">
        <div class="flex flex-col gap-2">
            <p class="text-neutral-800 text-lg-body-semibold">Lihat hasil analisis terdahulu</p>
            <div>
                <a href="{{ route('history') }}" class="text-md-body-regular text-primary-600">Klik disini</a>
            </div>
        </div>        
    </section>
@endsection