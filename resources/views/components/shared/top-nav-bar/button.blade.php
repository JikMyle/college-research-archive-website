@props([
    'iconHref' => ''
])

<button {{ 
    $attributes->merge([
        'class' => 'flex text-text-light dark:text-text-dark'
        ])
}}>

    {{-- Note: Icon size is set here but can be changed via a class in slot --}}
    @if ($iconHref && str_contains($iconHref, '.svg'))
        <svg 
            {{
                $icon->attributes->merge([
                    'class' => 'w-7 h-7 text-inherit',
                ])
            }}>

            <use width=100% height=100% href='{{ $iconHref }}'></use>

            {{ $icon }}
        </svg>
    @endif
</button>