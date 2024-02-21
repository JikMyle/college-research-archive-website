@props([
    'label' => '',
    'labelOnSide' => false,
    'alwaysShowLabel' => false,
])

<div {{ $attributes->merge(['class' => 'flex flex-row items-center gap-3'])}}>
    @if ($label && $labelOnSide)
            <label 
                class='flex text-text-light dark:text-text-dark'
                for="{{ $input->attributes->get('id') }}">
                {{ $label }}
            </label>
        @endif

    <fieldset 
        {{ $input->attributes->only('class')->merge(['class' => 'flex w-full h-full relative border-input-border-light bg-transparent dark:border-input-border-dark dark:bg-transparent dark:text-text-dark border-2 rounded-xl  dark:placeholder:text-text-dark'])}}>

        @if ($label && !$labelOnSide)
            <legend 
                class="z-[1] pointer-events-none flex items-center h-0 ml-2 px-2 {{ (!$alwaysShowLabel) ? 'aria-hidden:absolute transition duration-75 aria-hidden:opacity-0 aria-hidden:translate-y-4': '' }}"
                @if (!$alwaysShowLabel) aria-hidden='true' @endif>
                
                <label 
                    class='text-sm '
                    for="{{ $input->attributes->get('id') }}"
                    >
                        {{ $label }}
                </label>
            </legend>
        @endif

        <input {{$input->attributes->except('class')->merge([
                    'class' => 'box-border w-full h-full rounded-xl p-2 bg-transparent focus:outline-none',
                    'type' => 'text',
                    'value' => old($input->attributes->get('name')),
                ])}}>

        {{ $input }}
    </fieldset>
</div>