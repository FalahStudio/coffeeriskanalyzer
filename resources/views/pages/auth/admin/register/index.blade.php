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
                :error="$errors->first('email')"
            />
        
            <x-input.inputField
                inputId="password"
                type="password"
                label="Password"
                placeholder="Masukkan password anda disini"
                :required="false"
                :error="$errors->first('password')"
            />
        
            <x-input.inputField
                inputId="password_confirmation"
                type="password"
                label="Password"
                placeholder="Konfirmasi password anda disini"
                :required="false"
                :error="$errors->first('password_confirmation')"
            />

            <x-button.index
                title="Masuk"
                color="primary"
                buttonClass="justify-center w-full"
                weight="regular"
                type="submit"
            />
        </form>
    </section>
@endsection