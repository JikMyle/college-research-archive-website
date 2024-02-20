<div class="flex justify-center items-center relative h-full">
    <x-input.button 
        :attributes='$button->attributes'
        aria-expanded="false">
        {{ $button }}
    </x-input.button>

    <ul {{ $menu->attributes->merge([
        'class' => 'flex flex-col absolute top-full right-0 mt-7 w-64 bg-white shadow-md rounded-lg',
        'aria-hidden' => 'true'
    ])}}>
        {{ $menu }}
    </ul>
</div>