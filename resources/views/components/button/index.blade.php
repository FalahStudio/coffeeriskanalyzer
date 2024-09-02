@props([
    'title'      => 'Button',
    'transform'  => 'capitalize',
    'icon'       => false,
    'icon_left'  => true,
    'icon_right' => false,
    'icon_name_left'   => '',
    'icon_name_right'  => '' ,
    'type'       => 'button',
    'color'      => 'primary',
    'buttonId'   => 'cofferiskButton',
    'buttonClass'      => '',
    'weight'     => 'semibold'
])

@empty($color)
    @php
        $color = 'primary';
    @endphp
@endempty

@if ($color === 'primary')
    @php
        $colorType = 'text-white bg-primary-700 border border-primary-700 hover:bg-primary-800';
        $colorIconType = 'text-white';
    @endphp
@endif

@if ($color === 'outline')
    @php
        $colorType = 'text-primary-700 bg-white border border-primary-700 hover:bg-neutral-50';
        $colorIconType = 'text-primary-700';
    @endphp
@endif

@if ($color === 'clear')
    @php
        $colorType = 'text-neutral-600 bg-white hover:bg-neutral-50';
        $colorIconType = 'text-primary-700';
    @endphp
@endif

<button id="{{ $buttonId }}" type="button" class="focus:outline-none focus:ring-0 rounded-lg text-md-body-{{ $weight }} py-2.5 px-6 flex items-center gap-2 w-auto {{ $transform . ' ' . $colorType . ' ' . $buttonClass }}">
    @if ($icon_left && $icon)
        <svg class="hidden sm:block w-4 h-4 {{ $colorIconType }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.15 5.6h.01m3.337 1.913h.01m-6.979 0h.01M5.541 11h.01M15 15h2.706a1.957 1.957 0 0 0 1.883-1.325A9 9 0 1 0 2.043 11.89 9.1 9.1 0 0 0 7.2 19.1a8.62 8.62 0 0 0 3.769.9A2.013 2.013 0 0 0 13 18v-.857A2.034 2.034 0 0 1 15 15Z"/>
        </svg>
    @endif

    {{ $title }}

    @if ($icon_right && $icon)
        <svg class="hidden sm:block w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.15 5.6h.01m3.337 1.913h.01m-6.979 0h.01M5.541 11h.01M15 15h2.706a1.957 1.957 0 0 0 1.883-1.325A9 9 0 1 0 2.043 11.89 9.1 9.1 0 0 0 7.2 19.1a8.62 8.62 0 0 0 3.769.9A2.013 2.013 0 0 0 13 18v-.857A2.034 2.034 0 0 1 15 15Z"/>
        </svg>
    @endif
</button>