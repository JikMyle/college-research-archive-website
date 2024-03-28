<nav class="flex flex-row h-14 first:pl-4 w-screen justify-between items-center shadow-sm">

    {{-- Mobile Top Nav Bar Theme Buttons --}}
    <x-shared.top-nav-bar.item-group
        class='md:hidden'>

        {{-- Light Mode Button --}}
        <x-shared.top-nav-bar.button
            class="text-text-dark button hidden bg-none dark:flex !bg-transparent hover:rotate-12 transition active:shadow-none"
           :iconHref='asset("icons/icons.svg#gg-sun")'
            id="lightModeBtn" 
            data-theme=''>

            <x-slot:icon></x-slot>
        </x-shared.top-nav-bar.button>

        {{-- Dark Mode Button --}}
        <x-shared.top-nav-bar.button
            class="text-text-light button dark:hidden bg-none !bg-transparent hover:rotate-12 transition active:shadow-none"
           :iconHref='asset("icons/icons.svg#gg-moon")'
            id="nightModeBtn" 
            data-theme='dark'>

            <x-slot:icon></x-slot>
        </x-shared.top-nav-bar.button>
    </x-shared.top-nav-bar.item-group>

    {{-- Top Nav Bar Site Page Links --}}
    <x-shared.top-nav-bar.item-group
        class='max-md:hidden'>

        @auth
            <x-shared.top-nav-bar.link 
               :iconHref='asset("icons/library.svg#icon")'
                href='{{ route("library") }}'>

                <x-slot:icon></x-slot>
        
                <x-slot:label
                    aria-hidden="true"
                    id="topNavLibraryLink">
                    Library
                </x-slot>
            </x-top-nav-bar.link>
        
            @if (Auth::user()->is_admin)
                <x-shared.top-nav-bar.link 
                   :iconHref='asset("icons/documents.svg#icon")'
                    href='{{ route("admin.documents") }}'>
                    <x-slot:icon></x-slot>
            
                    <x-slot:label
                        aria-hidden="true"
                        id="topNavDocumentsLink">
                        Documents<br>Database
                    </x-slot>
                </x-top-nav-bar.link>

                <x-shared.top-nav-bar.link 
                   :iconHref='asset("icons/users.svg#icon")'
                    href='{{ route("admin.users") }}'>
                    <x-slot:icon></x-slot>
            
                    <x-slot:label
                        aria-hidden="true"
                        id="topNavUsersLink">
                        User<br>Database
                    </x-slot>
                </x-top-nav-bar.link>
            @endif
        @endauth

    </x-shared.top-nav-bar.item-group>

    <x-shared.top-nav-bar.item-group>

        {{-- These theme buttons only appear on large screens --}}
        <span class='max-md:hidden'>
            {{-- Light Mode Button --}}
            <x-shared.top-nav-bar.button
                class="text-text-dark button hidden bg-none dark:flex !bg-transparent hover:rotate-12 transition active:shadow-none"
               :iconHref='asset("icons/icons.svg#gg-sun")'
                id="lightModeBtn" 
                data-theme=''>

                <x-slot:icon></x-slot>
            </x-shared.top-nav-bar.button>

            {{-- Dark Mode Button --}}
            <x-shared.top-nav-bar.button
                class="text-text-light button dark:hidden bg-none !bg-transparent hover:rotate-12 transition active:shadow-none"
                :iconHref='asset("icons/icons.svg#gg-moon")'
                id="nightModeBtn" 
                data-theme='dark'>

                <x-slot:icon></x-slot>
            </x-shared.top-nav-bar.button>
        </span>

        {{-- 
            Top Nav Bar Dropdown Menu 
            Note: Right padding of button is set here to align dropdown menu to side
        --}}

        <x-shared.top-nav-bar.dropdown-menu 
           :iconHref='asset("icons/icons.svg#gg-menu")'>
            <x-slot:button class="pr-4"></x-slot>

            <x-slot:menu id='topNavDropDownMenu'>
                <a class='flex w-full' href="/about">
                    <x-shared.top-nav-bar.dropdown-menu.item
                       :iconHref='asset("icons/icons.svg#gg-info")'>
                        About&nbspUs
                    </x-shared.top-nav-bar.dropdown-menu.item>
                </a>

                @auth
                    <a class='flex w-full md:hidden' href="{{ route('library') }}">
                        <x-shared.top-nav-bar.dropdown-menu.item
                           :iconHref='asset("icons/library.svg#icon")'>
                            Library
                        </x-shared.top-nav-bar.dropdown-menu.item>
                    </a>

                    @if (Auth::user()->is_admin)
                        <a class='flex w-full md:hidden' href="{{ route('admin.documents') }}">
                            <x-shared.top-nav-bar.dropdown-menu.item
                               :iconHref='asset("icons/library.svg#icon")'>
                                Document Database
                            </x-shared.top-nav-bar.dropdown-menu.item>
                        </a>

                        <a class='flex w-full md:hidden' href="{{ route('admin.users') }}">
                            <x-shared.top-nav-bar.dropdown-menu.item
                               :iconHref='asset("icons/users.svg#icon")'>
                                User Database
                            </x-shared.top-nav-bar.dropdown-menu.item>
                        </a>
                    @endif

                    <a class='flex w-full' href="{{ route('account') }}">
                        <x-shared.top-nav-bar.dropdown-menu.item
                           :iconHref='asset("icons/icons.svg#gg-profile")'>
                            Account&nbspSettings
                        </x-shared.top-nav-bar.dropdown-menu.item>
                    </a>

                    <a class='flex w-full' href="{{ route('account-security') }}">
                        <x-shared.top-nav-bar.dropdown-menu.item
                           :iconHref='asset("icons/icons.svg#gg-lock")'>
                            Account&nbspSecurity
                        </x-shared.top-nav-bar.dropdown-menu.item>
                    </a>

                    <a class='flex w-full' href="/logout">
                        <x-shared.top-nav-bar.dropdown-menu.item
                           :iconHref='asset("icons/icons.svg#gg-log-out")'>
                            Sign&nbspOut
                        </x-shared.top-nav-bar.dropdown-menu.item>
                    </a>
                    
                @else
                    <a class='flex w-full' href="/login">
                        <x-shared.top-nav-bar.dropdown-menu.item
                           :iconHref='asset("icons/icons.svg#gg-log-in")'>
                            Sign&nbspIn
                        </x-shared.top-nav-bar.dropdown-menu.item>
                    </a>
                @endauth
            </x-slot:menu>

        </x-shared.top-nav-bar.dropdown-menu>

    </x-shared.top-nav-bar.item-group>
</nav>