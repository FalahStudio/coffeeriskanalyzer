@extends('components.partials.layouts.admin.main')

@section('content')
    <section>
        <h3 class="text-center text-sm-display-semibold md:text-md-display-semibold text-neutral-950">Skema Analisis Risiko</h3>

        <div class="mt-8 md:mt-16">
            {{-- Tables --}}
            <x-table.index
                :columns="[
                    'Skema',
                    'Jumlah Variabel Risiko',
                    'Waktu Berakhir',
                    'Pakar / Credential',
                ]"
                :button=true
            >
                @foreach ($schemaData as $index => $data)
                    <tr class="border-b border-neutral-400">
                        <td class="text-center px-5 py-9">{{ $index + 1 }}</td>
                        <td class=" px-5 py-9">{{ $data->created_at }}</td>
                        <td class=" px-5 py-9">{{ $data->risk }}</td>
                        <td class=" px-5 py-9">{{ \Carbon\Carbon::parse($data->schema->end_date)->setTimezone('Asia/Jakarta')->format('d F Y') }}</td>
                        <td class=" px-5 py-9">
                            <li>{{ $data->schema->userCredential->userOne->email }}</li>
                            <li>{{ $data->schema->userCredential->userTwo->email }}</li>
                            <li>{{ $data->schema->userCredential->userThree->email }}</li>
                        </td>
                        <td class="px-5 py-9">
                            <div class="flex flex-col md:flex-row items-center justify-center gap-2">
                                <button type="button" class="flex flex-row gap-2 items-center p-2 hover:bg-neutral-200 rounded-lg">
                                @if ($data->schema->status)
                                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.15 5.6h.01m3.337 1.913h.01m-6.979 0h.01M5.541 11h.01M15 15h2.706a1.957 1.957 0 0 0 1.883-1.325A9 9 0 1 0 2.043 11.89 9.1 9.1 0 0 0 7.2 19.1a8.62 8.62 0 0 0 3.769.9A2.013 2.013 0 0 0 13 18v-.857A2.034 2.034 0 0 1 15 15Z"/>
                                        </svg>

                                        Lihat
                                    </button>
                                @endif
                                <button id="duplicate_button" type="button" class="flex flex-row gap-2 items-center p-2 hover:bg-neutral-200 rounded-lg" data-modal-target="add_risk" data-modal-toggle="add_risk" data-schema-risk="{{ $data->id }}">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.15 5.6h.01m3.337 1.913h.01m-6.979 0h.01M5.541 11h.01M15 15h2.706a1.957 1.957 0 0 0 1.883-1.325A9 9 0 1 0 2.043 11.89 9.1 9.1 0 0 0 7.2 19.1a8.62 8.62 0 0 0 3.769.9A2.013 2.013 0 0 0 13 18v-.857A2.034 2.034 0 0 1 15 15Z"/>
                                    </svg>

                                    Duplikasi
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-table.index>

        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/tables.js') }}"></script>
    <script src="{{ asset('assets/js/modalNextButton.js') }}"></script>
@endpush