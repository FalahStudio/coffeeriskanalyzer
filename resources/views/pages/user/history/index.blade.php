@extends('components.partials.layouts.user.main')

@section('content')
    <section>
        
        <div id="matrix-results" class="w-full h-full p-6 lg:p-10 overflow-hidden overflow-x-auto">

            <div class="flex flex-col gap-20 w-full">
                <div class="flex flex-row justify-between items-center">

                    <div class="flex flex-col gap-3">
                        <h5 class="font-semibold text-4xl text-neutral-950">Analisis Terdahulu</h5>
                        <p class="text-neutral-600 text-base">Berikut adalah hasil analisis terdahulu yang pernah dilakukan</p>
                    </div>

                    <button type="button"
                            class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none"
                            onclick="location.href='{{ route('home') }}'">
                        Kembali
                    </button>

                </div>

                <x-table.index
                    :columns="[
                        'Analisis Risiko',
                        'Pakar',
                        'Link Detil',
                    ]"
                    :button="false"
                    :headerTable="true"
                    :action="false"
                >
                    @foreach ($dataProcess as $key => $item)
                        {{-- @dd($item['fuzzy']->schema->created_at) --}}
                        <tr class="border-b border-neutral-400">
                            <td scope="row" class="p-4 text-center">
                                {{ $key++ + 1}}
                            </td>
                            <td class="p-4">
                                {{ $item['fuzzy']->schema->created_at }}
                            </td>
                            <td class="p-4">
                                <li>
                                    {{ $item['fuzzy']->schema->userCredential->userOne->email }}
                                </li>
                                <li>
                                    {{ $item['fuzzy']->schema->userCredential->userTwo->email }}
                                </li>
                                <li>
                                    {{ $item['fuzzy']->schema->userCredential->userThree->email }}
                                </li>
                            </td>
                            <td class="p-4">
                                <a 
                                    class="text-primary-600 hover:text-primary-800"
                                    href="{{ route('detail', ['schemaId' => $item['schemaId']]) }}"
                                >
                                    Klik Disini
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </x-table.index>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/tables.js') }}"></script>
@endpush