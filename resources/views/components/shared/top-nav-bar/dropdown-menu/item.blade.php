@props([
    'iconHref' => '',
])

<li {{ $attributes->merge([
    'class' => 'flex flex-grow justify-start p-3 md:p-2 md:m-1 gap-x-3 text-base text-text-light hover:bg-black hover:text-text-dark',
    'role' => 'menuItem'
])}}>
    @if ($iconHref && str_contains($iconHref, '.svg'))
        <svg class="w-6 h-6 text-inherit">
            <use width='100%' height='100%' href='{{ $iconHref }}'></use>
        </svg>
    @endif

    {{ $slot }}
</li>