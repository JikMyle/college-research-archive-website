@props([
    'label' => '',
    'setLabelOnTop' => false,
    'name'
])

@php
    $layoutClass = 'flex-row justify-between gap-2 items-center';
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
            for="{{ $dropdown->attributes->get('id') }}">
            {{ $label }}
        </label>
    @endif

    <select {{$dropdown->attributes->merge([
                'class' => 'h-10 p-2 text-base text-left border-input-border-light dark:border-input-border-dark dark:bg-transparent dark:text-text-dark border-2 rounded-xl',
                'name' => $name,
            ])}}>

    {{ $dropdown }}

    </select>
</div>