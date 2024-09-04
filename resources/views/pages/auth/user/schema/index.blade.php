@extends('components.partials.layouts.auth.user.main')

@section('content')
    <section class="flex flex-col gap-16">
        <form method="post" class="flex flex-col gap-5 w-full">
            @csrf 
            
            <div>
                <label for="schema" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih skema analitik yang akan anda isi</label>
                <select id="schema" class="select2 bg-white border {{ $errors->first('schema') ? 'border-red-500' : 'border-neutral-400 ' }} text-neutral-800 text-lg rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full py-3 px-4" name="schema">
                    <option value="" disabled selected hidden>Choose a country</option>
                    @foreach ($schemaData as $schema)
                        <option value="{{ $schema->id }}">Di Undang Tgl {{ \Carbon\Carbon::parse($schema->created_at)->setTimezone('Asia/Jakarta')->format('d F Y') }}</option>
                    @endforeach
                </select>

                @if($errors->first('schema'))
                    <p class="mt-2 text-sm text-red-500">{{ $errors->first('schema') }}</p>
                @endif
            </div>

            <x-button.index
                title="Mulai Sekarang"
                color="primary"
                buttonClass="justify-center w-full"
                weight="regular"
                type="submit"
            />

            <button class="rounded-lg text-neutral-600 font-semibold w-full p-3 hover:bg-neutral-50 ease-in-out duration-200" type="button" onclick="location.href='{{ route('home') }}'" >
                Kembali
            </button>
        </form>
    </section>
@endsection