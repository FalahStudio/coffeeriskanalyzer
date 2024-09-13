@extends('components.partials.layouts.user.main')

@section('content')
    <div id="data-ism" data-risk="{{ $riskData->risk }}" data-desc-risk="{{ $riskData->data_risk }}" data-process-ism="{{ $processIsm }}"></div>
    
    <form method="post">
        @csrf
        <section id="step-one" class="step">

            <div id="matrix-results" class="w-full p-6 lg:p-10 overflow-hidden overflow-x-auto">
                <div class="flex flex-col gap-10 w-full">
                    
                    <div class="flex flex-row justify-between items-center">

                        <div class="flex flex-col gap-3">
                            <h5 class="font-semibold text-4xl text-neutral-950">Kuisioner Analisis Resiko Tahap II</h5>
                            <p class="text-neutral-600 text-base">Harap isi form SOD (Severity, Occurance, Detection) dan Linguistik dibawah ini dengan opsi jawaban yang telah disediakan</p>
                        </div>

                        <button
                            type="button"
                            id="next-step-one"
                            class="h-full text-neutral-50 bg-primary-700 hover:bg-primary-800 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none"
                        >
                            Selanjutnya
                        </button>

                    </div>

                    {{-- Description --}}
                    <div class="flex flex-col gap-6 p-6 rounded-lg border border-neutral-400">
                        <div class="w-full">
                            <button
                                id="decription_dropdown"
                                data-dropdown="data_description_dropdown_step_1"
                                class="text-neutral-950 bg-white focus:ring-0 flex flex-col gap-5 w-full"
                                type="button"
                            >
                                <div class="flex justify-between items-center gap-5 w-full">
                                    <span class="font-semibold text-base text-neutral-950">Severity / Dampak</span>
                                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                    </svg>
                                </div>

                                <hr class="w-full border-b border-neutral-400" />
                            </button>
                        </div>

                        <div id="data_description_dropdown_step_1" class="hidden bg-white rounded-lg w-full">
                            <div class="flex flex-col gap-10 w-full">
                                
                                <div class="flex flex-col gap-2 w-full">
                                    <h5 class="text-base text-neutral-950 font-semibold">Opsi Jawaban</h5>

                                    <div class="relative overflow-x-auto w-full">
                                        <div class="grid grid-cols-1 gap-x-6 gap-y-3">
                                            
                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span>
                                                    Pilih salah satu jawaban dalam bentuk skala 1 - 10 tingkat Severity (dampak/seberapa serius kondisi yang diakibatkan)
                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="flex flex-col gap-2 w-full">
                                    <h5 class="text-base text-neutral-950 font-semibold">Skala untuk Severity (dampak/seberapa serius kondisi yang diakibatkan)</h5>

                                    <div class="relative overflow-x-auto w-full">
                                        <div class="grid grid-cols-4 gap-6">
                                            
                                            <div class="col-span-1 flex flex-col gap-2">
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">1</span>
                                                    <span>:</span>
                                                    <span>Tidak ada pengaruh</span>
                                                </div>
                                                
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">2</span>
                                                    <span>:</span>
                                                    <span>Sistem dapat beroperasi dengan sedikit gangguan</span>
                                                </div>

                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">3</span>
                                                    <span>:</span>
                                                    <span>Sistem dapat beroperasi dengan penurunan pada beberapa performa</span>
                                                </div>

                                            </div>
                                            
                                            <div class="col-span-1 flex flex-col gap-2">
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">4</span>
                                                    <span>:</span>
                                                    <span>Sistem dapat beroperasi namun dengan penurunan performa yang signifikan</span>
                                                </div>

                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">5</span>
                                                    <span>:</span>
                                                    <span>Sistem tidak dapat beroperasi tanpa kerusakan</span>
                                                </div>

                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">6</span>
                                                    <span>:</span>
                                                    <span>Sistem tidak dapat beroperasi dengan tingkat kerusakan yang kecil</span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-span-1 flex flex-col gap-2">
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-1 font-medium text-neutral-800">7</span>
                                                    <span>:</span>
                                                    <span>Sistem tidak dapat beroperasi dengan kerusakan pada peralatan</span>
                                                </div>
                                                
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-1 font-medium text-neutral-800">8</span>
                                                    <span>:</span>
                                                    <span>Sistem tidak dapat beroperasi dengan kegagalan yang menyebabkan kerusakan</span>
                                                </div>

                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-1 font-medium text-neutral-800">9</span>
                                                    <span>:</span>
                                                    <span>Tingkat keparahan sangat tinggi dan dengan peringatan</span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-span-1 flex flex-col gap-2">
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-1 font-medium text-neutral-800">10</span>
                                                    <span>:</span>
                                                    <span>Tingkat keparahan sangat tinggi dan tanpa peringatan</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- End Description --}}
                    
                </div>

                <div id="input_severity" class="flex flex-col gap-5"></div>
            </div>
            
        </section>
        
        <section id="step-two" class="step hidden">

            <div id="matrix-results" class="w-full p-6 lg:p-10 overflow-hidden overflow-x-auto">
                <div class="flex flex-col gap-10 w-full">
                    
                    <div class="flex flex-row justify-between items-center">

                        <div class="flex flex-col gap-3">
                            <h5 class="font-semibold text-4xl text-neutral-950">Kuisioner Analisis Resiko Tahap II</h5>
                            <p class="text-neutral-600 text-base">Harap isi form SOD (Severity, Occurance, Detection) dan Linguistik dibawah ini dengan opsi jawaban yang telah disediakan</p>
                        </div>

                        <div class="flex gap-2.5">
                            <button
                                type="button"
                                id="prev-step-two"
                                class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none"
                            >
                                Kembali
                            </button>
                            
                            <button
                                type="button"
                                id="next-step-two"
                                class="h-full text-neutral-50 bg-primary-700 hover:bg-primary-800 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none"
                            >
                                Selanjutnya
                            </button>
                        </div>

                    </div>

                    {{-- Description --}}
                    <div class="flex flex-col gap-6 p-6 rounded-lg border border-neutral-400">
                        <div class="w-full">
                            <button
                                id="decription_dropdown"
                                data-dropdown="data_description_dropdown_step_2"
                                class="text-neutral-950 bg-white focus:ring-0 flex flex-col gap-5 w-full"
                                type="button"
                            >
                                <div class="flex justify-between items-center gap-5 w-full">
                                    <span class="font-semibold text-base text-neutral-950">Occurance / Kejadian</span>
                                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                    </svg>
                                </div>

                                <hr class="w-full border-b border-neutral-400" />
                            </button>
                        </div>

                        <div id="data_description_dropdown_step_2" class="hidden bg-white rounded-lg w-full">
                            <div class="flex flex-col gap-10 w-full">
                                
                                <div class="flex flex-col gap-2 w-full">
                                    <h5 class="text-base text-neutral-950 font-semibold">Opsi Jawaban</h5>

                                    <div class="relative overflow-x-auto w-full">
                                        <div class="grid grid-cols-1 gap-x-6 gap-y-3">
                                            
                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span>
                                                    Pilih salah satu jawaban dalam bentuk skala 1 - 10 tingkat Occurance (seberapa sering kegagalan terjadi)
                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="flex flex-col gap-2 w-full">
                                    <h5 class="text-base text-neutral-950 font-semibold">Skala untuk Occurance (seberapa sering kegagalan terjadi)</h5>

                                    <div class="relative overflow-x-auto w-full">
                                        <div class="grid grid-cols-4 gap-6">
                                            
                                            <div class="col-span-1 flex flex-col gap-2">
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">1</span>
                                                    <span>:</span>
                                                    <span>Kemungkinan Kegagalan < 1 dalam 1.500.000</span>
                                                </div>
                                                
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">2</span>
                                                    <span>:</span>
                                                    <span>Kemungkinan Kegagalan 1 dalam 150.000</span>
                                                </div>

                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">3</span>
                                                    <span>:</span>
                                                    <span>Kemungkinan Kegagalan 1 dalam 15.000</span>
                                                </div>

                                            </div>
                                            
                                            <div class="col-span-1 flex flex-col gap-2">
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">4</span>
                                                    <span>:</span>
                                                    <span>Kemungkinan Kegagalan 1 dalam 2000</span>
                                                </div>

                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">5</span>
                                                    <span>:</span>
                                                    <span>Kemungkinan Kegagalan 1 dalam 400</span>
                                                </div>

                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">6</span>
                                                    <span>:</span>
                                                    <span>Kemungkinan Kegagalan 1 dalam 80</span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-span-1 flex flex-col gap-2">
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-1 font-medium text-neutral-800">7</span>
                                                    <span>:</span>
                                                    <span>Kemungkinan Kegagalan 1 dalam 20</span>
                                                </div>
                                                
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-1 font-medium text-neutral-800">8</span>
                                                    <span>:</span>
                                                    <span>Kemungkinan Kegagalan 1 dalam 8</span>
                                                </div>

                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-1 font-medium text-neutral-800">9</span>
                                                    <span>:</span>
                                                    <span>Kemungkinan Kegagalan 1 dalam 3</span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-span-1 flex flex-col gap-2">
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-1 font-medium text-neutral-800">10</span>
                                                    <span>:</span>
                                                    <span>Kemungkinan Kegagalan >1 dalam 2</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- End Description --}}
                    
                </div>

                <div id="input_occurance" class="flex flex-col gap-5"></div>
            </div>

        </section>
        
        <section id="step-three" class="step hidden">

            <div id="matrix-results" class="w-full p-6 lg:p-10 overflow-hidden overflow-x-auto">
                <div class="flex flex-col gap-10 w-full">
                    
                    <div class="flex flex-row justify-between items-center">

                        <div class="flex flex-col gap-3">
                            <h5 class="font-semibold text-4xl text-neutral-950">Kuisioner Analisis Resiko Tahap II</h5>
                            <p class="text-neutral-600 text-base">Harap isi form SOD (Severity, Occurance, Detection) dan Linguistik dibawah ini dengan opsi jawaban yang telah disediakan</p>
                        </div>

                        <div class="flex gap-2.5">
                            <button
                                type="button"
                                id="prev-step-three"
                                class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none"
                            >
                                Kembali
                            </button>
                            
                            <button
                                type="button"
                                id="next-step-three"
                                class="h-full text-neutral-50 bg-primary-700 hover:bg-primary-800 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none"
                            >
                                Selanjutnya
                            </button>
                        </div>

                    </div>

                    {{-- Description --}}
                    <div class="flex flex-col gap-6 p-6 rounded-lg border border-neutral-400">
                        <div class="w-full">
                            <button
                                id="decription_dropdown"
                                data-dropdown="data_description_dropdown_step_3"
                                class="text-neutral-950 bg-white focus:ring-0 flex flex-col gap-5 w-full"
                                type="button"
                            >
                                <div class="flex justify-between items-center gap-5 w-full">
                                    <span class="font-semibold text-base text-neutral-950">Detection / Deteksi</span>
                                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                    </svg>
                                </div>

                                <hr class="w-full border-b border-neutral-400" />
                            </button>
                        </div>

                        <div id="data_description_dropdown_step_3" class="hidden bg-white rounded-lg w-full">
                            <div class="flex flex-col gap-10 w-full">
                                
                                <div class="flex flex-col gap-2 w-full">
                                    <h5 class="text-base text-neutral-950 font-semibold">Opsi Jawaban</h5>

                                    <div class="relative overflow-x-auto w-full">
                                        <div class="grid grid-cols-1 gap-x-6 gap-y-3">
                                            
                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span>
                                                    Pilih salah satu jawaban dalam bentuk skala 1 - 10 tingkat Detection (deteksi / tingkat lolosnya risiko dari pengontrolan)
                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="flex flex-col gap-2 w-full">
                                    <h5 class="text-base text-neutral-950 font-semibold">Skala untuk Detection (deteksi / tingkat lolosnya risiko dari pengontrolan)</h5>

                                    <div class="relative overflow-x-auto w-full">
                                        <div class="grid grid-cols-4 gap-6">
                                            
                                            <div class="col-span-1 flex flex-col gap-2">
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">1</span>
                                                    <span>:</span>
                                                    <span>Kontrol desain akan mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya</span>
                                                </div>
                                                
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">2</span>
                                                    <span>:</span>
                                                    <span>Kontrol desain sangat tinggi kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya</span>
                                                </div>

                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">3</span>
                                                    <span>:</span>
                                                    <span>Kontrol desain tinggi kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya</span>
                                                </div>

                                            </div>
                                            
                                            <div class="col-span-1 flex flex-col gap-2">
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">4</span>
                                                    <span>:</span>
                                                    <span>Kontrol desain cukup tinggi kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya</span>
                                                </div>

                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">5</span>
                                                    <span>:</span>
                                                    <span>Kontrol desain sedang kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya</span>
                                                </div>

                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">6</span>
                                                    <span>:</span>
                                                    <span>Kontrol desain kecil kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya</span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-span-1 flex flex-col gap-2">
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-1 font-medium text-neutral-800">7</span>
                                                    <span>:</span>
                                                    <span>Kontrol desain sangat kecil kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya</span>
                                                </div>
                                                
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-1 font-medium text-neutral-800">8</span>
                                                    <span>:</span>
                                                    <span>Kontrol desain kecil kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya</span>
                                                </div>

                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-1 font-medium text-neutral-800">9</span>
                                                    <span>:</span>
                                                    <span>Kontrol desain sangat kecil kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya</span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-span-1 flex flex-col gap-2">
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-1 font-medium text-neutral-800">10</span>
                                                    <span>:</span>
                                                    <span>Kontrol desain tidak dapat mendeteksi penyebab/mekanisme potensial dan mode kegagalan berikutnya</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- End Description --}}
                    
                </div>

                <div id="input_detection" class="flex flex-col gap-5"></div>
            </div>

        </section>

        <section id="step-four" class="step hidden">

            <div id="matrix-results" class="w-full p-6 lg:p-10 overflow-hidden overflow-x-auto">
                <div class="flex flex-col gap-10 w-full">
                    
                    <div class="flex flex-row justify-between items-center">

                        <div class="flex flex-col gap-3">
                            <h5 class="font-semibold text-4xl text-neutral-950">Kuisioner Analisis Resiko Tahap II</h5>
                            <p class="text-neutral-600 text-base">Harap isi form SOD (Severity, Occurance, Detection) dan Linguistik dibawah ini dengan opsi jawaban yang telah disediakan</p>
                        </div>

                        <div class="flex gap-2.5">
                            <button
                                type="button"
                                id="prev-step-four"
                                class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none"
                            >
                                Kembali
                            </button>
                            
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
                    </div>

                    {{-- Description --}}
                    <div class="flex flex-col gap-6 p-6 rounded-lg border border-neutral-400">
                        <div class="w-full">
                            <button
                                id="decription_dropdown"
                                data-dropdown="data_description_dropdown_step_4"
                                class="text-neutral-950 bg-white focus:ring-0 flex flex-col gap-5 w-full"
                                type="button"
                            >
                                <div class="flex justify-between items-center gap-5 w-full">
                                    <span class="font-semibold text-base text-neutral-950">Linguistik</span>
                                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                    </svg>
                                </div>

                                <hr class="w-full border-b border-neutral-400" />
                            </button>
                        </div>

                        <div id="data_description_dropdown_step_4" class="hidden bg-white rounded-lg w-full">
                            <div class="flex flex-col gap-10 w-full">
                                
                                <div class="flex flex-col gap-2 w-full">
                                    <h5 class="text-base text-neutral-950 font-semibold">Opsi Jawaban</h5>

                                    <div class="relative overflow-x-auto w-full">
                                        <div class="grid grid-cols-1 gap-x-6 gap-y-3">
                                            
                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span>
                                                    Pilih salah satu jawaban dalam bentuk bobot faktor
                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="flex flex-col gap-2 w-full">
                                    <h5 class="text-base text-neutral-950 font-semibold">Skala untuk Detection (deteksi / tingkat lolosnya risiko dari pengontrolan)</h5>

                                    <div class="relative overflow-x-auto w-full">
                                        <div class="grid grid-cols-3 gap-6">
                                            
                                            <div class="col-span-1 flex flex-col gap-2">
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">Very Low (VL)</span>
                                                    <span>:</span>
                                                    <span>Jika dampak/kejadian/deteksi yang ditimbulkan sangat rendah</span>
                                                </div>
                                                
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">Low (L)</span>
                                                    <span>:</span>
                                                    <span>Jika dampak/kejadian/deteksi yang ditimbulkan rendah</span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-span-1 flex flex-col gap-2">
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">Medium (M)</span>
                                                    <span>:</span>
                                                    <span>Jika dampak/kejadian/deteksi yang ditimbulkan sedang</span>
                                                </div>

                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-3 font-medium text-neutral-800">High (H)</span>
                                                    <span>:</span>
                                                    <span>Jika dampak/kejadian/deteksi yang ditimbulkan tinggi</span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-span-1 flex flex-col gap-2">
                                                <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                    <span class="mr-1 font-medium text-neutral-800">Very High (VH)</span>
                                                    <span>:</span>
                                                    <span>Jika dampak/kejadian/deteksi yang ditimbulkan sangat tinggi</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- End Description --}}
                    
                </div>

                <div id="input_linguistic" class="flex flex-col gap-5"></div>
            </div>

        </section>

        {{-- Modal Confirmation --}}
        <x-modal.confirmation
            title="Apakah data yang anda isi sudah benar?"
            desc="Pastikan jawaban anda sudah benar, karena data tidak akan dapat di edit kembali setelah anda klik proses data"
            cancelButton="Edit kembali"
            confirmButton="Ya, Proses data"
        />
        {{-- End Modal Confirmation --}}
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/fuzzyInput.js') }}" ></script>
    <script src="{{ asset('assets/js/dropDown.js') }}" ></script>
@endpush