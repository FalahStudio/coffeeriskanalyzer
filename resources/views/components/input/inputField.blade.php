@props([
    'inputId' => 'coffeeriskInput',
    'type'    => 'text',
    'placeholder' => 'Input Field',
    'name'  => '',
    'value' => '',
    'label' => 'Label',
    'required' => true,
])

<div>
    <label for="{{ $inputId }}" class="block mb-3 text-lg-body-medium text-neutral-800">{{ $label }} {!! $required ? '<span class="text-primary-700">*</span>' : '' !!}</label>
    <input type="{{ $type }}" id="{{ $inputId }}" class="bg-white border border-neutral-400 text-neutral-800 text-lg-body-medium placeholder:text-neutral-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full py-3 px-4" name="{{ empty($name) ? $inputId : $name }}" placeholder="{{ $placeholder }}" value="{{ $value }}">
</div>