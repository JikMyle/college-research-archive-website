<x-shared.layout title='Edit Document'>
    <div class="flex w-full h-auto flex-col lg:flex-row flex-wrap items-center lg:items-start lg:justify-evenly gap-7 mt-auto mb-16 lg:my-auto">
        <x-shared.logo class="justify-center w-full mt-4"></x-logo>

        <div class="flex w-4/5 lg:hidden border-b-2 border-input-border-light dark:border-input-border-dark"></div>

        <x-input.form 
            class="w-3/5 lg:w-4/12 max-sm:self-center" 
            :showLogo='false' 
            :action='route("admin.updateDocument", $document->id)'
            enctype='multipart/form-data' 
            method='post'>
            @method('patch')

            <x-slot:header>
                <h3 class="w-full text-center lg:text-start font-bold text-4xl text-sub-text dark:text-text-dark">
                    Edit Document
                </h3>
            </x-slot:header>

            <x-slot:alerts>
                @if ($errors->any() && session('updated') != 'author')
                    <x-shared.alert 
                        type='error'
                        :messages='$errors->all()'
                        class="basis-3/5 flex-grow"
                    />

                @elseif (session('success') && session('updated') == 'info')
                    <x-shared.alert 
                        type='success'
                        :messages='[session("success")]'
                        class="basis-3/5 flex-grow"
                    />
                @endif
            </x-slot:alerts>

            <div class="flex flex-row flex-wrap w-full items-start gap-3">
                <input type="hidden" name='documentAction' value='updateDocInfo'>

                <x-input.text-field 
                    class="w-full"
                    label='Title'>

                    <x-slot:input 
                        class="!border-0 !border-b-2 !rounded-none w-full"
                        id='title'
                        name='title'
                        placeholder='Title'
                        value='{{ $document->title }}'
                        required>
                    </x-slot:input>
                </x-input.text-field>

                <x-input.text-field
                    class="w-fit h-11" 
                    label='Date Submitted: '>

                    <x-slot:input
                        class="dark:scheme-dark"
                        id='date_submitted'
                        name='date_submitted'
                        value='{{ $document->date_submitted }}'
                        type='date'
                        required>
                    </x-slot:input>
                </x-input.text-field>

                <x-input.dropdown
                    class="basis-1/2 flex-grow h-11" 
                    label='Program:'
                    :alwaysShowLabel='true' 
                    name='program'>

                    <x-slot:dropdown id="program" required>
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

                <input 
                    class="flex w-full border-none text-text-light dark:text-text-dark !p-0 file:hover:!drop-shadow-none file:shadow-sm file:mr-4 file:rounded-xl file:border-none h-auto file:button"
                    id='upload_file'
                    name='upload_file'
                    type='file'>

                <textarea 
                    class="flex w-full p-2 text-base rounded-xl bg-white dark:bg-transparent border-2 border-input-border-light dark:border-input-border-dark text-text-light dark:text-text-dark dark:placeholder:text-text-dark"
                    name="excerpt" 
                    id="excerpt" rows="3"
                    placeholder="Except / Summary here">{{ $document->excerpt }}</textarea>
            </div>
            
            <div class="flex gap-6">
                <a href="{{ route('admin.documents')}}">
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

        <div class="flex w-4/5 h-auto lg:w-auto lg:self-stretch border-b-2 lg:border-b-2 lg:border-r-2 border-input-border-light dark:border-input-border-dark"></div>

        <div class="flex flex-wrap w-3/5 lg:w-4/12 max-sm:self-center gap-4">
            <h3 class="w-full text-center lg:text-start font-bold text-3xl text-sub-text dark:text-text-dark">
                Authors
            </h3>

            <x-input.form 
                class="w-full items-center"
                :showLogo='false' 
                action='{{ route("admin.addAtuhor", $document->id) }}' 
                method='post'>

                @method('patch')

                <x-slot:alerts>
                    @if ($errors->any() && session('updated') == 'author')
                        <x-shared.alert 
                            type='error'
                            :messages='$errors->all()'
                            class="basis-3/5 flex-grow"
                        />

                    @elseif (session('success') && session('updated') == 'author')
                        <x-shared.alert 
                            type='success'
                            :messages='[session("success")]'
                            class="basis-3/5 flex-grow"
                        />
                    @endif
                </x-slot:alerts>

                <input type="hidden" name='documentAction' value='addAuthor'>
                
                <div class="flex flex-row w-full gap-4">
                    <x-input.text-field class="basis-1/3 flex-grow">
                        <x-slot:input 
                            class="author-first-name w-full"
                            name='authors[0][first_name]'
                            placeholder='First Name'
                            value="{{ old('authors.0.first_name') }}"
                            required>
                        </x-slot:input>
                    </x-input.text-field>
    
                    <x-input.text-field class="basis-1/3 flex-grow">
                        <x-slot:input 
                            class="author-last-name w-full"
                            name='authors[0][last_name]'
                            placeholder='Last Name'
                            value="{{ old('authors.0.first_name') }}"
                            required>
                        </x-slot:input>
                    </x-input.text-field>
    
                    <x-input.button 
                        class="basis-1/12 justify-center"
                        :icon='asset("icons/icons.svg#gg-add-r")'
                        type="submit">
                        Add
                    </x-input.button>
                </div>
            </x-input.form>

            <div class="flex w-full h-auto lg:self-stretch border-b-2 lg:border-b-2 lg:border-r-2 border-input-border-light dark:border-input-border-dark"></div>

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
                                    :icon='asset("icons/icons.svg#gg-trash")'    
                                    iconAlt='trash icon'>
                                </x-input.button>
                            </td>
                        </tr>
                    @endfor
                </table>
            </x-input.form>
        </div>
    </div>
</x-shared.layout>