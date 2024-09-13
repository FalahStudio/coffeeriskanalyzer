@extends('components.partials.layouts.user.main')

@section('content')
    <section>
        <div id="matrix-results" class="w-full h-full p-6 lg:p-10 overflow-hidden overflow-x-auto">
            <div class="flex flex-col gap-10 w-full">
                <div class="flex flex-row justify-between items-center">
                    <div class="flex flex-col gap-3">
                        <h5 class="font-semibold text-4xl text-neutral-950">Detil Proses</h5>
                        <p class="text-neutral-600 text-base">
                            Berikut adalah proses mendapatkan hasil analisis risiko dengan metode ISM dan Fuzzy FMEA
                        </p>
                    </div>
                    <button type="button"
                            class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none"
                            onclick="location.href='{{ route('history') }}'">
                        Kembali
                    </button>
                </div>

                <div class="grid grid-cols-5 gap-10 p-10 border border-neutral-400 rounded-lg">
                    <div id="header_step_1" class="flex flex-col gap-3 active">
                        <div id="header_box_1" class="w-10 h-10 text-neutral-50 shadow-md rounded">
                            <div id="header_box_data_1" class="bg-primary-700 rounded flex justify-center items-center p-2 font-semibold text-base">
                                1
                            </div>
                        </div>
                        <p id="header_text_1" class="text-sm font-medium text-primary-700">Structural Self Interaction Matrix</p>
                    </div>

                    <div id="header_step_2" class="flex flex-col gap-3">
                        <div id="header_box_2" class="w-10 h-10 text-neutral-950 shadow-md rounded">
                            <div id="header_box_data_2" class="bg-white rounded flex justify-center items-center p-2 font-semibold text-base">
                                2
                            </div>
                        </div>
                        <p id="header_text_2" class="text-sm font-medium text-neutral-600">Reachability Matrix</p>
                    </div>

                    <div id="header_step_3" class="flex flex-col gap-3">
                        <div id="header_box_3" class="w-10 h-10 text-neutral-950 shadow-md rounded">
                            <div id="header_box_data_3" class="bg-white rounded flex justify-center items-center p-2 font-semibold text-base">
                                3
                            </div>
                        </div>
                        <p id="header_text_3" class="text-sm font-medium text-neutral-600">Grafik MICMAC</p>
                    </div>

                    <div id="header_step_4" class="flex flex-col gap-3">
                        <div id="header_box_4" class="w-10 h-10 text-neutral-950 shadow-md rounded">
                            <div id="header_box_data_4" class="bg-white rounded flex justify-center items-center p-2 font-semibold text-base">
                                4
                            </div>
                        </div>
                        <p id="header_text_4" class="text-sm font-medium text-neutral-600">SOD & Linguistik Input</p>
                    </div>

                    <div id="header_step_5" class="flex flex-col gap-3">
                        <div id="header_box_5" class="w-10 h-10 text-neutral-950 shadow-md rounded">
                            <div id="header_box_data_5" class="bg-white rounded flex justify-center items-center p-2 font-semibold text-base">
                                5
                            </div>
                        </div>
                        <p id="header_text_5" class="text-sm font-medium text-neutral-600">FRPN / Result</p>
                    </div>
                </div>

                <div id="tabs-header-1" class="flex flex-col gap-6">
                    <div class="flex justify-end">
                        <button type="button"
                                class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none"
                                id="next-data-1" data-button-tab="next-tab">
                            Selanjutnya
                        </button>
                    </div>

                    <div class="flex flex-col gap-10">
                        @foreach ($result['ism']['data_input'] as $key => $item)
                            <div class="flex flex-col gap-6">
                                <p>Pakar {{ $key + 1 }}</p>

                                <div id="matrix-results_{{ $key + 1 }}" class="w-full overflow-hidden overflow-x-auto">
                                    <div id="processData_{{ $key + 1 }}" class="flex flex-col gap-10 w-full">
                                        <div id="matrix_{{ $key + 1 }}" class="flex flex-col gap-2" data-matrix="{{ $item }}" data-risk="{{ $result['risk']->risk }}"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div id="tabs-header-2" class="flex flex-col gap-6">
                    <div class="flex justify-between">
                        <button type="button"
                                class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none"
                                id="prev-data-2" data-button-tab="prev-tab">
                            Sebelumnya
                        </button>
                        <button type="button"
                                class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none"
                                id="next-data-2" data-button-tab="next-tab">
                            Selanjutnya
                        </button>
                    </div>
                    
                    <div class="flex flex-col gap-10">
                       <div class="flex flex-col gap-6">

                            <div id="matrix-binner" class="w-full overflow-hidden overflow-x-auto">
                                <div id="process_binner" class="flex flex-col gap-10 w-full">
                                    <div id="matrix_data_binner" class="flex flex-col gap-2" data-matrix="{{ $result['ism']['biner_conclusion'] }}" data-risk="{{ $result['risk']->risk }}"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div id="tabs-header-3" class="flex flex-col gap-6">
                    <div class="flex justify-between">
                        <button type="button"
                                class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none"
                                id="prev-data-3" data-button-tab="prev-tab">
                            Sebelumnya
                        </button>
                        <button type="button"
                                class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none"
                                id="next-data-3" data-button-tab="next-tab">
                            Selanjutnya
                        </button>
                    </div>
                    
                    <div class="flex flex-col-reverse lg:grid lg:grid-cols-12 gap-6">

                        <div class="lg:col-span-8 p-10 rounded-lg border border-neutral-400 w-full h-full">
                            <div class="w-full h-full">
                                <canvas class="!w-full !h-full" id="myChart" data-chart="{{ json_encode($result['chart']) }}" data-line="{{ json_encode($result['data_line_chart']) }}"></canvas>
                            </div>
                        </div>

                        <div class="lg:col-span-4 p-10 flex flex-col gap-6 rounded-lg border border-neutral-400">
                            <h5 class="text-center font-bold text-lg">Summary</h5>

                            <div class="grid grid-cols-3">
                                <div class="col-span-1 font-semibold text-base text-700">Independent</div>
                                <div class="col-span-2 text-base text-500">
                                    :
                                    @foreach ($result['ism']['data_result']['independent'] as $item)
                                        {{ 'E' . $item }}
                                    @endforeach
                                </div>
                            </div>
                            <div class="grid grid-cols-3">
                                <div class="col-span-1 font-semibold text-base text-700">Autonomous</div>
                                <div class="col-span-2 text-base text-500">
                                    : 
                                    @foreach ($result['ism']['data_result']['autonomous'] as $item)
                                        {{ 'E' . $item }}
                                    @endforeach
                                </div>
                            </div>
                            <div class="grid grid-cols-3">
                                <div class="col-span-1 font-semibold text-base text-700">Linkage</div>
                                <div class="col-span-2 text-base text-500">
                                    : 
                                    @foreach ($result['ism']['data_result']['linkage'] as $item)
                                        {{ 'E' . $item }}
                                    @endforeach
                                </div>
                            </div>
                            <div class="grid grid-cols-3">
                                <div class="col-span-1 font-semibold text-base text-700">Dependant</div>
                                <div class="col-span-2 text-base text-500">
                                    : 
                                    @foreach ($result['ism']['data_result']['dependent'] as $item)
                                        {{ 'E' . $item }}
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div id="tabs-header-4" class="flex flex-col gap-6">
                    <div class="flex justify-between">
                        <button type="button"
                                class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none"
                                id="prev-data-4" data-button-tab="prev-tab">
                            Sebelumnya
                        </button>
                        <button type="button"
                                class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none"
                                id="next-data-4" data-button-tab="next-tab">
                            Selanjutnya
                        </button>
                    </div>
                    
                    <div class="flex flex-col gap-4">
                        <h5 class="text-neutral-950 font-semibold text-base">Tabel SOD (Severity , Occurance, Detection)</h5>

                        <div class="relative overflow-x-auto border border-neutral-400 rounded-lg overflow-hidden">
                            <table class="w-full text-sm text-left text-neutral-800">
                                <thead class="text-xs text-neutral-800 uppercase bg-neutral-50 border-b border-neutral-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Kode Risiko
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Komponen Risiko
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-[#FEF6F6] text-center">
                                            S
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-[#FEF6F6] text-center">
                                            O
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-[#FEF6F6] text-center">
                                            D
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-[#F6FEF9] text-center">
                                            S
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-[#F6FEF9] text-center">
                                            O
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-[#F6FEF9] text-center">
                                            D
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-[#F6F9FE] text-center">
                                            S
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-[#F6F9FE] text-center">
                                            O
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-[#F6F9FE] text-center">
                                            D
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($sodData as $index => $item)
                                        <tr class="bg-white text-neutral-600 last:border-b-0 border-b border-neutral-400">
                                            <td scope="row" class="px-6 py-4 text-center">
                                                {{ $item['code'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $item['risk'] }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $item['s_expert1'] }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $item['o_expert1'] }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $item['d_expert1'] }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $item['s_expert2'] }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $item['o_expert2'] }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $item['d_expert2'] }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $item['s_expert3'] }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $item['o_expert3'] }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $item['d_expert3'] }}
                                            </td>
                                        </tr>
                                    @endforeach --}}

                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="flex flex-col gap-4">
                       <h5 class="text-neutral-950 font-semibold text-base">Tabel Linguistik</h5>

                       <div class="relative overflow-x-auto border border-neutral-400 rounded-lg overflow-hidden">
                            <table class="w-full text-sm text-left text-neutral-800">
                                <thead class="text-xs text-neutral-800 uppercase bg-neutral-50 border-b border-neutral-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Bobot Faktor
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-[#FEF6F6] text-center">
                                            S
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-[#FEF6F6] text-center">
                                            O
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-[#FEF6F6] text-center">
                                            D
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-[#F6FEF9] text-center">
                                            S
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-[#F6FEF9] text-center">
                                            O
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-[#F6FEF9] text-center">
                                            D
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-[#F6F9FE] text-center">
                                            S
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-[#F6F9FE] text-center">
                                            O
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-[#F6F9FE] text-center">
                                            D
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white text-neutral-600 last:border-b-0 border-b border-neutral-400">
                                        <td scope="row" class="px-6 py-4 text-center">
                                            Linguistik
                                        </td>
                                        {{-- @foreach ($linguistic as $index => $item)
                                            <td class="px-6 py-4 text-center">
                                                {{ $item }}
                                            </td>
                                        @endforeach --}}
                                        </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="flex flex-col gap-4">
                        <h5 class="text-neutral-950 font-semibold text-base">Keterangan</h5>

                        <div class="flex flex-col gap-3">
                            <div class="flex items-center gap-6">
                                <div class="w-20 h-6 bg-[#FEF6F6] rounded"></div>

                                <p class="text-neutral-600 text-sm">: Input dari Expert 1</p>
                            </div>
                            <div class="flex items-center gap-6">
                                <div class="w-20 h-6 bg-[#F6FEF9] rounded"></div>

                                <p class="text-neutral-600 text-sm">: Input dari Expert 2</p>
                            </div>
                            <div class="flex items-center gap-6">
                                <div class="w-20 h-6 bg-[#F6F9FE] rounded"></div>

                                <p class="text-neutral-600 text-sm">: Input dari Expert 3</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tabs-header-5" class="flex flex-col gap-6">
                    <div class="flex justify-start">
                        <button type="button"
                                class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none"
                                id="prev-data-5" data-button-tab="prev-tab">
                            Sebelumnya
                        </button>
                    </div>
                    
                    <div class="flex flex-col gap-10">
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
                                        @foreach ($result['frpn'] as $index => $item)
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

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/js/detailpage.js') }}"></script>
    <script src="{{ asset('assets/js/detail/pages_one.js') }}"></script>
    <script src="{{ asset('assets/js/detail/pages_two.js') }}"></script>
    <script src="{{ asset('assets/js/detail/chart.js') }}"></script>
@endpush