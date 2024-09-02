

<nav class="bg-white shadow-sm">
    <div class="max-w-screen-2xl flex flex-wrap items-center justify-end sm:justify-between mx-auto py-5 px-10 sm:py-7">
        <a href="{{ !empty('dashboard') ? route('dashboard') : '#' }}" class="items-center space-x-3 hidden sm:flex">
            <span class="self-center text-xl-body-medium text-primary-700 whitespace-nowrap">{{ $title ?? 'Dashboard' }}</span>
        </a>

        <div class="block w-auto" id="navbar-dropdown">
            <ul class="flex bg-white flex-row">
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="profileDropdown" class="flex items-center justify-between gap-6 hover:bg-gray-100 hover:bg-transparent border-0 p-0 w-auto ease-in-out duration-300">
                        <div class="flex flex-col items-start">
                            <p class="text-neutral-700 text-sm-body-semibold">Edo Sugita</p>
                            <span class="text-neutral-600 text-xs-body-regular">Admin</span>
                        </div>

                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="profileDropdown" class="z-10 hidden p-2 rounded border border-neutral-400 bg-white">
                        <ul aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="{{ route('setting') }}" class="flex items-center gap-3.5 p-3.5 hover:bg-neutral-200 rounded-sm text-neutral-800 text-sm-body-semibold">
                                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                    </svg>

                                    Role & Permission
                                </a>
                            </li>
                            <li>
                                <x-button.index
                                    title="Logout"
                                    color="clear2"
                                    customButton="w-full flex items-center gap-3.5 p-3.5 hover:bg-neutral-200 rounded-sm"
                                    weight='semibold'
                                    fontSize='sm'
                                    :icon="true"
                                    :icon_left="true"
                                    iconSize='2.5'
                                    iconMargin='ms-2.5'
                                    :withModal="true"
                                    modalType="confirmation"
                                />
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<x-modal.confirmation
    title="Apakah Anda yakin ingin keluar?"
    desc="Semua perubahan yang belum disimpan akan hilang"
    cancelButton="Batal"
    confirmButton="Ya, Keluar"
/>