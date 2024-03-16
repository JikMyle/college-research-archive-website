
@php
    $dateText = '';
    $keywordPlaceHolder = '';
    $route = Route::current()->getName();

    switch ($route) {
        case 'admin.users':
            $dateText = 'Registered';
            $keywordPlaceHolder = 'Search for id, username, or name...';
            break;
        
        case('admin.documents' || 'library'):
            $dateText = 'Submitted';
            $keywordPlaceHolder = 'Search for title, author, keywords...';
            break;

        default:
            break;
    }
@endphp

<form 
    class="flex flex-row align-center justify-between w-3/5 flex-wrap gap-y-4 gap-x-2"
    id="searchBar"
    action=''
    method="get">

    <div class="flex flex-row items-center justify-between basis-full gap-2">
        <x-input.text-field class="w-full h-12">
            <x-slot:input
                id='keywords'
                name='keywords'
                type='text'
                placeholder="Search for title, author, keywords..."
                value="{{Request::get('keywords')}}">
            </x-slot:input>
        </x-input.text-field>

        <x-input.button
            class="box-border pr-[0.6rem] scale-110"
            :icon='asset("icons/icons.svg#gg-search")'
            iconAlt='search icon'>
        </x-input.button>
    </div>

    <x-input.text-field 
        class="flex-grow h-9 basis-5/12 md:basis-3/12 lg:basis-1/5"
        label='{{ $dateText }} From' 
        :alwaysShowLabel='true'>

        <x-slot:input 
            class="dark:scheme-dark"
            id='dateFrom'
            name='dateFrom'
            type='number'
            min=1900
            step=1
            placeholder="2000"
            value="{{Request::get('dateFrom')}}">
        </x-slot:input>
    </x-input.text-field>

    <x-input.text-field 
        class="flex-grow h-9 basis-5/12 md:basis-3/12 lg:basis-1/5"
        label='{{ $dateText }} To' 
        :alwaysShowLabel='true'>

        <x-slot:input 
            class="dark:scheme-dark"
            id='dateTo'
            name='dateTo'
            type='number'
            min=1900
            step=1
            placeholder="2000"
            value="{{Request::get('dateTo')}}">
        </x-slot:input>
    </x-input.text-field>

    @if (Route::is('library') || Route::is('admin.documents'))
        <x-input.dropdown 
            class="flex-grow h-9 basis-5/12 md:basis-3/12 lg:basis-1/5"
            label='Program' 
            :alwaysShowLabel='true' 
            name='program'>
            
            <x-slot:dropdown id="program">
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

    @elseif (Route::is('admin.users'))
        <x-input.dropdown 
            class="flex-grow h-9 basis-5/12 md:basis-3/12 lg:basis-1/5"
            label='Access Level' 
            :alwaysShowLabel='true' 
            name='accessLevel'>
            
            <x-slot:dropdown id="accessLevel">
                <x-input.dropdown.item>
                    ...
                </x-input.dropdown.item>

                <x-input.dropdown.item value='0'>
                   Regular
                </x-input.dropdown.item>

                <x-input.dropdown.item value='1'>
                    Admin
                </x-input.dropdown.item>
            </x-slot:dropdown>
        </x-input.dropdown>
    @endif

    <x-input.dropdown 
        class="flex-grow h-9 basis-5/12 md:basis-3/12 lg:basis-3/5"
        label='Sort By' 
        :alwaysShowLabel='true' 
        name='sortBy'>
        
        <x-slot:dropdown id="sortBy">
            <x-input.dropdown.item>
                ...
            </x-input.dropdown.item>

            @if (Route::current()->getPrefix() === '/admin')
                <x-input.dropdown.item value='id asc'>
                    ID (Lowest)
                </x-input.dropdown.item>

                <x-input.dropdown.item value='id desc'>
                    ID (Highest)
                </x-input.dropdown.item>
            @endif

            @if (Route::is('admin.users'))
                <x-input.dropdown.item value='username asc'>
                    Username (A-Z)
                </x-input.dropdown.item>

                <x-input.dropdown.item value='username desc'>
                    Username (Z-A)
                </x-input.dropdown.item>

                <x-input.dropdown.item value='last_name asc'>
                    Last Name (A-Z)
                </x-input.dropdown.item>

                <x-input.dropdown.item value='last_name desc'>
                    Last Name (Z-A)
                </x-input.dropdown.item>

                <x-input.dropdown.item value='created_at asc'>
                    Date Registered (Oldest)
                </x-input.dropdown.item>

                <x-input.dropdown.item value='created_at desc'>
                    Date Registered (Newest)
                </x-input.dropdown.item>
            @endif

            @if (Route::is('admin.documents') || Route::is('library'))
                <x-input.dropdown.item value='title asc'>
                    Title (A-Z)
                </x-input.dropdown.item>

                <x-input.dropdown.item value='title desc'>
                    Title (Z-A)
                </x-input.dropdown.item>

                <x-input.dropdown.item value='year_submitted asc'>
                    Year Submitted (Oldest)
                </x-input.dropdown.item>

                <x-input.dropdown.item value='year_submitted desc'>
                    Year Submitted (Newest)
                </x-input.dropdown.item>
            @endif
        </x-slot:dropdown>
    </x-input.dropdown>
    
    @if (Route::is('admin.users') || Route::is('admin.documents'))
        <label class="flex flex-row items-center h-9 gap-2 text-sm text-text-light dark:text-text-dark leading-4 cursor-pointer">
            <span class="md:hidden">Show Trash</span>
            <span class="hidden md:inline">Show<br>Trash</span>

            <input
                class='w-4 h-4 mr-2 border-input-border-light dark:border-input-border-dark cursor-pointer'
                type="checkbox"
                name="showTrash" 
                id="showTrash"
                @if (Request::get('showTrash')) checked @endif>
        </label>
    @endif
</form>