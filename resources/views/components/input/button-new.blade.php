@props([
    'iconHref' => '',
    'labelOnRight' => true,
])

<button
    {{ 
        $attributes->merge([
            'class' => "button box-border flex flex-row items-center gap-1 h-fit text-base rounded-xl",
            ])
    }}>

    @if (!$labelOnRight && !$slot->isEmpty())
        <span class="text-inherit">{{ $slot }}</span>
    @endif

    @if ($iconHref && str_contains($iconHref, '.svg'))
        <svg 
            {{ 
                $icon->attributes->merge([
                    'class' => 'w-6 h-6 text-inherit'
                ]) 
            }}>

            <use width=100% height=100% href='{{ $iconHref }}'></use>
            {{ $icon }}
        </svg>
    @endif
                    
    @if ($labelOnRight && !$slot->isEmpty())
        <span class="text-inherit">{{ $slot }}</span>
    @endif
</button>