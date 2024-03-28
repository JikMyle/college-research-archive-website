@props([
    'label' => '',
    'labelOnSide' => false,
    'alwaysShowLabel' => false,
    'name'
])

<div {{ $attributes->merge(['class' => 'box-border flex flex-row items-center gap-3'])}}>
    @if ($label && $labelOnSide)
            <label 
                class='flex w-auto text-text-light dark:text-text-dark'
                for="{{ $dropdown->attributes->get('id') }}">
                {{ $label }}
            </label>
        @endif

        <fieldset 
            {{ $dropdown->attributes->only('class')->merge(['class' => 'flex flex-grow basis-1/2 h-full relative border-input-border-light bg-transparent dark:border-input-border-dark dark:bg-transparent dark:text-text-dark border-2 rounded-xl  dark:placeholder:text-text-dark'])}}>

        @if ($label && !$labelOnSide)
            <legend 
                class="z-[1] pointer-events-none flex items-center h-0 ml-2 px-2 {{ (!$alwaysShowLabel) ? 'aria-hidden:absolute transition duration-75 aria-hidden:opacity-0 aria-hidden:translate-y-4': '' }}"
                @if (!$alwaysShowLabel) aria-hidden='true' @endif>
                
                <label 
                    class='text-sm'
                    for="{{ $dropdown->attributes->get('id') }}"
                    >
                        {{ $label }}
                </label>
            </legend>
        @endif

        <select {{$dropdown->attributes->except('class')->merge([
                'class' => 'w-full h-full px-2 text-base text-left bg-transparent rounded-xl focus:outline-none',
                'name' => $name,
            ])}}>

            {{ $dropdown }}

        </select>
    </fieldset>
</div>