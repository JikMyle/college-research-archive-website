<nav class="flex flex-row w-full justify-between items-center">
    <x-shared.top-nav-bar.item-group>
        @auth
            <x-shared.top-nav-bar.item>
                <a class="h-full" href="{{ route('library') }}">
                    <img 
                        class="dark:hidden h-full hover:scale-110 transition duration-75"
                        src="{{asset('images/library-link-light.png')}}" 
                        alt="library link icon">
                    <img 
                        class="hidden dark:flex h-full hover:scale-110 transition duration-75"
                        src="{{asset('images/library-link-dark.png')}}" 
                        alt="library link icon">
                </a>
            </x-shared.top-nav-bar.item>

            @if (Auth::user() && Auth::user()->is_admin)
                <x-shared.top-nav-bar.item>
                    <a class='h-full' href="{{ route('admin.documents') }}">
                        <img 
                            class="dark:hidden h-full hover:scale-110 transition duration-75"
                            src="{{asset('images/documentDb-link-light.png')}}" 
                            alt="document database link icon">
                        <img 
                            class="hidden dark:flex h-full hover:scale-110 transition duration-75"
                            src="{{asset('images/documentDb-link-dark.png')}}" 
                            alt="document database link icon">
                    </a>
                </x-shared.top-nav-bar.item>

                <x-shared.top-nav-bar.item>
                    <a class="h-full" href="{{ route('admin.users') }}">
                        <img 
                            class="dark:hidden w-auto h-full hover:scale-110 transition duration-75"
                            src="{{asset('images/userDb-link-light.png')}}" 
                            alt="user database link icon">
                        <img 
                            class="hidden dark:flex h-full hover:scale-110 transition duration-75"
                            src="{{asset('images/userDb-link-dark.png')}}" 
                            alt="user database link icon">
                    </a>
                </x-shared.top-nav-bar.item>
            @endif
        @endauth
    </x-shared.top-nav-bar.item-group>

    <x-shared.top-nav-bar.item-group>
        <x-shared.top-nav-bar.item>
            <x-input.button
                :icon='asset("icons/icons.svg#gg-sun")'
                iconAlt='Light mode icon'
                class="hidden bg-none dark:flex !p-0 scale-150 !bg-transparent text-text-light dark:text-text-dark hover:rotate-12 transition active:shadow-none"
                id='lightModeBtn'
                data-theme=''>
            </x-input.button>
            <x-input.button
                :icon='asset("icons/icons.svg#gg-moon")'
                iconAlt='Light mode icon'
                class="flex bg-none dark:hidden !p-0 scale-150 !bg-transparent text-text-light dark:text-text-dark hover:rotate-12 transition active:shadow-none"
                id='nightModeBtn'
                data-theme='dark'>
            </x-input.button>
        </x-shared.top-nav-bar.item>

        <x-shared.top-nav-bar.item>
            <x-shared.dropdown-menu>
                <x-slot:button
                    :icon='asset("icons/icons.svg#gg-menu")'
                    iconAlt='navigation bar dropdown menu button'
                    class="scale-150 bg-none !bg-transparent text-text-light dark:text-text-dark"
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