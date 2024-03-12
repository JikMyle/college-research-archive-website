<nav class="flex flex-row w-full justify-between items-center">
    <x-shared.top-nav-bar.item-group class="px-3">
        @auth
            <x-shared.top-nav-bar.item>
                <a class="h-full flex flex-row items-center gap-2" href="{{ route('library') }}">
                    <svg 
                        class="h-8 w-8 text-text-light dark:text-text-dark"
                        id="libaryTopNavIcon"
                        aria-label='Library'
                        aria-controls='libraryTopNavLabel'
                        data-activate-on='hover'>

                        <use href='{{ asset("icons/library.svg#icon")}}'></use>
                    </svg>
                    <p 
                        class="leading-4 text-sm text-text-light dark:text-text-dark transition duration-150 pointer-events-none aria-hidden:w-0 aria-hidden:-translate-x-4 aria-hidden:opacity-0"
                        id="libraryTopNavLabel"
                        aria-hidden='true'>
                        Library
                    </p>
                </a>
            </x-shared.top-nav-bar.item>

            @if (Auth::user() && Auth::user()->is_admin)
                <x-shared.top-nav-bar.item>
                    <a class='h-full flex flex-row items-center gap-2' href="{{ route('admin.documents') }}">
                        <svg class="h-8 w-8 text-text-light dark:text-text-dark"
                            id="documentsTopNavIcon"
                            aria-label='Document Database'
                            aria-controls='documentsTopNavLabel'
                            data-activate-on='hover'>

                            <use href='{{ asset("icons/documents.svg#icon")}}'></use>
                        </svg>
                        <p 
                            class="leading-4 text-sm text-text-light dark:text-text-dark transition duration-150 pointer-events-none aria-hidden:w-0 aria-hidden:-translate-x-4 aria-hidden:opacity-0"
                            id="documentsTopNavLabel"
                            aria-hidden='true'>
                            Document<br>Database
                        </p>
                    </a>
                </x-shared.top-nav-bar.item>

                <x-shared.top-nav-bar.item>
                    <a class="h-full flex flex-row items-center gap-2" href="{{ route('admin.users') }}">
                        <svg class="h-8 w-8 text-text-light dark:text-text-dark"
                            id="userTopNavIcon"
                            aria-label='User Database'
                            aria-controls='usersTopNavLabel'
                            data-activate-on='hover'>

                            <use href='{{ asset("icons/users.svg#icon")}}'></use>
                        </svg>
                        <duration-150
                            class="leading-4 text-sm text-text-light dark:text-text-dark transition duration-150 pointer-events-none aria-hidden:w-0 aria-hidden:-translate-x-4 aria-hidden:opacity-0"
                            id="usersTopNavLabel"
                            aria-hidden='true'>
                            User<br>Database
                        </p>
                    </a>
                </x-shared.top-nav-bar.item>
            @endif
        @endauth
    </x-shared.top-nav-bar.item-group>

    <x-shared.top-nav-bar.item-group>
        <x-shared.top-nav-bar.item>
            <button id="lightModeBtn" data-theme=''>
                <svg class="h-7 w-7 !p-0 !text-text-dark button hidden bg-none dark:flex !bg-transparent hover:rotate-12 transition active:shadow-none"
                    aria-label='Dark Mode Off'>

                    <use width='100%' height='100%' href='{{ asset("icons/icons.svg#gg-sun")}}'></use>
                </svg>
            </button>

            <button id="nightModeBtn" data-theme='dark'>
                <svg class="h-7 w-7 !p-0 text-text-light button dark:hidden bg-none !bg-transparent hover:rotate-12 transition active:shadow-none"
                    aria-label='Dark Mode On'>

                    <use width='100%' height='100%' href='{{ asset("icons/icons.svg#gg-moon")}}'></use>
                </svg>
            </button>
        </x-shared.top-nav-bar.item>

        <x-shared.top-nav-bar.item>
            <x-shared.dropdown-menu>
                <x-slot:button
                    :icon='asset("icons/icons.svg#gg-menu")'
                    iconAlt='navigation bar dropdown menu button'
                    class="scale-125 p-1 bg-none !bg-transparent text-text-light dark:text-text-dark"
                    aria-expanded='false'
                    aria-controls='topNavMenu'>
                </x-slot:button>

                <x-slot:menu
                    class="aria-hidden:pointer-events-none aria-hidden:opacity-0 aria-hidden:-translate-y-7 transition duration-75"
                    id="topNavMenu"
                    role='menu'>

                    <a class='flex w-full' href="/about">
                        <x-shared.dropdown-menu.item
                            :icon='asset("icons/icons.svg#gg-info")'
                            iconAlt='info icon'>
                            About&nbspUs
                        </x-shared.dropdown-menu.item>
                    </a>

                    @auth
                        <a class='flex w-full' href="/account">
                            <x-shared.dropdown-menu.item
                                :icon='asset("icons/icons.svg#gg-profile")'
                                iconAlt='user profile icon'>
                                Account&nbspSettings
                            </x-shared.dropdown-menu.item>
                        </a>

                        <a class='flex w-full' href="/logout">
                            <x-shared.dropdown-menu.item
                                :icon='asset("icons/icons.svg#gg-log-out")'
                                iconAlt='account security icon'>
                                Sign&nbspOut
                            </x-shared.dropdown-menu.item>
                        </a>
                        
                    @else
                        <a class='flex w-full' href="/login">
                            <x-shared.dropdown-menu.item
                                :icon='asset("icons/icons.svg#gg-log-in")'
                                iconAlt='account security icon'>
                                Sign&nbspIn
                            </x-shared.dropdown-menu.item>
                        </a>
                    @endauth
                    
                    
                </x-slot:menu>
            </x-shared.dropdown-menu>

            {{-- <button
                class="h-full"
                id='nav-links-drawer-button'
                aria-expanded='false' 
                aria-controls="nav-links-drawer" 
                onclick="$('#nav-links-drawer').toggle()">

                <img 
                    class="h-full object-contain dark:brightness-200 dark:contrast-200"
                    src="{{asset('images/hamburger.png')}}" 
                    alt="Hamburger icon">
            </button> --}}

            <ul 
                id="nav-links-drawer"
                class="absolute right-0 mt-20 w-48 text-right bg-white" 
                hidden>

                <a href="/about"><li class="text-xl py-3 pr-3" >About</li></a>

                @auth
                    <a href="/account"><li class="text-xl py-3 pr-3">Account</li></a>
                    <a href="/logout"><li class="text-xl py-3 pr-3">Logout</li></a>
                @else
                    <a href="/login"><li class="text-xl py-3 pr-3">Login</li></a>
                @endauth
            </ul>
        </x-shared.top-nav-bar.item>
    </x-shared.top-nav-bar.item-group>
</nav>