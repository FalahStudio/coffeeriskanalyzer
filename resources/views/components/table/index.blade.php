@props([
    'columns',
    'slot',
    'action' => true,
    'idTable' => 'dataTable',
    'button' => false,
    'headerTable' => true,
])

<div class="grid grid-cols-1 gap-6">
    {{-- Search Button and Add Button --}}
    <div class="col-span-1 flex flex-col-reverse items-end sm:flex-row sm:justify-between gap-5">

        {{-- Search --}}
        @if ($headerTable)
            <div class="relative sm:max-w-60 md:max-w-80 w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <i class="iconsax" icon-name="search-normal-1"></i>
                </div>
                <input type="text" id="date-search" class="bg-gray-50 border border-gray-300 text-neutral-600 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full px-10 p-2.5" placeholder="Search" />
            </div>

            @if ($button)
                <button id="create_button" type="button" class="focus:outline-none text-white bg-primary-700 hover:bg-primary-800 focus:ring-0 rounded-lg text-md-body-semibold py-2.5 px-6 flex items-center gap-2 w-auto" data-modal-target="add_risk" data-modal-toggle="add_risk">
                    <i class="iconsax" icon-name="add"></i>

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
                <ul class="flex flex-row items-center h-8 text-sm" id="paginationData">
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
