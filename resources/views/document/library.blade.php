<x-shared.layout title='Document Library'>

<div class="flex flex-grow flex-col w-screen items-center">
    <div class="flex mb-6 mt-9 text-4xl md:text-5xl font-bold tracking-tighter text-placeholder dark:text-text-dark">
        Document Library
    </div>

    <x-input.search-filter/>

    <div class="flex flex-col my-9 w-11/12 2xl:w-9/12">

        {{-- Layout and code could still be improved --}}
        <div class="flex flex-col max-md:items-center max-md:gap-y-2 md:flex-row md:grid md:grid-cols-3 w-full justify-between my-3">
            <div class="hidden md:flex"></div>
            
            <div class="flex h-fit self-center items-center justify-self-center text-lg text-text-light dark:text-text-dark">
                @if ($results->total() !=0)
                    Documents found: {{ $results->total() }}
                @else
                    No documents found.
                @endif
            </div>

            <div class="flex flex-row items-center justify-self-center md:justify-self-end">
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

        {{-- Document Card Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-8 items-center justify-items-center">
            @foreach ($results as $document)
                <x-document-card :document='$document'/>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="py-9">
            {{ $results->withQueryString()->onEachSide(1)->links() }}
        </div>
    </div>
</div>

</x-shared.layout>