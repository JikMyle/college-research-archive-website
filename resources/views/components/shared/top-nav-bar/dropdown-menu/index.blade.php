@props([
    'iconHref' => ''
])

<div {{
    $attributes->merge([
        'class' => 'box-border relative flex w-fit h-full py-auto items-center text-text-light dark:text-text-dark'
    ])
}}>

    <x-shared.top-nav-bar.button
        iconHref='{{ $iconHref }}'
        :attributes='$button->attributes'
        aria-expanded='true'
        aria-controls="{{ $menu->attributes['id'] }}">

        <x-slot:icon></x-slot:icon>

        {{ $button }}

    </x-shared.top-nav-bar.button>
    
    <ul {{
        $menu->attributes->merge([
            'class' => 'flex flex-col absolute top-full right-0 max-md:w-screen w-64 bg-white drop-shadow-lg md:*:rounded-lg aria-hidden:hidden',
            'aria-hidden' => 'true',
            'role' => 'menu',
        ])
    }}>
        {{ $menu }}
    </ul>
</div>