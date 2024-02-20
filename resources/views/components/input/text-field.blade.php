@props([
    'label' => '',
    'setLabelOnTop' => true,
    'alwaysShowLabel' => false,
])

@php
    $layoutClass = 'flex-row justify-end gap-2 items-center';
    $labelSize = 'text-base';

    if($setLabelOnTop) {
        $layoutClass = 'flex-col justify-start items-start';
        $labelSize = 'text-xs';
    }
@endphp

<div {{ $attributes->merge(['class' => "flex relative " . $layoutClass])}}>
    @if ($label != '' && !$setLabelOnTop)
        <label 
            class='{{ $labelSize }} flex items-center justify-center text-text-light dark:text-text-dark'
            for="{{ $input->attributes->get('id') }}">
            {{ $label }}
        </label>

    @elseif ($label != '' && $setLabelOnTop)
        <label 
            class='{{ $labelSize }} flex absolute z-[2] left-3 -top-[1px] px-2 w-auto h-[3px] overflow-visible bg-bg-light dark:bg-bg-dark text-text-light dark:text-text-dark transition duration-75 aria-hidden:opacity-0 aria-hidden:translate-y-1/2'
            for="{{ $input->attributes->get('id') }}"
            @if (!$alwaysShowLabel) aria-hidden='true' @endif>
                <span class="relative -top-2">
                    {{ $label }}
                </span>
        </label>
    @endif

    

    <input {{$input->attributes->merge([
                'class' => 'box-border w-80 h-10 p-2 text-left border-input-border-light dark:border-input-border-dark dark:bg-transparent dark:text-text-dark border-2 rounded-xl  dark:placeholder:text-text-dark',
                'type' => 'text',
                'value' => old($input->attributes->get('name')),
            ])}}>

    {{ $input }}
</div>