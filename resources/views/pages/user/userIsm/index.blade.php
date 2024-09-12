@extends('components.partials.layouts.user.main')

@section('content')
    <section>
        
        <div id="matrix-results" class="hidden w-full p-6 lg:p-10 overflow-hidden overflow-x-auto">
            <form id="processData" class="flex flex-col gap-10 w-full" method="post">
                @csrf
                
                <div class="flex flex-row justify-between items-center">

                    <div class="flex flex-col gap-3">
                        <h5 class="font-semibold text-4xl text-neutral-950">Kuisioner Analisis Resiko Tahap I</h5>
                        <p class="text-neutral-600 text-base">Harap isi form dibawah ini dengan opsi jawaban yang telah disediakan</p>
                    </div>

                    <x-button.index
                        title="Proccess Data"
                        color="primary"
                        weight='semibold'
                        fontSize='sm'
                        iconSize='2.5'
                        iconMargin='ms-2.5'
                        :withModal="true"
                        modalType="confirmation"
                    />

                </div>

                {{-- Modal Confirmation --}}
                <x-modal.confirmation
                    title="Apakah data yang anda isi sudah benar?"
                    desc="Pastikan jawaban anda sudah benar, karena data tidak akan dapat di edit kembali setelah anda klik proses data"
                    cancelButton="Edit kembali"
                    confirmButton="Ya, Proses data"
                    :useForm="true"
                    formRoute="logout"
                />
                {{-- End Modal Confirmation --}}

                {{-- Description --}}
                <div class="flex flex-col gap-6 p-6 rounded-lg border border-neutral-400">
                    <div class="w-full">
                        <button
                            id="decription_dropdown"
                            data-dropdown="data_description_dropdown"
                            class="text-neutral-950 bg-white focus:ring-0 flex flex-col gap-5 w-full"
                            type="button"
                        >
                            <div class="flex justify-between items-center gap-5 w-full">
                                <span class="font-semibold text-base text-neutral-950">Keterangan</span>
                                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            </div>

                            <hr class="w-full border-b border-neutral-400" />
                        </button>
                    </div>

                    <div id="data_description_dropdown" class="hidden bg-white rounded-lg w-full">
                        <div class="flex flex-col gap-10 w-full">
                            
                            <div class="flex flex-col gap-2 w-full">
                                <h5 class="text-base text-neutral-950 font-semibold">Opsi Jawaban</h5>

                                <div class="relative overflow-x-auto w-full">
                                    <div class="grid grid-cols-4  gap-x-6 gap-y-3">
                                        
                                        <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                            <span class="mr-3 font-medium text-neutral-800">V</span>
                                            <span>:</span>
                                            <span>Jika mengindikasikan bahwa variabel i mempengaruhi variabel j</span>
                                        </div>

                                        <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                            <span class="mr-3 font-medium text-neutral-800">A</span>
                                            <span>:</span>
                                            <span>Jika mengindikasikan bahwa variabel j mempengaruhi variabel i  </span>
                                        </div>

                                        <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                            <span class="mr-3 font-medium text-neutral-800">X</span>
                                            <span>:</span>
                                            <span>Jika mengindikasikan bahwa variabel i mempengaruhi variabel j dan sebaliknya variabel j mempengaruhi variabel i</span>
                                        </div>

                                        <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                            <span class="mr-3 font-medium text-neutral-800">O</span>
                                            <span>:</span>
                                            <span>Jika mengindikasikan bahwa variabel i dan j tidak saling berhubungan</span>
                                        </div>

                                        <div class="col-span-2 flex items-top gap-3 text-neutral-600 text-sm">
                                            <span class="mr-3 font-medium text-neutral-800">Ei</span>
                                            <span>:</span>
                                            <span>Merupakan variabel element yang ditampilkan secara vertikal</span>
                                        </div>

                                        <div class="col-span-2 flex items-top gap-3 text-neutral-600 text-sm">
                                            <span class="mr-3 font-medium text-neutral-800">Ej</span>
                                            <span>:</span>
                                            <span>Merupakan variabel element yang ditampilkan secara horizontal</span>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="flex flex-col gap-2 w-full">
                                <h5 class="text-base text-neutral-950 font-semibold">Variabel Resiko</h5>

                                <div class="relative overflow-x-auto w-full">
                                    <div class="grid grid-cols-4 gap-6">
                                        
                                        @php
                                            $decodedRiskData = base64_decode($riskData->data_risk);
                                            $dataRisk = json_decode($decodedRiskData, true); // Assuming $dataRisk is an array

                                            $totalItems = count($dataRisk);
                                            $itemsPerColumn = ceil($totalItems / 4);
                                        @endphp

                                        @for ($i = 0; $i < 4; $i++)
                                            <div class="col-span-1 flex flex-col gap-2">
                                                @php
                                                    $startIndex = $i * $itemsPerColumn;
                                                    $columnItems = array_slice($dataRisk, $startIndex, $itemsPerColumn);
                                                @endphp

                                                @foreach ($columnItems as $index => $item)
                                                    <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                        <span class="mr-1 font-medium text-neutral-800">{{ $startIndex + $index + 1 }}</span>
                                                        <span>:</span>
                                                        <span>{{ $item }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endfor


                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                {{-- End Description --}}
                
                <div class="flex justify-between items-center">
                    <div class="flex gap-5">
                        <button
                            id="random-data-btn"
                            type="button"
                            class="h-full text-neutral-600 hover:text-neutral-50 border border-neutral-400 bg-white hover:bg-primary-700 font-semibold rounded-lg text-base px-5 py-2.5 focus:outline-none ease-in-out duration-200"
                        >
                            Random Data
                        </button>
                        
                    </div>
                </div>

                <div id="matrix-container" class="w-full overflow-x-auto">
                    <div id="matrix-form" data-risk="{{ $riskData->risk }}" data-desc-risk="{{ $riskData->data_risk }}" class="flex flex-col flex-nowrap overflow-x-auto gap-2"></div>
                </div>
                
            </form>
        </div>

    </section>

    {{-- Modal --}}
    <x-modal.confirmation
        title="Apakah Anda yakin ingin keluar?"
        desc="Semua perubahan yang belum disimpan akan hilang"
        cancelButton="Batal"
        confirmButton="Ya, Keluar"
        :useForm="true"
        formRoute="logout"
    />
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/ismInput.js') }}" ></script>
    <script src="{{ asset('assets/js/dropDown.js') }}" ></script>
@endpush