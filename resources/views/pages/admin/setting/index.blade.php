@extends('components.partials.layouts.admin.main')

@section('content')
    <section>
        <h3 class="text-center text-sm-display-semibold md:text-md-display-semibold text-neutral-950">Role & Permission</h3>

        <div class="mt-8 md:mt-16">
            {{-- Tables --}}
            <x-table.index
                :columns="[
                    'Level',
                    'Email',
                    'Password',
                ]"
                :button="false"
                :headerTable="false"
                :action="false"
            >
                @foreach( $users as $key => $user )
                    <tr class="border-b border-neutral-400">
                        <td class="text-center px-5 py-9">{{ $key++ + 1  }}</td>
                        <td class="px-5 py-9 capitalize">{{ $user->role  }}</td>
                        <td class="px-5 py-9">{{ $user->email  }}</td>
                        <td class="px-5 py-9 w-10">
                            <input class="border-none p-0 bg-transparent" type="password" value="********************" disabled />
                        </td>
{{--                        <td class="px-5 py-9">--}}
{{--                            <div class="flex flex-col md:flex-row items-center justify-center gap-2">--}}
{{--                                <button type="button" class="flex flex-row gap-2 items-center p-2 hover:bg-neutral-200 rounded-lg" data-modal-target="add_risk" data-modal-toggle="add_risk">--}}
{{--                                    <i class="iconsax text-2xl" icon-name="brush-1"></i>--}}

{{--                                    Edit--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </td>--}}
                    </tr>
                @endforeach

            </x-table.index>

        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/tables.js') }}"></script>
@endpush
