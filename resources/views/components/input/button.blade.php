@props([
    'icon' => '',
    'iconAlt' => '',
])

<button
    {{ 
        $attributes->merge([
            'class' => "button flex flex-row gap-1 h-fit text-base rounded-xl",
            ])
    }}>

    @if ($icon && str_contains($icon, '.svg'))
        <svg class="w-6 h-6 text-inherit">
            <use width='100%' height='100%' href='{{ $icon }}'></use>
        </svg>    
    @elseif ($icon)
        <img src="{{ $icon }}" alt='{{ $iconAlt }}'>
    @endif
                    
    @if (!$slot->isEmpty())
        <span>{{ $slot }}</span>
    @endif
</button>