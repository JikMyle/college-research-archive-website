<div {{ $attributes->merge(['class' => 'flex h-52 w-auto overflow-hidden'])}}>
    <img 
        class="dark:hidden h-full object-scale-contain"
        src="{{ asset('images/logo-light.png')}}" 
        alt="">

    <img 
        class="hidden dark:flex h-full object-contain"
        src="{{ asset('images/logo-dark.png')}}" 
        alt="">
</div>