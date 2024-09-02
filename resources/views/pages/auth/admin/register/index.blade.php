@extends('components.partials.layouts.auth.admin.main')

@section('content')
    <section>
        <form method="post" class="flex flex-col gap-5">
            @csrf 
            <x-input.inputField
                inputId="email"
                type="email"
                label="Email"
                placeholder="Masukkan email anda disini"
                :required="false"
            />
        
            <x-input.inputField
                inputId="password"
                type="password"
                label="Password"
                placeholder="Masukkan password anda disini"
                :required="false"
            />
        
            <x-input.inputField
                inputId="confirm_password"
                type="password"
                label="Password"
                placeholder="Konfirmasi password anda disini"
                :required="false"
            />

            <x-button.index
                title="Masuk"
                color="primary"
                buttonClass="justify-center w-full"
                weight="regular"
            />
        </form>
    </section>
@endsection