@props([
    'label' => '',
    'setLabelOnTop' => false,
])

@php
    $layoutClass = 'flex-row justify-end gap-2 items-center';
    $labelSize = 'text-base';

    if($setLabelOnTop) {
        $layoutClass = 'flex-col justify-start items-start';
        $labelSize = 'text-sm';
    }
@endphp

<div {{ $attributes->merge(['class' => "flex " . $layoutClass])}}>
    @if ($label != '')
        <label 
            class='{{ $labelSize }} flex items-center justify-center text-text-light dark:text-text-dark'
            for="{{ $input->attributes->get('id') }}">
            {{ $label }}
        </label>
    @endif

    <input {{$input->attributes->merge([
                'class' => 'w-80 h-10 p-2 text-base text-left border-input-border-light dark:border-input-border-dark dark:bg-transparent dark:text-text-dark border-2 rounded-xl  dark:placeholder:text-text-dark',
                'type' => 'text',
                'value' => old($input->attributes->get('name'))
            ])}}>

    {{ $input }}
</div>