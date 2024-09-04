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

                    <button
                        data-modal-target="modal-confirmation"
                        data-modal-toggle="modal-confirmation"
                        class="h-full text-neutral-50 bg-primary-700 hover:bg-primary-800 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none""
                        type="button"
                    >
                        Proccess Data
                    </button>

                </div>

                {{-- Modal Confirmation --}}
                <div
                    id="modal-confirmation"
                    tabindex="-1"
                    aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
                >
                    <div 
                        class="relative p-4 w-full max-w-2xl max-h-full">

                        <div class="relative bg-white rounded-lg shadow p-10">

                            <div class="text-center ">

                                <div class="space-y-3">
                                    <h5 class="font-semibold text-xl text-neutral-950">Apakah data yang anda isi sudah benar?</h5>
                                    <p class="font-neutral text-sm text-600">Pastikan jawaban anda sudah benar, karena data tidak akan dapat di edit kembali setelah anda klik proses data</p>
                                </div>
                            </div>


                            <div class="flex items-center mt-10">
                                <button
                                    data-modal-hide="modal-confirmation"
                                    type="button"
                                    class="w-full py-2.5 px-5 ms-3 text-sm font-medium text-neutral-900 focus:outline-none bg-neutral-50 rounded-lg border border-neutral-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-neutral-100"
                                >
                                    Edit kembali
                                </button>

                                <button 
                                    type="submit"
                                    class="w-full py-2.5 px-5 ms-3 text-sm font-medium text-neutral-50 bg-primary-700 hover:bg-primary-800 focus:outline-none rounded-lg border border-neutral-200  hover:text-neutral-50 focus:z-10 focus:ring-4 focus:ring-neutral-100"
                                >
                                    Ya, Proses data
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
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
                                        
                                        <div class="col-span-1 flex flex-col gap-2">
                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-3 font-medium text-neutral-800">1</span>
                                                <span>:</span>
                                                <span>Perencanaan yang tidak tepat akibat perubahan iklim</span>
                                            </div>
                                            
                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-3 font-medium text-neutral-800">2</span>
                                                <span>:</span>
                                                <span>Kurangnya perawatan tanaman</span>
                                            </div>

                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-3 font-medium text-neutral-800">3</span>
                                                <span>:</span>
                                                <span>Penyakit tanaman</span>
                                            </div>

                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-3 font-medium text-neutral-800">4</span>
                                                <span>:</span>
                                                <span>Kurangnya jumlah tenaga kerja</span>
                                            </div>

                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-3 font-medium text-neutral-800">5</span>
                                                <span>:</span>
                                                <span>Harga pupuk yang fluktuatif</span>
                                            </div>

                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-3 font-medium text-neutral-800">6</span>
                                                <span>:</span>
                                                <span>Ketersediaan air tidak memadai</span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-span-1 flex flex-col gap-2">
                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-3 font-medium text-neutral-800">7</span>
                                                <span>:</span>
                                                <span>Tenaga kerja kurang terampil</span>
                                            </div>
                                            
                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-3 font-medium text-neutral-800">8</span>
                                                <span>:</span>
                                                <span>Terdapat hama</span>
                                            </div>

                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-3 font-medium text-neutral-800">9</span>
                                                <span>:</span>
                                                <span>Pemanenan tidak serentak</span>
                                            </div>

                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-1 font-medium text-neutral-800">10</span>
                                                <span>:</span>
                                                <span>Kualitas buah kopi yang tidak sesuai dengan standar</span>
                                            </div>

                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-1 font-medium text-neutral-800">11</span>
                                                <span>:</span>
                                                <span>Kualitas biji kopi yang rendah</span>
                                            </div>

                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-1 font-medium text-neutral-800">12</span>
                                                <span>:</span>
                                                <span>Mesin yang digunakan tidak stabil</span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-span-1 flex flex-col gap-2">
                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-1 font-medium text-neutral-800">13</span>
                                                <span>:</span>
                                                <span>Pekerja kesulitan mengoperasikan mesin</span>
                                            </div>
                                            
                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-1 font-medium text-neutral-800">14</span>
                                                <span>:</span>
                                                <span>Terbuangnya kopi akibat tidak tersangrai dengan sempurna</span>
                                            </div>

                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-1 font-medium text-neutral-800">15</span>
                                                <span>:</span>
                                                <span>Terdapat kerikil pada biji kopi yang telah disangrai</span>
                                            </div>

                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-1 font-medium text-neutral-800">16</span>
                                                <span>:</span>
                                                <span>Kurang memadainya peralatan</span>
                                            </div>

                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-1 font-medium text-neutral-800">17</span>
                                                <span>:</span>
                                                <span>Kurang menariknya kemasan yang digunakan</span>
                                            </div>

                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-1 font-medium text-neutral-800">18</span>
                                                <span>:</span>
                                                <span>Kebersihan tempat penyimpanan kurang</span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-span-1 flex flex-col gap-2">
                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-1 font-medium text-neutral-800">19</span>
                                                <span>:</span>
                                                <span>Terjadi keterlambatan pengiriman/span>
                                            </div>
                                            
                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-1 font-medium text-neutral-800">20</span>
                                                <span>:</span>
                                                <span>Rendahnya tingkat kepuasan konsumen</span>
                                            </div>

                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-1 font-medium text-neutral-800">21</span>
                                                <span>:</span>
                                                <span>Profit yang dihasilkan tidak stabil</span>
                                            </div>

                                            <div class="flex items-top gap-3 text-neutral-600 text-sm">
                                                <span class="mr-1 font-medium text-neutral-800">22</span>
                                                <span>:</span>
                                                <span>Pemutusan kerjasama antar pemasok dengan distributor</span>
                                            </div>
                                        </div>

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
                    <div id="matrix-form" data-risk="{{ $riskData->risk }}" class="flex flex-col flex-nowrap overflow-x-auto gap-2"></div>
                </div>
                
            </form>
        </div>

    </section>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/ismInput.js') }}" ></script>
    <script src="{{ asset('assets/js/dropDown.js') }}" ></script>
@endpush