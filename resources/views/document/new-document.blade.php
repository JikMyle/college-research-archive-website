<x-shared.layout title='New Document'>
    <div class="flex flex-grow flex-col xl:flex-row my-auto xl:my-0 items-center justify-center xl:justify-evenly gap-10">
        <p class="mt-10 text-5xl font-bold text-center md:text-left text-text-light dark:text-text-dark">
            New Document
        </p>

        <div class="flex w-4/5 h-auto xl:w-auto xl:h-4/5 border-b-2 xl:border-b-2 xl:border-r-2 border-input-border-light dark:border-input-border-dark"></div>

        <x-input.form class="w-4/5 xl:w-auto" :showLogo='true' action='{{ route("admin.documents") }}' method='post' enctype='multipart/form-data'>
            <div class="flex flex-grow flex-col items-start gap-3">
                <input type="hidden" name='documentAction' value='createDocument'>

                <x-input.text-field class="w-full">
                    <x-slot:input 
                        class="!border-0 !border-b-2 !rounded-none flex-grow"
                        id='title'
                        name='title'
                        placeholder='Title'
                        required>
                    </x-slot:input>
                </x-input.text-field>

                <div class="flex flex-grow flex-row gap-4">
                    <x-input.text-field label='Date Submitted: '>
                        <x-slot:input 
                            class="w-fit"
                            id='date_submitted'
                            name='date_submitted'
                            type='date'
                            required>
                        </x-slot:input>
                    </x-input.text-field>

                    <x-input.dropdown label='Program:' name='program'>
                        <x-slot:dropdown id="program" class="flex-grow w-64" required>
                            <x-input.dropdown.item>
                                ...
                            </x-input.dropdown.item>

                            <x-input.dropdown.item value='bscs'>
                                Computer Science
                            </x-input.dropdown.item>

                            <x-input.dropdown.item value='bsit'>
                                Information Technology
                            </x-input.dropdown.item>

                            <x-input.dropdown.item value='bsit'>
                                Information System
                            </x-input.dropdown.item>

                            <x-input.dropdown.item value='bsit'>
                                Entertainment and Multimedia Computing
                            </x-input.dropdown.item>
                        </x-slot:dropdown>
                    </x-input.dropdown>
                </div>

                <x-input.text-field>
                    <x-slot:input 
                        class="border-none !p-0 file:shadow-sm file:mr-4 file:rounded-xl file:border-none h-auto file:button"
                        id='upload_file'
                        name='upload_file'
                        type='file'
                        required>
                    </x-slot:input>
                </x-input.text-field>

                <textarea 
                    class="flex w-full p-2 text-base rounded-xl bg-white dark:bg-transparent border-2 border-input-border-light dark:border-input-border-dark text-text-light dark:text-text-dark dark:placeholder:text-text-dark"
                    name="excerpt" 
                    id="excerpt" rows="2"
                    placeholder="Except / Summary here">{{ old('excerpt') }}</textarea>
            </div>

            <div class="flex self-stretch flex-col gap-3 mt-4">
                <div class="flex self-stretch justify-between">
                    <h3 class="font-bold text-3xl text-sub-text dark:text-text-dark">
                        Authors
                    </h3>

                    <x-input.button id="addAuthorBtn">
                        Add Author
                    </x-input.button>
                </div>

                <table id='authorTable'>
                    @if (old('authors'))
                        @for ($i = 0; $i < count(old('authors')); $i++)
                            <tr class="author-row" id="author{{ $i }}">
                                <td class="author-number p-4 text-text-light dark:text-text-dark">
                                    {{ $i + 1 }}
                                </td>
                                <td>
                                    <x-input.text-field class="!justify-center w-11/12">
                                        <x-slot:input 
                                            class="author-first-name !border-0 !border-b-2 !rounded-none flex-grow"
                                            name='authors[{{ $i }}][first_name]'
                                            placeholder='First Name'
                                            value="{{ old('authors.' . $i . '.first_name') }}"
                                            required>
                                        </x-slot:input>
                                    </x-input.text-field>
                                </td>
                                <td>
                                    <x-input.text-field class="!justify-center w-11/12">
                                        <x-slot:input 
                                            class="author-last-name !border-0 !border-b-2 !rounded-none flex-grow"
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
                                <x-input.text-field class="!justify-center w-11/12">
                                    <x-slot:input 
                                        class="author-first-name !border-0 !border-b-2 !rounded-none flex-grow"
                                        name='authors[0][first_name]'
                                        placeholder='First Name'
                                        required>
                                    </x-slot:input>
                                </x-input.text-field>
                            </td>
                            <td>
                                <x-input.text-field class="!justify-center w-11/12">
                                    <x-slot:input 
                                        class="author-last-name !border-0 !border-b-2 !rounded-none flex-grow"
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

                <div class="border-b-2 w-full my-2 border-input-border-light dark:border-input-border-dark">

                </div>

                <div class="flex self-stretch justify-center gap-5">
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
            </div>
        </x-input.form>
    </div>
</x-shared.layout>
