@props([
    'showLogo' => 'true',
    'alerts' => '',
    'header' => '',
])

<form {{ $attributes->merge(['class' => 'flex flex-col items-center gap-6'])}}>
    @csrf

    {{ $header }}

    @if ($showLogo)
        <img 
            class="dark:hidden w-auto h-48 object-contain"
            src="{{ asset('images/logo-light.png')}}" 
            alt="">

        <img 
            class="hidden dark:flex w-auto h-48 object-contain"
            src="{{ asset('images/logo-dark.png')}}" 
            alt="">
    @endif

    {{ $alerts }}

    @empty($alerts)
        @if (session('success'))
            <x-shared.alert type='success' :messages='[session("success")]'/>
        @elseif (!$errors->isEmpty())
            <x-shared.alert type='error' :messages='$errors->all()'/>
        @endif
    @endempty
    

    {{ $slot }}
</form>