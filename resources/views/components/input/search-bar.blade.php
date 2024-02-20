<form 
    class="flex flex-col align-center w-3/5"
    id="searchBar"
    action=''
    method="get">

    <div class="flex flex-row align-center justify-between">
        <input 
            class="flex-grow p-2 text-text-light dark:text-text-dark bg-white dark:bg-transparent border-2 border-input-border-light dark:border-input-border-dark rounded-lg"
            type="text"
            name="keywords"
            placeholder="Search for author, title, or keywords..."
            value="{{Request::get('keywords')}}">

        <button
            class="flex w-12 h-12 ml-2 p-1 justify-center items-stretch button bg-yellow-300 border-2 border-input-border-light dark:border-input-border-dark rounded-lg"
            type="submit">
            <img
                class="object-contain"
                src="{{ asset('images/search.svg')}}" 
                alt="magnifying glass icon">
        </button>
    </div>

    <div class="flex flex-row flex-wrap align-center justify-start mt-2">
        <div class="flex flex-row flex-grow justify-between my-1 xl:flex-grow-0">
            <div class="flex flex-col items-left mr-2 basis-1/2">
                <label 
                    class="text-sm text-text-light dark:text-text-dark"
                    for="dateFrom">
                    Date From:
                </label>
                <input 
                    class="p-1 text-sm text-text-light dark:text-text-dark bg-white dark:bg-transparent border-2 border-input-border-light dark:border-input-border-dark rounded-lg"
                    type="date"
                    name='dateFrom'
                    id="dateFrom"
                    value="{{Request::get('dateFrom')}}">
            </div>

            <div class="flex flex-col items-left basis-1/2 md:mr-2">
                <label 
                    class="text-sm text-text-light dark:text-text-dark"
                    for="dateTo">
                    Date To:
                </label>
                <input 
                    class="p-1 text-sm text-text-light dark:text-text-dark bg-white dark:bg-transparent border-2 border-input-border-light dark:border-input-border-dark rounded-lg"
                    type="date"
                    name='dateTo'
                    id="dateTo"
                    value="{{Request::get('dateTo')}}">
            </div>
        </div>

        @if (Route::is('library') || Route::is('admin.documents'))
            <div class="flex flex-col items-left my-1 mr-2 w-40 lg:w-52 lg:flex-grow">
                <label 
                    class="text-sm text-text-light dark:text-text-dark"
                    for="program">
                    Program:
                </label>
                <select 
                    class="p-1 text-base text-text-light dark:text-text-dark bg-white dark:bg-transparent border-2 border-input-border-light dark:border-input-border-dark rounded-lg"
                    name='program'
                    id="program">

                    <option 
                        class="text-text-light"
                        value="">
                        ...
                    </option>

                    <option 
                        class="text-text-light"
                        value="bsit"
                        @if (Request::get('program') === 'bsit') ? selected @endif>
                        Information Technology
                    </option>

                    <option 
                        class="text-text-light"
                        value="bscs"
                        @if (Request::get('program') === 'bscs') ? selected @endif>
                        Computer Science
                    </option>

                    <option 
                        class="text-text-light"
                        value="bsis"
                        @if (Request::get('program') === 'bsis') ? selected @endif>
                        Information System
                    </option>

                    <option 
                        class="text-text-light"
                        value="bsemc"
                        @if (Request::get('program') === 'bsemc') ? selected @endif>
                        Entertainment and Multimedia Computing
                    </option>
                </select>
            </div>

        @elseif (Route::is('admin.users'))
            <div class="flex flex-col items-left my-1 mr-2 md:basis-1/3 xl:basis-auto">
                <label 
                    class="text-sm text-text-light dark:text-text-dark"
                    for="accessLevel">
                    Access Level
                </label>

                <select 
                    class="p-1 text-base text-text-light dark:text-text-dark bg-white dark:bg-transparent border-2 border-input-border-light dark:border-input-border-dark rounded-lg"
                    name="accessLevel" 
                    id="accessLevel">

                    <option 
                        class="text-text-light"
                        value="">
                        ...
                    </option>

                    <option 
                        class="text-text-light"
                        value="0"
                        @if (Request::get('accessLevel') === '0') ? selected @endif>
                        Student
                    </option>

                    <option 
                        class="text-text-light"
                        value="1"
                        @if (Request::get('accessLevel') === '1') ? selected @endif>
                        Administrator
                    </option>
                </select>
            </div>
        @endif

        <div class="flex flex-col items-left my-1 flex-grow md:mr-2">
            <label 
                class="text-sm text-text-light dark:text-text-dark"
                for="sortBy">
                Sort By:
            </label>
            <select 
                class="p-1 text-base text-text-light dark:text-text-dark bg-white dark:bg-transparent border-2 border-input-border-light dark:border-input-border-dark rounded-lg"
                name="sortBy" 
                id="sortBy">

                <option value=''>...</option>

                @if (Route::current()->getPrefix() === '/admin')
                    <option 
                        class="text-text-light"
                        value="id asc" 
                        @if (Request::get('sortBy') === 'id asc') selected @endif>
                        ID (Asc)
                    </option>

                    <option 
                        class="text-text-light"
                        value="id desc"  
                        @if (Request::get('sortBy') === 'id desc') selected @endif>
                        ID (Desc)
                    </option>
                @endif

                @if (Route::is('admin.users'))
                    <option 
                        class="text-text-light"
                        value="username asc" 
                        @if (Request::get('sortBy') === 'username asc') ? selected @endif>
                        Username (Asc)
                    </option>

                    <option 
                        class="text-text-light"
                        value="username desc" 
                        @if (Request::get('sortBy') === 'username desc') ? selected @endif>
                        Username (Desc)
                    </option>

                    <option 
                        class="text-text-light"
                        value="last_name asc" 
                        @if (Request::get('sortBy') === 'last_name asc') ? selected @endif>
                        Last Name (Asc)
                    </option>

                    <option 
                        class="text-text-light"
                        value="last_name desc" 
                        @if (Request::get('sortBy') === 'last_name desc') ? selected @endif>
                        Last Name (Desc)
                    </option>

                    <option 
                        class="text-text-light"
                        value="created_at asc" 
                        @if (Request::get('sortBy') === 'created_at asc') ? selected @endif>
                        Date Registered (Asc)
                    </option>

                    <option 
                        class="text-text-light"
                        value="created_at desc" 
                        @if (Request::get('sortBy') === 'created_at desc') ? selected @endif>
                        Date Registered (Desc)
                    </option>
                @endif

                @if (Route::is('admin.documents') || Route::is('library'))
                    <option 
                        class="text-text-light"
                        value="title asc" 
                        @if (Request::get('sortBy') === 'title asc') ? selected @endif>
                        Title (Asc)
                    </option>
                    
                    <option 
                        class="text-text-light"
                        value="title desc" 
                        @if (Request::get('sortBy') === 'title desc') ? selected @endif>
                        Title (Desc)
                    </option>

                    <option 
                        class="text-text-light"
                        value="date_submitted asc" 
                        @if (Request::get('sortBy') === 'date_submitted asc') ? selected @endif>
                        Date Submitted (Asc)
                    </option>

                    <option 
                        class="text-text-light"
                        value="date_submitted desc" 
                        @if (Request::get('sortBy') === 'date_submitted desc') ? selected @endif>
                        Date Submitted (Desc)
                    </option>
                @endif
            </select>
        </div>
        
        @if (Route::is('admin.users') || Route::is('admin.documents'))
            <div class="flex flex-row items-center justify-center mt-2 md:mt-1">
                <label 
                    class="text-sm text-text-light dark:text-text-dark leading-4"
                    for="showTrash">
                    <span class="md:hidden">Show Trashed Entries</span>
                    <span class="hidden md:inline">Show<br>Trashed<br>Entries</span>
                </label>

                <input
                    class='w-4 h-4 ml-2 border-input-border-light dark:border-input-border-dark cursor-pointer'
                    type="checkbox"
                    name="showTrash" 
                    id="showTrash"
                    @if (Request::get('showTrash')) checked @endif>
            </div>
        @endif
    </div>
</form>