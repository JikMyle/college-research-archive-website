<x-shared.layout title='New Document'>
    <div class="flex m-auto w-full flex-col lg:flex-row items-center justify-center lg:justify-evenly">
        <div class='flex relative my-16'>
            <p class="z-[1] text-5xl font-bold text-center md:text-left text-text-light dark:text-text-dark">
                Add New Document
            </p>
    
            <img 
                class="dark:hidden absolute -z-[1] -translate-y-1/2 scale-75 lg:scale-125"
                src="{{ asset('images/yellow-stain.svg')}}" 
                alt="">
        </div>

        {{-- <div class="flex w-4/5 h-auto xl:w-auto xl:h-4/5 border-b-2 xl:border-b-2 xl:border-r-2 border-input-border-light dark:border-input-border-dark"></div> --}}

        <x-input.form 
            class="w-3/5 lg:w-1/3" 
            :showLogo='true' 
            action='{{ route("admin.documents") }}' 
            method='post' 
            enctype='multipart/form-data'>
            
            <div class="flex flex-row flex-wrap items-start justify-between gap-y-4 gap-x-2">
                <input type="hidden" name='documentAction' value='createDocument'>

                <x-input.text-field 
                    class="w-full"
                    label='Title'>

                    <x-slot:input 
                        class="border-0 !border-b-2 rounded-none"
                        id='title'
                        name='title'
                        placeholder='Title'
                        required>
                    </x-slot:input>
                </x-input.text-field>

                <x-input.text-field 
                    class="basis-1/5 flex-shrink h-10"
                    label='Date Submitted: '
                    :alwaysShowLabel='true'>

                    <x-slot:input 
                        id='date_submitted'
                        name='date_submitted'
                        type='date'
                        required>
                    </x-slot:input>
                </x-input.text-field>

                <x-input.dropdown 
                    class="basis-2/5 flex-grow h-10"
                    label='Program:'
                    :alwaysShowLabel='true' 
                    name='program'>

                    <x-slot:dropdown 
                        id="program"
                        required>

                        <x-input.dropdown.item>
                            ...
                        </x-input.dropdown.item>

                        <x-input.dropdown.item value='bscs'>
                            Computer Science
                        </x-input.dropdown.item>

                        <x-input.dropdown.item value='bsit'>
                            Information Technology
                        </x-input.dropdown.item>

                        <x-input.dropdown.item value='bsis'>
                            Information System
                        </x-input.dropdown.item>

                        <x-input.dropdown.item value='bsemc'>
                            Entertainment and Multimedia Computing
                        </x-input.dropdown.item>
                    </x-slot:dropdown>
                </x-input.dropdown>

                <input 
                    class="flex w-full border-none !p-0 file:shadow-sm file:mr-4 file:rounded-xl file:border-none h-auto file:button"
                    id='upload_file'
                    name='upload_file'
                    type='file'
                    required>

                <textarea 
                    class="flex w-full p-2 text-base rounded-xl bg-white dark:bg-transparent border-2 border-input-border-light dark:border-input-border-dark text-text-light dark:text-text-dark dark:placeholder:text-text-dark"
                    name="excerpt" 
                    id="excerpt" rows="2"
                    placeholder="Except / Summary here">{{ old('excerpt') }}</textarea>
            </div>

            <div class="flex flex-row flex-wrap justify-center gap-3 mt-4">
                <h3 class="flex flex-grow font-bold text-3xl text-sub-text dark:text-text-dark">
                    Authors
                </h3>

                <x-input.button id="addAuthorBtn" type='button'>
                    Add Author
                </x-input.button>

                <table class="w-full" id='authorTable'>
                    @if (old('authors'))
                        @for ($i = 0; $i < count(old('authors')); $i++)
                            <tr class="author-row" id="author{{ $i }}">
                                <td class="author-number p-4 text-text-light dark:text-text-dark">
                                    {{ $i + 1 }}
                                </td>
                                <td>
                                    <x-input.text-field class="px-2">
                                        <x-slot:input 
                                            class="author-first-name !border-0 !border-b-2 !rounded-none w-full"
                                            name='authors[{{ $i }}][first_name]'
                                            placeholder='First Name'
                                            value="{{ old('authors.' . $i . '.first_name') }}"
                                            required>
                                        </x-slot:input>
                                    </x-input.text-field>
                                </td>
                                <td>
                                    <x-input.text-field class="px-2">
                                        <x-slot:input 
                                            class="author-last-name !border-0 !border-b-2 !rounded-none w-full"
                                            name='authors[{{ $i }}][last_name]'
                                            placeholder='Last Name'
                                            value="{{ old('authors.' . $i . '.first_name') }}"
                                            required>
                                        </x-slot:input>
                                    </x-input.text-field>
                                </td>
                                <td>
                                    <x-input.button
                                        class="button-delete"
                                        :icon='asset("icons/icons.svg#gg-close")'
                                        iconAlt='close icon'
                                        data-author='author{{ $i }}'>
                                    </x-input.button>
                                </td>
                            </tr>
                        @endfor
                    @else
                        <tr class="author-row" id="author0">
                            <td class="author-number p-4 text-text-light dark:text-text-dark">
                                1
                            </td>
                            <td>
                                <x-input.text-field class="px-2">
                                    <x-slot:input 
                                        class="author-first-name !border-0 !border-b-2 !rounded-none w-full"
                                        name='authors[0][first_name]'
                                        placeholder='First Name'
                                        required>
                                    </x-slot:input>
                                </x-input.text-field>
                            </td>
                            <td>
                                <x-input.text-field class="px-2">
                                    <x-slot:input 
                                        class="author-last-name !border-0 !border-b-2 !rounded-none w-full"
                                        name='authors[0][last_name]'
                                        placeholder='Last Name'
                                        required>
                                    </x-slot:input>
                                </x-input.text-field>
                            </td>
                            <td>
                                <x-input.button
                                    class="button-delete"
                                    :icon='asset("icons/icons.svg#gg-close")'
                                    iconAlt='close icon'
                                    data-author='author0'>
                                </x-input.button>
                            </td>
                        </tr>
                    @endif
                </table>

                <div class="border-b-2 w-full my-2 border-input-border-light dark:border-input-border-dark"></div>

                
                <a href="{{ route('admin.documents') }}">
                    <x-input.button class="px-12">
                        Back
                    </x-input.button>
                </a>

                <x-input.button
                    name='btnCreateDocument'
                    value='btnCreateDocument'
                    type='submit'>
                    Add New Document
                </x-input.button>
            </div>
        </x-input.form>
    </div>
</x-shared.layout>
