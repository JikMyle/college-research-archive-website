@aware([
    'name',
    'value',
])

<option {{(old($name) == $value) ? 'selected' : ''}} 
    {{$attributes->merge(['class' => 'text-text-light'])}}>

    {{ $slot }}
</option>