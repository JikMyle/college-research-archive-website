@props([
    'showLogo' => 'true',
    'alerts' => '',
    'header' => '',
])

<form {{ $attributes->merge(['class' => 'flex flex-col items-center gap-6'])}}>
    @csrf
    
    @if ($showLogo)
        <x-shared.logo/>
    @endif

    {{ $header }}

    {{ $alerts }}

    @empty($alerts)
        @if (session('success'))
            <x-shared.alert 
                type='success' 
                :messages='[session("success")]'
                class='flex-grow'/>
        @elseif (!$errors->isEmpty())
            <x-shared.alert 
                type='error' 
                :messages='$errors->all()'
                class='flex-grow'/>
        @endif
    @endempty
    

    {{ $slot }}
</form>