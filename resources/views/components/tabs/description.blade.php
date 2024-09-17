@props([
    'title' => 'Keterangan',
    'dataDesc' => '',
    'withOption' => true,
    'id' => 'data_description_dropdown',
    'dataOpen' => false,
    'withNumber' => false,
])

@if (!empty($dataDesc))
    <div class="flex flex-col gap-6 p-6 rounded-lg border border-neutral-400">
        <div class="w-full">
            <button
                id="decription_dropdown"
                data-dropdown="{{ $id }}"
                data-open="{{ $dataOpen }}"
                class="text-neutral-950 bg-white focus:ring-0 flex flex-col gap-5 w-full"
                type="button"
            >
                <div class="flex justify-between items-center gap-5 w-full">
                    <span class="font-semibold text-base text-neutral-950">{{ $title }}</span>
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </div>

                <hr class="w-full border-b border-neutral-400" />
            </button>
        </div>

        <div id="{{ $id }}" class="hidden bg-white rounded-lg w-full">
            <div class="flex flex-col gap-10 w-full">
                
               @if ($withOption)
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
               @endif

                <div class="flex flex-col gap-2 w-full">
                    <h5 class="text-base text-neutral-950 font-semibold">Variabel Resiko</h5>

                    <div class="relative overflow-x-auto w-full">
                        <div class="grid grid-cols-4 gap-6">
                            
                            @php
                                $decodedRiskData = base64_decode($dataDesc);
                                $dataRisk = json_decode($decodedRiskData, true);

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
                                            @if ($withNumber)
                                                <span class="mr-1 font-medium text-neutral-800">{{ $index }}</span>
                                            @else
                                                <span class="mr-1 font-medium text-neutral-800">{{ $startIndex + $index + 1 }}</span>
                                            @endif
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
@endif