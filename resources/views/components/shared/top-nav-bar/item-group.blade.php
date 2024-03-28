<div {{
    $attributes->merge([
        'class' => 'flex flex-row w-fit h-full items-center my-auto gap-3'
    ])
}}>
    {{ $slot }}
</div>