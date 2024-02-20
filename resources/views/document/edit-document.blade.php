<x-shared.layout title='Edit Document'>
    <div class="flex flex-grow flex-col gap-7 my-auto xl:my-0">
        <div class="flex justify-center items-center my-6">
            <img 
                class="dark:hidden w-auto h-52 object-contain"
                src="{{ asset('images/logo-light.png')}}" 
                alt="">

            <img 
                class="hidden dark:flex w-auto h-52 object-contain"
                src="{{ asset('images/logo-dark.png')}}" 
                alt="">
        </div>

        <div class="flex self-center xl:hidden w-4/5 h-auto border-b-2 border-input-border-light dark:border-input-border-dark"></div>

        <div class="flex lg:flex-grow flex-col xl:flex-row items-center justify-center lg:justify-evenly gap-10">
            <x-input.form class="w-4/5 md:w-2/5" :showLogo='false' action='{{ route("admin.updateDocument", $document->id) }}' method='post' enctype='multipart/form-data'>
                @method('patch')

                <x-slot:header>
                    <h3 class="font-bold text-4xl text-sub-text dark:text-text-dark">
                        Edit Document
                    </h3>
                </x-slot:header>

                <x-slot:alerts>
                    @if ($errors->any() && session('updated') != 'author')
                        <x-shared.alert 
                            type='error'
                            :messages='$errors->all()'
                        />

                    @elseif (session('success') && session('updated') == 'info')
                        <x-shared.alert 
                            type='success'
                            :messages='[session("success")]'
                        />
                    @endif
                </x-slot:alerts>

                <div class="flex flex-grow flex-col items-start gap-3">
                    <input type="hidden" name='documentAction' value='updateDocInfo'>

                    <x-input.text-field class="w-full">
                        <x-slot:input 
                            class="!border-0 !border-b-2 !rounded-none flex-grow"
                            id='title'
                            name='title'
                            placeholder='Title'
                            value='{{ $document->title }}'
                            required>
                        </x-slot:input>
                    </x-input.text-field>

                    <div class="flex flex-grow flex-row gap-4">
                        <x-input.text-field label='Date Submitted: '>
                            <x-slot:input 
                                class="w-[10rem]"
                                id='date_submitted'
                                name='date_submitted'
                                value='{{ $document->date_submitted }}'
                                type='date'
                                required>
                            </x-slot:input>
                        </x-input.text-field>

                        <x-input.dropdown label='Program:' name='program'>
                            <x-slot:dropdown id="program" class="flex-grow w-48" required>
                                <x-input.dropdown.item>
                                    ...
                                </x-input.dropdown.item>

                                <x-input.dropdown.item value='bscs' :selected='($document->program == "bscs")'>
                                    Computer Science
                                </x-input.dropdown.item>

                                <x-input.dropdown.item value='bsit' :selected='($document->program == "bsit")'>
                                    Information Technology
                                </x-input.dropdown.item>

                                <x-input.dropdown.item value='bsis' :selected='($document->program == "bsis")'>
                                    Information System
                                </x-input.dropdown.item>

                                <x-input.dropdown.item value='bsemc' :selected='($document->program == "bsemc")'>
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
                            type='file'>
                        </x-slot:input>
                    </x-input.text-field>

                    <textarea 
                        class="flex w-full p-2 text-base rounded-xl bg-white dark:bg-transparent border-2 border-input-border-light dark:border-input-border-dark text-text-light dark:text-text-dark dark:placeholder:text-text-dark"
                        name="excerpt" 
                        id="excerpt" rows="2"
                        placeholder="Except / Summary here">{{ $document->excerpt }}</textarea>
                </div>

                <div class="flex flex-row justify-between items-center gap-6">
                    <a href="">
                        <x-input.button
                            class="px-10">
                            Back
                        </x-input.button>
                    </a>
    
                    <x-input.button
                        name='btnUpdateDocument'
                        type='submit'
                        value='btnUpdateDocument'>
                        Save Changes
                    </x-input.button>
                </div>
            </x-input.form>

            <div class="flex w-4/5 h-auto xl:w-auto xl:h-4/5 border-b-2 xl:border-b-2 xl:border-r-2 border-input-border-light dark:border-input-border-dark"></div>

            <div class="flex flex-col items-center w-4/5 md:w-2/5 gap-3 mb-10 xl:mb-0">
                <h3 class="font-bold text-3xl text-sub-text dark:text-text-dark">
                    Authors
                </h3>

                <x-input.form :showLogo='false' action='{{ route("admin.addAtuhor", $document->id) }}' method='post'>
                    @method('patch')

                    <x-slot:alerts>
                        @if ($errors->any() && session('updated') == 'author')
                            <x-shared.alert 
                                type='error'
                                :messages='$errors->all()'
                            />

                        @elseif (session('success') && session('updated') == 'author')
                            <x-shared.alert 
                                type='success'
                                :messages='[session("success")]'
                            />
                        @endif
                    </x-slot:alerts>

                    <div class="flex self-stretch justify-start gap-3">
                        <input type="hidden" name='documentAction' value='addAuthor'>

                        <x-input.text-field class="basis-2/5">
                            <x-slot:input 
                                class="author-first-name w-full"
                                name='authors[0][first_name]'
                                placeholder='First Name'
                                value="{{ old('authors.0.first_name') }}"
                                required>
                            </x-slot:input>
                        </x-input.text-field>

                        <x-input.text-field class="basis-2/5">
                            <x-slot:input 
                                class="author-last-name w-full"
                                name='authors[0][last_name]'
                                placeholder='Last Name'
                                value="{{ old('authors.0.first_name') }}"
                                required>
                            </x-slot:input>
                        </x-input.text-field>

                        <x-input.button 
                            class="basis-1/5 justify-center"
                            :icon='asset("icons/icons.svg#gg-add-r")'
                            type="submit">
                            Add
                        </x-input.button>
                    </div>
                </x-input.form>

                <div class="border-b-2 w-full my-2 border-input-border-light dark:border-input-border-dark"></div>

                <x-input.form
                    class="w-full"
                    :showLogo='false' 
                    action='{{ route("admin.removeAuthor", $document->id)}}' 
                    method='post'>

                    <x-slot:alerts></x-slot:alerts>

                    @method('patch')

                    <input type="hidden" name='documentAction' value='removeAuthor'>

                    <table class="w-full">
                        @for ($i = 0; $i < $document->authors->count(); $i++)
                            <tr class="border-b-2 border-placeholder">
                                <td class="text-center py-4 px-2 text-text-light dark:text-text-dark">{{ $i + 1 }}</td>
                                <td class="text-center w-48 text-text-light dark:text-text-dark">{{ $document->authors[$i]['first_name'] }}</td>
                                <td class="text-center w-48 text-text-light dark:text-text-dark">{{ $document->authors[$i]['last_name'] }}</td>
                                <td class="text-center align-middle text-text-light dark:text-text-dark">
                                    <input 
                                        class="hidden"
                                        type="checkbox"
                                        name='author_id' 
                                        value='{{$document->authors[$i]['id']}}'>

                                    <x-input.button
                                        class="removeAuthorBtn button-delete inline-flex"
                                        :icon='asset("icons/icons.svg#gg-close")'    
                                        iconAlt='trash icon'>
                                    </x-input.button>
                                </td>
                            </tr>
                        @endfor
                    </table>
                </x-input.form>
            </div>
        </div>
    </div>
</x-shared.layout>