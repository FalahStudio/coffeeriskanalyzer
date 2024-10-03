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
                                        <i class="iconsax text-2xl" icon-name="eye"></i>

                                        Lihat
                                    </button>
                                @endif
                                <button id="duplicate_button" type="button" class="flex flex-row gap-2 items-center p-2 hover:bg-neutral-200 rounded-lg" data-modal-target="add_risk" data-modal-toggle="add_risk" data-schema-risk="{{ $data->id }}">
                                    <i class="iconsax text-2xl" icon-name="brush-1"></i>

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
