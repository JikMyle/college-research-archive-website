<x-shared.layout title='Document Database'>

    <div class="flex flex-grow flex-col w-full items-center">
        <div class="flex mb-6 mt-9 text-4xl md:text-5xl font-bold tracking-tighter text-placeholder dark:text-text-dark">
            @if (isset($results)) 
                Documents found: {{$results->total()}}
            @else
                No documents found
            @endif
        </div>
    
        <x-input.search-filter/>
        
        <div class="flex flex-col my-9 w-11/12 md:w-4/5 2xl:w-auto">
    
            {{-- Alerts --}}
            <div class="flex">
                @if (session('success'))
                    <x-shared.alert
                        type='success'
                        :messages='[session("success")]'
                        class="flex-grow my-3 p-3"/>
                @elseif (!$errors->isEmpty())
                    <x-shared.alert
                        type='error'
                        :messages='$errors->all()'
                        class="flex-grow my-3 p-3"/>
                @endif
            </div>
    
            {{-- Database Action Buttons --}}
            <div class="flex flex-row justify-between my-3">
                <div class="flex flex-row gap-3">
                    <a href="{{ route('admin.createDocument') }}">
                        <x-input.button
                            class="max-md:hidden"
                            :icon='asset("icons/icons.svg#gg-add-r")'>
                            Add Document
                        </x-input.button>

                        <x-input.button
                            class="md:hidden"
                            :icon='asset("icons/icons.svg#gg-add-r")'>
                        </x-input.button>
                    </a>
                    
                    @if (Request::get('showTrash'))
                        <form 
                            id="restoreDocsForm"
                            action="{{ route('admin.restoreDocument') }}" 
                            method="post">
    
                            @csrf
                            @method('patch')
    
                            <x-input.button
                                :icon='asset("icons/icons.svg#gg-undo")'
                                class="button-restore max-md:hidden"
                                type='submit'
                                data-multi-select='Document'
                                data-action='Restore'>
                                Restore Document/s
                            </x-input.button>

                            <x-input.button
                                :icon='asset("icons/icons.svg#gg-undo")'
                                class="button-restore md:hidden"
                                type='submit'
                                data-multi-select='Document'
                                data-action='Restore'>
                            </x-input.button>
                        </form>
                    @endif
    
                    <form 
                        id="deleteDocsForm"
                        action="{{ route('admin.deleteDocument') }}" 
                        method="post">
    
                        @csrf
                        @method('delete')
    
                        <x-input.button
                            :icon='asset("icons/icons.svg#gg-trash")'
                            class="button-delete max-md:hidden"
                            type='submit'
                            data-multi-select='Document'
                            :data-action='(Request::get("showTrash")) ? "Delete Forever" : "Delete"'>
                            {{ (Request::get("showTrash")) ? "Delete Forever Document/s" : "Delete Document/s" }}
                        </x-input.button>

                        <x-input.button
                            :icon='asset("icons/icons.svg#gg-trash")'
                            class="button-delete md:hidden"
                            type='submit'
                            data-multi-select='Document'
                            :data-action='(Request::get("showTrash")) ? "Delete Forever" : "Delete"'>
                        </x-input.button>
                    </form>
                </div>
    
                <div class="flex flex-row items-center">
                    <label 
                        class="text-base text-text-light dark:text-text-dark mr-3"
                        for="itemsPerPage">
                        Items Per Page: 
                    </label>
                    <select 
                        class="p-1 text-base text-text-light dark:text-text-dark bg-white dark:bg-transparent border-2 border-input-border-light dark:border-input-border-dark rounded-lg"
                        name="itemsPerPage" 
                        id="itemsPerPage"
                        form="searchBar">
    
                        <option
                            class="text-text-light" 
                            value="10">
                            10
                        </option>
    
                        <option 
                            class="text-text-light"
                            value="25"
                            @if (Request::get('itemsPerPage') == 25) selected @endif>
                            25
                        </option>
    
                        <option 
                            class="text-text-light"
                            value="50"
                            @if (Request::get('itemsPerPage') == 50) selected @endif>
                            50
                        </option>
    
                        <option 
                            class="text-text-light"
                            value="100"
                            @if (Request::get('itemsPerPage') == 100) selected @endif>
                            100
                        </option>
                    </select>
                </div>
            </div>
    
            <div id="database" data-resource='Document' class="flex w-[90vw] md:w-auto self-stretch xl:self-center overflow-auto">
                <table class="w-full">
                    <tr class="border-y-divider-light dark:border-y-divider-dark border-y-2">
                        <th class=""> 
                            <input 
                                type="checkbox" 
                                data-select-all='Document' 
                                data-input-selector='input[name="documentIds[]"]'>
                        </th>
                        <th class="align-center text-center text-text-light dark:text-text-dark font-bold text-lg leading-5 px-2 py-3">ID</th>
                        <th class="align-center text-center text-text-light dark:text-text-dark font-bold text-lg leading-5 px-10 py-3">Title</th>
                        <th class="align-center text-center text-text-light dark:text-text-dark font-bold text-lg leading-5 px-10 py-3">Authors</th>
                        <th class="align-center text-center text-text-light dark:text-text-dark font-bold text-lg leading-5 px-6 py-3">Program</th>
                        <th class="align-center text-center text-text-light dark:text-text-dark font-bold text-lg leading-5 px-10 py-3">Year Submitted</th>
                        <th class="align-center text-center text-text-light dark:text-text-dark font-bold text-lg leading-5 px-10 py-3">Date Uploaded</th>
                        {{-- <th class="align-center text-center text-text-light dark:text-text-dark font-bold text-lg leading-5 px-10 py-3">Date Modified</th> --}}
                        <th></th>
                    </tr>
    
                    @foreach ($results as $document)
                        <tr class="border-b-divider-light dark:border-b-gray-900 border-y-2">
                            <td class="align-center text-center p-3">
                                <input 
                                    class="cb{{$document->id}}"
                                    type="checkbox"
                                    name="documentIds[]"
                                    value="{{ $document->id }}"
                                    data-resource='Document'>
    
                                <input 
                                    class="cb{{$document->id}} hidden"
                                    type="checkbox"
                                    name="documentIds[]"
                                    value="{{ $document->id }}"
                                    form="deleteDocsForm">
    
                                @if (Request::get('showTrash'))
                                    <input 
                                        class="cb{{$document->id}} hidden"
                                        type="checkbox"
                                        name="documentIds[]"
                                        value="{{ $document->id }}"
                                        form='restoreDocsForm'>
                                @else
                                    <input 
                                        class="cb{{$document->id}} hidden"
                                        type="checkbox"
                                        name="documentIds[]"
                                        value="{{ $document->id }}"
                                        form="updateAccessForm">
                                @endif
                            </td>
                            <td class="text-center align-center text-text-light dark:text-text-dark font-base">{{ $document->id }}</td>
                            <td class="text-center align-center text-text-light dark:text-text-dark font-base">
                                <a 
                                    class="hover:underline line-clamp-2"
                                    href="{{ route('viewDocument', $document->id )}}">
                                    {{ $document->title }}
                                </a>
                                
                            </td>
                            <td class="text-center align-center text-text-light dark:text-text-dark font-base">{{ strtoupper($document->program) }}</td>
                            <td class="text-center align-center text-text-light dark:text-text-dark font-base py-1">
                                @foreach ($document->authors as $author)
                                    <p class="text-sm text-text-light dark:text-text-dark">
                                        {{$author->first_name}}&#160;{{$author->last_name}}
                                    </p>

                                    @if ($loop->count > 2 && $loop->iteration == 1) 
                                        <p class="text-sm text-text-light dark:text-text-dark">
                                            and {{ $loop->count - 2 }} more...
                                        </p>
                                        @break 
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-center align-center text-text-light dark:text-text-dark font-base">{{ $document->year_submitted }}</td>
                            <td class="text-center align-center text-text-light dark:text-text-dark font-base">{{ $document->date_uploaded }}</td>
                            {{-- <td class="text-center align-center text-text-light dark:text-text-dark font-base">{{ $document->date_last_updated }}</td> --}}
                            
                            {{-- Single Row Action Buttons --}}
                            <td class="text-center align-center p-2">
                                <div class="flex flex-row flex-wrap items-center justify-between gap-2 w-full">
                                    @if (!Request::get('showTrash'))
                                        <a href="{{route('admin.editDocument', $document->id)}}">
                                            <x-input.button
                                                :icon='asset("icons/icons.svg#gg-pen")'
                                                iconAlt='Pen icon'/>
                                        </a>
    
                                    @else
                                        <x-input.button
                                            :icon='asset("icons/icons.svg#gg-undo")'
                                            iconAlt='Undo Icon'
                                            class="button-restore"
                                            form="restoreDocsForm"
                                            data-single-submit
                                            data-input-selector='cb{{$document->id}}'/>
                                    @endif
    
                                    <x-input.button
                                        :icon='asset("icons/icons.svg#gg-trash")'
                                        iconAlt='Trash Icon'
                                        class="button-delete"
                                        form="deleteDocsForm"
                                        data-single-submit
                                        data-input-selector='cb{{$document->id}}'/>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
    
            {{-- Pagination --}}
            <div class="py-9">
                {{ $results->withQueryString()->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
    
    </x-shared.layout>