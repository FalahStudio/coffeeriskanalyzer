@props([
    'id' => 'default-modal'
])

<!-- Main modal -->
<div id="{{ $id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen max-h-full bg-[#8098A2B3]" style="justify-content: end !important;">
    <div class="relative p-4 w-full max-w-2xl h-screen">
        <!-- Modal content -->
        <form method="POST" class="h-[calc(100vh-32px)] overflow-hidden border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
            @csrf

            {{-- Header --}}
            <div class="flex flex-shrink-0 items-center justify-between p-6 border-b border-gray-200 rounded-t-md">
                <h3 class="text-xl-body-semibold text-neutral-950">
                    Buat Skema Baru
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="{{ $id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            {{-- Body --}}
            <div class="flex-auto overflow-y-auto relative px-6 py-8">
                <div id="input_risk_first" class="grid grid-cols-1 gap-5">
                    <x-input.inputField
                        inputId="amount_of_risk"
                        type="text"
                        name="risk"
                        placeholder="Masukkan jumlah resiko yang ingin dibuat"
                        label="Jumlah Risiko"
                    />
                    <x-input.inputField
                        inputId="expert_one"
                        type="text"
                        label="Email Pakar 1"
                        placeholder="Masukkan email pakar 1 yang akan terlibat dalam analisis"
                    />
                    <x-input.inputField
                        inputId="expert_two"
                        type="text"
                        label="Email Pakar 2"
                        placeholder="Masukkan email pakar 2 yang akan terlibat dalam analisis"
                    />
                    <x-input.inputField
                        inputId="expert_three"
                        type="text"
                        label="Email Pakar 3"
                        placeholder="Masukkan email pakar 3 yang akan terlibat dalam analisis"
                    />
                    
                    <div>
                        <label for="end_date" class="block mb-3 text-lg-body-medium text-neutral-800">Batas waktu pengisian<span class="text-primary-700">*</span></label>
                        <div class="relative">
                            <input datepicker id="end_date" type="text" class="bg-white border border-neutral-400 text-neutral-800 text-lg-body-medium placeholder:text-neutral-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full py-3 ps-4 pe-10" placeholder="Pilih tanggal" name="end_date" value="{{ date('m/d/Y') }}">
                            <div class="absolute inset-y-0 end-0 flex items-center pe-4 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <x-input.inputField
                        inputId="statusModal"
                        type="hidden"
                        label=""
                        placeholder=""
                        value="createRisk"
                        :required="false"
                    />
                </div>

                <!-- Dynamic Input Fields -->
                <div id="input_risk_second" class="hidden grid-cols-1 gap-5"></div>

                <!-- Loading Indicator -->
                <div id="loading_indicator" class="absolute hidden inset-0 bg-white w-full h-full z-10 justify-center items-center pointer-events-none" role="status">
                    <svg aria-hidden="true" class="w-8 h-8 text-neutral-500 animate-spin fill-primary-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex flex-shrink-0 flex-wrap items-center justify-end p-6 border-t border-gray-200 rounded-b-md">
                <x-button.index
                    title="Selanjutnya"
                    color="primary"
                    buttonId="schema_next_button_modal"
                    buttonClass="step"
                />
                
                <div class="step flex gap-4">
                    <x-button.index
                        title="Kembali"
                        color="outline"
                        buttonId="schema_prev_button_modal"
                    />

                    <x-button.index
                        title="Simpan"
                        color="primary"
                        type="submit"
                        buttonId="schema_button_submit"
                    />
                </div>
            </div>
        </form>
    </div>
</div>