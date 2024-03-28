@props([
    'iconHref' => '',
])

<a
    {{ 
        $attributes->merge([
            'class' => 'box-border flex flex-row h-fit max-h-full w-fit items-center my-auto text-text-light dark:text-text-dark',
            'href' => ''
        ])
    }}>

    {{-- Note: Icon size is set here but can be changed via a class in slot --}}
    @if ($iconHref && str_contains($iconHref, '.svg'))
        <svg 
            {{
                $icon->attributes->merge([
                    'class' => 'w-7 h-7 text-inherit',
                    'data-activate-on' => 'hover',
                    'aria-controls' => $label->attributes['id'],
                ])
            }}>

            <use width=100% height=100% href='{{ $iconHref }}'></use>
            {{ $icon }}
        </svg>
    @endif

    <p {{ 
            $label->attributes->merge([
                'class' => 'leading-4 mx-1 text-sm text-inherit transition duration-150 pointer-events-none aria-hidden:w-0 aria-hidden:-translate-x-4 aria-hidden:opacity-0'
            ])
        }}>

        {{ $label }}
    </p>
</a>