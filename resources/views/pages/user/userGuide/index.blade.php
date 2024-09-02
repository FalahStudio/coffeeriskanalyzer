@extends('components.partials.layouts.user.main')

@section('content')
    <section>
        <div class="flex flex-col-reverse md:flex-row justify-between md:items-center gap-4">

            <div class="flex flex-col gap-3">
                <h5 class="text-md-display-semibold text-neutral-950">Panduan Pemakaian</h5>
                <p class="text-md-body-regular text-neutral-600">Berikut adalah hasil analisis terdahulu yang pernah dilakukan</p>
            </div>

            <div class="flex justify-end h-full">
                <button type="button" class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none" onclick="location.href='{{ route('home') }}'">
                    Kembali
                </button>
            </div>

        </div>

        <div class="my-10 md:my-20">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-3">
                    <div class="p-6 rounded-xl border border-neutral-400">
                        <ul class="flex-column space-y space-y-6 text-sm font-medium text-gray-500" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-primary-700 hover:text-primary-600" data-tabs-inactive-classes="text-neutral-600 text-md-body-medium" role="tablist">

                            <li role="presentation">
                                <button class="flex items-center gap-2" id="overview-styled-tab" data-tabs-target="#styled-overview" type="button" role="tab" aria-controls="overview" aria-selected="false">
                                    <svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                        <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                                    </svg>

                                    Overview
                                </button>
                            </li>
                            <li role="presentation">
                                <button class="flex items-center gap-2" id="prev-analysis-styled-tab" data-tabs-target="#styled-prev-analysis" type="button" role="tab" aria-controls="prev-analysis" aria-selected="false">
                                    <svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                        <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                                    </svg>

                                    Melihat analisis terdahulu
                                </button>
                            </li>
                            <li role="presentation">
                                <button class="flex items-center gap-2" id="new-analysis-styled-tab" data-tabs-target="#styled-new-analysis" type="button" role="tab" aria-controls="new-analysis" aria-selected="false">
                                    <svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                        <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                                    </svg>

                                    Pembuatan analisis baru
                                </button>
                            </li>
                            <li role="presentation">
                                <button class="flex items-center gap-2" id="first-quistioner-styled-tab" data-tabs-target="#styled-first-quistioner" type="button" role="tab" aria-controls="first-quistioner" aria-selected="false">
                                    <svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                        <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                                    </svg>

                                    Isi kuisioner tahap 1
                                </button>
                            </li>
                            <li role="presentation">
                                <button class="flex items-center gap-2" id="second-quistioner-styled-tab" data-tabs-target="#styled-second-quistioner" type="button" role="tab" aria-controls="second-quistioner" aria-selected="false">
                                    <svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                        <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                                    </svg>

                                    Isi kuisioner tahap 2
                                </button>
                            </li>
                            <li role="presentation">
                                <button class="flex items-center gap-2" id="result-styled-tab" data-tabs-target="#styled-result" type="button" role="tab" aria-controls="result" aria-selected="false">
                                    <svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                        <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                                    </svg>

                                    Hasil analisis
                                </button>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="col-span-9 grid grid-cols-2 md:grid-cols-3">
                    <div class="col-span-2">
                        <div id="default-styled-tab-content">

                            <div class="hidden px-4 rounded-lg" id="styled-overview" role="tabpanel" aria-labelledby="overview-tab">
                                <div class="flex flex-col gap-4 text-neutral-600">
                                    <h5 class="text-sm-display-semibold text-neutral-800">Overview</h5>

                                    <p>
                                        Risk Analysis Web Application adalah aplikasi berbasis web yang digunakan untuk mempermudah dan meningkatkan akurasi dalam menganalisis risiko kopi dengan menerapakan 2 metode ISM dan Fuzzy FMEA.
                                    </p>

                                    <p>
                                        Aplikasi berbasis web ini dapat digunakan kembali ketika semua peran sudah terambil dalam alur analisis yang dilakukan sebelumnya.
                                    </p>
                                </div>

                                {{-- <div class="mt-10 flex justify-end">
                                    <button type="button" class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none" id="next-to-prev-analysis">
                                        Selanjutnya
                                    </button>
                                </div> --}}
                            </div>

                            <div class="hidden px-4 rounded-lg" id="styled-prev-analysis" role="tabpanel" aria-labelledby="prev-analysis-tab">
                                <div class="flex flex-col gap-4 text-neutral-600">
                                    <h5 class="text-sm-display-semibold text-neutral-800">Melihat analisis terdahulu</h5>

                                    <p>
                                        Jika anda ingin melihat analisis terdahulu atau yang pernah dilakukan sebelumnya, anda dapat menekan hyperlink text “klik disini” pada halaman dashboard / tampilan pertama ketika mengakses web ini.
                                    </p>

                                    <div class="h-full w-full overflow-hidden rounded-xl shadow-lg mb-5">
                                        <img src="{{ asset('assets/images/userGuide/login.png') }}" alt="Images Login User Guide" class="h-full w-full object-cover object-center">
                                    </div>

                                    <p>
                                        Kemudian anda akan melihat tampilan berupa tabel analisis penelitian terdahulu yang pernah dilakukan sebelumnya. History analisis ini hanya akan menampilkan 10 analisis terakhir yang dilakukan dengan index nama dari setiap analisis diambil dari tanggal dan waktu dilakukannya analisis
                                    </p>

                                    <div class="h-full w-full overflow-hidden rounded-xl shadow-lg mb-5">
                                        <img src="{{ asset('assets/images/userGuide/login.png') }}" alt="Images Login User Guide" class="h-full w-full object-cover object-center">
                                    </div>
                                </div>

                                {{-- <div class="mt-10 flex justify-between">
                                    <button type="button" class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none" id="prev-to-overview">
                                        Kembali
                                    </button>

                                    <button type="button" class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none" id="next-to-prev-analysis">
                                        Selanjutnya
                                    </button>
                                </div> --}}
                            </div>

                            <div class="hidden px-4 rounded-lg" id="styled-new-analysis" role="tabpanel" aria-labelledby="new-analysis-tab">
                                <div class="flex flex-col gap-4 text-neutral-600">
                                    <h5 class="text-sm-display-semibold text-neutral-800">Pembuatan analisis baru</h5>

                                    <p>
                                        Untuk melakukan perhitungan analisis baru, jika anda baru pertama kali akses dan atau tidak dalam proses pengisian kuisioner analisis anda dapat memilih pada halaman dashboard sebagai pengguna baru. Namun apabila anda dalam proses pengisian kuisioner dan mendapati halaman tunggu setelah pengisian kuisioner tahap 1 (menunggu expert lainnya mengisi) dan akan melanjutkan ke kuisioner tahap 2 anda dapat memilih sebagai pengguna lama dan menginputkan email yang anda daftarkan sebelumnya untuk masuk.
                                    </p>

                                    <div class="h-full w-full overflow-hidden rounded-xl shadow-lg mb-5">
                                        <img src="{{ asset('assets/images/userGuide/login.png') }}" alt="Images Login User Guide" class="h-full w-full object-cover object-center">
                                    </div>

                                    <p>
                                       Setelah anda memilih sebagai pengguna baru, proses selanjutnya adalah anda dapat memilih peran pada form yang telah disediakan sebagai expert 1 / expert 2 / expert 3. Kemudian anda dapat memasukkan alamat email anda. (pastikan anda mengingat email yang didaftarkan, dikarenakan untuk pengisian kuisioner selanjutnya anda dapat masuk kembali menggunakan credential email anda sebelumnya).
                                    </p>
                                </div>

                                {{-- <div class="mt-10 flex justify-between">
                                    <button type="button" class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none" id="prev-to-overview">
                                        Kembali
                                    </button>

                                    <button type="button" class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none" id="next-to-prev-analysis">
                                        Selanjutnya
                                    </button>
                                </div> --}}
                            </div>

                            <div class="hidden px-4 rounded-lg" id="styled-first-quistioner" role="tabpanel" aria-labelledby="first-quistioner-tab">
                                <div class="flex flex-col gap-4 text-neutral-600">
                                    <h5 class="text-sm-display-semibold text-neutral-800">Isi kuisioner tahap 1</h5>

                                    <p>
                                        Setelah anda menginputkan email, anda dapat langsung mengisi kuisioner tahap 1 dengan menjawab sesuai keterangan yang diberikan pada halaman tersebut (isi semua form dengan hanya inputan V / A / X / O pada form diatas diagonal X - warna hijau)
                                    </p>

                                    <div class="h-full w-full overflow-hidden rounded-xl shadow-lg mb-5">
                                        <img src="{{ asset('assets/images/userGuide/login.png') }}" alt="Images Login User Guide" class="h-full w-full object-cover object-center">
                                    </div>

                                    <p>
                                        Jika anda telah mengisi semua form yang disediakan (diatas diagonal x), anda dapat menekan button proccess data untuk melanjutkan pada tahap berikutnya (pastikan semua form telah terisi).
                                    </p>

                                    <div class="h-full w-full overflow-hidden rounded-xl shadow-lg mb-5">
                                        <img src="{{ asset('assets/images/userGuide/login.png') }}" alt="Images Login User Guide" class="h-full w-full object-cover object-center">
                                    </div>

                                    <p>
                                        Selanjutnya jika anda mendapati halaman tunggu, maka anda belum dapat melakukan pengisian kuisioner tahap 2, ini disebabkan karena kategori risiko pada tahap 2 akan terbuat melalui perhitungan kuisioner tahap 1 yang anda dan kedua expert lainnya inputkan.
                                    </p>

                                    <p>
                                        Anda dapat meninggalkan aplikasi ini, dan anda bisa melakukan cek berkala untuk mengetahui apakah kedua expert lainnya telah mengisi dengan melakukan login pada menu pengguna lama dengan email yang anda gunakan sebelumnya
                                    </p>

                                    <div class="h-full w-full overflow-hidden rounded-xl shadow-lg mb-5">
                                        <img src="{{ asset('assets/images/userGuide/login.png') }}" alt="Images Login User Guide" class="h-full w-full object-cover object-center">
                                    </div>
                                </div>

                                {{-- <div class="mt-10 flex justify-between">
                                    <button type="button" class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none" id="prev-to-overview">
                                        Kembali
                                    </button>

                                    <button type="button" class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none" id="next-to-prev-analysis">
                                        Selanjutnya
                                    </button>
                                </div> --}}
                            </div>

                            <div class="hidden px-4 rounded-lg" id="styled-second-quistioner" role="tabpanel" aria-labelledby="second-quistioner-tab">
                                <div class="flex flex-col gap-4 text-neutral-600">
                                    <h5 class="text-sm-display-semibold text-neutral-800">Isi kuisioner tahap 2</h5>

                                    <p>
                                        Untuk melakukan kuisioner tahap 2 anda harus mengakses kembali halaman https://coffeeriskanalyzer.com/. Kemudian anda dapat login pada menu pengguna lama untuk melanjutkan pengisian kuisioner tahap 2.
                                    </p>

                                    <div class="h-full w-full overflow-hidden rounded-xl shadow-lg mb-5">
                                        <img src="{{ asset('assets/images/userGuide/login.png') }}" alt="Images Login User Guide" class="h-full w-full object-cover object-center">
                                    </div>

                                    <p>
                                        Setelah anda masuk, anda akan melihat tampilan kuisioner tahap 2 yaknik pengisian data SOD dan Linguistik (isi dengan data keterangan yang telah diberikan) seperti pada gambar berikut - pastikan semua pertanyaan terisi sebelum anda klik button selanjutnya atau proses data
                                    </p>

                                    <div class="h-full w-full overflow-hidden rounded-xl shadow-lg mb-5">
                                        <img src="{{ asset('assets/images/userGuide/login.png') }}" alt="Images Login User Guide" class="h-full w-full object-cover object-center">
                                    </div>

                                    <p>
                                        Selanjutnya jika anda mendapati halaman tunggu setelah anda klik proses data, maka anda belum dapat melihat hasil dari analisis risiko kopi. Dikarenakan hasil akhir merupakan analisis dari kombinasi jawaban anda dan kedua expert lainya. 
                                    </p>

                                    <div class="h-full w-full overflow-hidden rounded-xl shadow-lg mb-5">
                                        <img src="{{ asset('assets/images/userGuide/login.png') }}" alt="Images Login User Guide" class="h-full w-full object-cover object-center">
                                    </div>

                                    <p>
                                        Anda dapat meninggalkan aplikasi web ini jika telah mengisi, dan anda dapat melihat hasil dari analisis anda dan kedua expert lainnya melalui analisis terdahulu yang pernah dilakukan.
                                    </p>

                                    <div class="h-full w-full overflow-hidden rounded-xl shadow-lg mb-5">
                                        <img src="{{ asset('assets/images/userGuide/login.png') }}" alt="Images Login User Guide" class="h-full w-full object-cover object-center">
                                    </div>
                                </div>

                                {{-- <div class="mt-10 flex justify-between">
                                    <button type="button" class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none" id="prev-to-overview">
                                        Kembali
                                    </button>

                                    <button type="button" class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none" id="next-to-prev-analysis">
                                        Selanjutnya
                                    </button>
                                </div> --}}
                            </div>

                            <div class="hidden px-4 rounded-lg" id="styled-result" role="tabpanel" aria-labelledby="result-tab">
                                <div class="flex flex-col gap-4 text-neutral-600">
                                    <h5 class="text-sm-display-semibold text-neutral-800">Hasil analisis</h5>

                                    <p>
                                        Anda dapat melihat hasil analisis setelah anda dan kedua expert lainnya telah mengisi semua data kuisioner sebelumnya. berikut merupakan halaman tampilan hasil analisis
                                    </p>

                                    <div class="h-full w-full overflow-hidden rounded-xl shadow-lg mb-5">
                                        <img src="{{ asset('assets/images/userGuide/login.png') }}" alt="Images Login User Guide" class="h-full w-full object-cover object-center">
                                    </div>

                                    <p>
                                        Dan anda dapat melihat detail proses hasil dengan menekan button detail proses yang terletak di ujung kanan atas. Dengan ditampilkannya halaman ini maka proses analisis telah selesai dan anda dapat mengambil insight dari hasil analisis yang anda dan kedua expert lainnya lakukan.
                                    </p>

                                    <div class="h-full w-full overflow-hidden rounded-xl shadow-lg mb-5">
                                        <img src="{{ asset('assets/images/userGuide/login.png') }}" alt="Images Login User Guide" class="h-full w-full object-cover object-center">
                                    </div>
                                    
                                    <p>
                                        Jika anda ingin melihat hasil analisis anda kembali, anda dapat melihat melalui analisis terdahulu pada laman pertama yang ditampilkan pada web ini (namun jika analisis anda masih termasuk 10 analisis terakhir yang dilakukan). Terimakasih, selamat mencoba.
                                    </p>
                                </div>

                                {{-- <div class="mt-10 flex justify-start">
                                    <button type="button" class="h-full text-neutral-600 border border-neutral-400 hover:bg-neutral-100 font-medium rounded-lg text-base px-5 py-2.5 focus:outline-none" id="prev-to-overview">
                                        Kembali
                                    </button>
                                </div> --}}
                            </div>

                        </div>
                    </div>
                    
                    <div class="col-span-1"></div>
                </div>
            </div>
        </div>
    </section>
@endsection