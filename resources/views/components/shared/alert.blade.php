<div {{ $attributes->merge(['class' => 'alert alert-'.$type]) }}>
    @if (count($messages) == 1)
        <p>{{ array_pop($messages) }}</p>
    @else
        @foreach ($messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    @endif
    
</div>