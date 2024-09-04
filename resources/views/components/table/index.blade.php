@props([
    'columns',
    'slot',
    'action' => true,
    'idTable' => 'dataTable',
    'button' => false,
    'headerTable' => true
])

<div class="grid grid-cols-1 gap-6">
    {{-- Search Button and Add Button --}}
    <div class="col-span-1 flex flex-col-reverse items-end sm:flex-row sm:justify-between gap-5">
        
        {{-- Search --}}
        @if ($headerTable)
            <div class="relative sm:max-w-60 md:max-w-80 w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.15 5.6h.01m3.337 1.913h.01m-6.979 0h.01M5.541 11h.01M15 15h2.706a1.957 1.957 0 0 0 1.883-1.325A9 9 0 1 0 2.043 11.89 9.1 9.1 0 0 0 7.2 19.1a8.62 8.62 0 0 0 3.769.9A2.013 2.013 0 0 0 13 18v-.857A2.034 2.034 0 0 1 15 15Z"/>
                    </svg>
                </div>
                <input type="text" id="date-search" class="bg-gray-50 border border-gray-300 text-neutral-600 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full px-10 p-2.5" placeholder="Search" />
                <button type="button" class="absolute inset-y-0 end-0 flex items-center pe-3">
                    <svg class="w-4 h-4 text-neutral-600 hover:text-neutral-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7v3a5.006 5.006 0 0 1-5 5H6a5.006 5.006 0 0 1-5-5V7m7 9v3m-3 0h6M7 1h2a3 3 0 0 1 3 3v5a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3V4a3 3 0 0 1 3-3Z"/>
                    </svg>
                </button>
            </div>

            @if ($button)
                <button id="create_button" type="button" class="focus:outline-none text-white bg-primary-700 hover:bg-primary-800 focus:ring-0 rounded-lg text-md-body-semibold py-2.5 px-6 flex items-center gap-2 w-auto" data-modal-target="add_risk" data-modal-toggle="add_risk">
                    <svg class="hidden sm:block w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.15 5.6h.01m3.337 1.913h.01m-6.979 0h.01M5.541 11h.01M15 15h2.706a1.957 1.957 0 0 0 1.883-1.325A9 9 0 1 0 2.043 11.89 9.1 9.1 0 0 0 7.2 19.1a8.62 8.62 0 0 0 3.769.9A2.013 2.013 0 0 0 13 18v-.857A2.034 2.034 0 0 1 15 15Z"/>
                    </svg>

                    Buat Skema Baru
                </button>
            @endif
        @endif
    </div>

    {{-- Table --}}
    <div class="col-span-1 mt-2">
        <div class="relative overflow-x-auto rounded-lg border-x border-t border-neutral-400">
            <table class="w-full text-sm text-left text-gray-500" id="{{ $idTable }}">
                <thead class="text-sm-body-semibold text-neutral-800 capitalize bg-neutral-50 border-b border-neutral-400">
                    <tr>
                        <th scope="col" class="p-4 text-center">
                            No
                        </th>
                        @foreach ($columns as $item)
                            <th scope="col" class="px-4 py-3">
                                {{ $item }}
                            </th>
                        @endforeach
                        @if ($action)
                            <th scope="col" class="px-4 py-3 w-12 text-center">
                                Action
                            </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    {{ $slot }}
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-span-1">
        <div class="flex justify-between items-center">

            {{-- Show Data Per Page --}}
            <div class="flex justify-end items-center gap-4">
                <div class="flex items-center gap-2">
                    <span class="text-neutral-700 text-sm leading-normal">Tampilkan</span>
                    <select
                        id="lengthSelect"
                        class="text-neutral-700 text-sm leading-normal border-none bg-[#FCFCFC] rounded-lg focus:ring-none focus:border-none block"
                    >
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="text-neutral-700 text-sm leading-normal">data per halaman</span>
                </div>
            </div>
            {{-- End Show Data --}}

            {{-- Pagination --}}
            <nav aria-label="Page navigation">
                <ul class="flex items-center h-8 text-sm" id="paginationData">
                </ul>
            </nav>
            {{-- End Pagination --}}
        </div>
    </div>

    @if ($button)
        <x-modal.index
            id="add_risk"
        />
    @endif
</div>