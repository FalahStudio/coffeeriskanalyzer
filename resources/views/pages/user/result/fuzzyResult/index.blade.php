@extends('components.partials.layouts.user.main')

@section('content')
    <section>

        <div id="matrix-results" class="w-full h-full p-6 lg:p-10 overflow-hidden overflow-x-auto">

            <div class="flex flex-col gap-20 w-full">
                <div class="flex flex-row justify-between items-center">

                    <div class="flex flex-col gap-3">
                        <h5 class="font-semibold text-4xl text-neutral-950">Hasil Analisis</h5>
                        <p class="text-neutral-600 text-base">Berikut adalah hasil rank analisis risiko dengan metode ISM dan Fuzzy FMEA</p>
                    </div>

                    <button
                        class="h-full text-neutral-50 bg-primary-700 hover:bg-primary-800 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none"
                        type="button"
                        onclick="location.href='{{ route('detail', ['schemaId' => $schemaId]) }}'"
                    >
                        Detail Proses
                    </button>

                </div>

                <div class="w-full h-full flex justify-center items-center">
                    <div class="relative overflow-x-auto border border-neutral-400 rounded-lg overflow-hidden">
                        <table class="w-full text-sm text-left text-neutral-800">
                            <thead class="text-xs text-neutral-800 uppercase bg-neutral-50 border-b border-neutral-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Rank
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Komponen Risiko
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        FRPN
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Kode Risiko
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $index => $item)
                                    @php
                                        $bgColorClass = '';
                                        if ($index === 0) {
                                            $bgColorClass = 'bg-primary-200 text-neutral-800';
                                        } elseif ($index === 1) {
                                            $bgColorClass = 'bg-primary-100 text-neutral-700';
                                        } elseif ($index === 2) {
                                            $bgColorClass = 'bg-primary-50 text-neutral-600';
                                        } else {
                                            $bgColorClass = 'bg-white text-neutral-600';
                                        }
                                    @endphp
                                    <tr class="{{ $bgColorClass }} last:border-b-0 border-b border-neutral-400">
                                        <td scope="row" class="px-6 py-4 text-center">
                                            {{ $item['rank'] }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item['component'] }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ $item['frpn'] }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ $item['code'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
