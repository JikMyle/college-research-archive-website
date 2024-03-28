@props([
    'expandIconHref' => '',
    'collapseIconHref' => '',
])

<button
    {{ 
        $attributes->merge([
            'class' => "box-border flex flex-row items-center gap-1 h-fit text-sm text-text-light hover:underline dark:text-text-dark",
            'type' => 'button',
            'aria-expanded' => 'false',
            'aria-controls' => ''
            ])
    }}>
                  
    @if (!$expandLabel->isEmpty() && !$collapseLabel->isEmpty())
        <p class="text-inherit expanded">{{ $expandLabel }}</p>
        <p class="text-inherit collapsed hidden">{{ $collapseLabel }}</p>
    @endif

    <svg 
        {{ 
            $icon->attributes->merge([
                'class' => 'expanded w-6 h-6 text-inherit'
            ]) 
        }}>

        <use width=100% height=100% href='{{ $expandIconHref }}'></use>
        {{ $icon }}
    </svg>

    <svg 
        {{ 
            $icon->attributes->merge([
                'class' => 'collapsed hidden w-6 h-6 text-inherit'
            ]) 
        }}>

        <use width=100% height=100% href='{{ $collapseIconHref }}'></use>
        {{ $icon }}
    </svg>
</button>