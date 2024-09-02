@props([
    'modalId' => 'modal-confirmation',
    'title' => 'Apakah data yang anda isi sudah benar?',
    'desc' => 'Pastikan jawaban anda sudah benar, karena data tidak akan dapat di edit kembali setelah anda klik proses data',
    'cancelButton' => 'Edit kembali',
    'confirmButton' => 'Ya, Proses data'
])

<div id="{{ $modalId }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen max-h-full bg-[#8098A2B3]" >
    <div 
        class="relative p-4 w-full max-w-2xl max-h-full">

        <div class="relative bg-white rounded-lg shadow p-10">

            <div class="text-center ">

                <div class="space-y-3">
                    <h5 class="font-semibold text-xl text-neutral-950">{{ $title }}</h5>
                    <p class="font-neutral text-sm text-600">{{ $desc }}</p>
                </div>
            </div>


            <div class="flex items-center mt-10">
                <button
                    data-modal-hide="{{ $modalId }}"
                    type="button"
                    class="w-full py-2.5 px-5 ms-3 text-sm font-medium text-neutral-900 focus:outline-none bg-neutral-50 rounded-lg border border-neutral-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-neutral-100"
                >
                    {{ $cancelButton }}
                </button>

                <button 
                    type="submit"
                    class="w-full py-2.5 px-5 ms-3 text-sm font-medium text-neutral-50 bg-primary-700 hover:bg-primary-800 focus:outline-none rounded-lg border border-neutral-200  hover:text-neutral-50 focus:z-10 focus:ring-4 focus:ring-neutral-100"
                >
                    {{ $confirmButton }}
                </button>
            </div>
        </div>
    </div>
</div>