@props([
    'icon' => '',
    'iconAlt' => '',
])

<li {{ $attributes->merge([
    'class' => 'flex flex-grow justify-start rounded-lg p-2 m-1 gap-x-3 text-base hover:bg-black hover:text-text-dark',
    'role' => 'menuItem'
])}}>
    @if ($icon && str_contains($icon, '.svg'))
        <svg class="w-6 h-6 text-inherit">
            <use width='100%' height='100%' href='{{ $icon }}'></use>
        </svg>    
    @elseif ($icon)
        <img src="{{ $icon }}" alt='{{ $iconAlt }}'>
    @endif

    {{ $slot }}
</li>