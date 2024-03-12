@aware([
    'name',
    'value',
])

<option {{((old($name) == $value) || Request::get($name) == $value) ? 'selected' : ''}} 
    {{$attributes->merge([
        'class' => 'text-text-light',
        'value' => '',
    ])}}>

    {{ $slot }}
</option>