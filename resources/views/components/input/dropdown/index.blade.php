@props([
    'label' => '',
    'setLabelOnTop' => true,
    'alwaysShowLabel' => false,
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

<div {{ $attributes->merge(['class' => "flex relative " . $layoutClass])}}>
    @if ($label != '' && !$setLabelOnTop)
        <label 
            class='{{ $labelSize }} flex items-center justify-center text-text-light dark:text-text-dark'
            for="{{ $dropdown->attributes->get('id') }}">
            {{ $label }}
        </label>

    @elseif ($label != '' && $setLabelOnTop)
        <label 
            class='{{ $labelSize }} flex absolute z-[2] left-3 -top-[0.15rem] px-2 w-auto h-2 overflow-visible bg-bg-light dark:bg-bg-dark text-text-light dark:text-text-dark transition duration-75 aria-hidden:opacity-0 aria-hidden:translate-y-1/2'
            for="{{ $dropdown->attributes->get('id') }}"
            @if (!$alwaysShowLabel) aria-hidden='true' @endif>
                <span class="relative -top-2">
                    {{ $label }}
                </span>
        </label>
    @endif

    <select {{$dropdown->attributes->merge([
                'class' => 'h-10 p-2 text-base text-left border-input-border-light dark:border-input-border-dark dark:bg-transparent dark:text-text-dark border-2 rounded-xl',
                'name' => $name,
            ])}}>

    {{ $dropdown }}

    </select>
</div>