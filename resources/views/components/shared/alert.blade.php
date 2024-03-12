@php
    $listStyle = '';

    if (count($messages) > 1) {
        $listStyle = ' list-disc list-inside ';
    }
@endphp

<div {{ $attributes->merge(['class' => 'alert alert-'. $type]) }}>
    <ul class="{{ $listStyle }}">
        @foreach ($messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
    

    <button 
        type='button' 
        class="text-inherit transition-scale hover:brightness-125 active:scale-75"
        aria-label="Close">

        <svg class="w-5 h-5 text-inherit">
            <use 
                width='100%' 
                height='100%' 
                href='{{ asset('icons/icons.svg#gg-close') }}'>
            </use>
        </svg>    
    </button>
</div>