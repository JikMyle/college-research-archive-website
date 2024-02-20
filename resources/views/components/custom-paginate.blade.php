@if ($paginator->hasPages())
    <nav   
        class="paginator"
        role="navigation" 
        aria-label="{{ __('Pagination Navigation') }}" >

        @if ($paginator->onFirstPage())
            <span 
                class="border-none !bg-transparent"
                aria-disabled="true" 
                aria-label="{{ __('pagination.previous') }}">
                <svg class="w-8 h-8 text-placeholder dark:text-white">
                    <use 
                        width='100%' 
                        height='100%'
                        href='{{ asset("icons/icons.svg#gg-chevron-left")}}'>
                    </use>
                </svg>
            </span>
        @else
            <a 
                class="button !bg-transparent"
                href="{{ $paginator->previousPageUrl() }}" 
                rel="prev" 
                aria-label="{{ __('pagination.previous') }}">
                <svg class="w-8 h-8 text-placeholder dark:text-white">
                    <use 
                        width='100%' 
                        height='100%'
                        href='{{ asset("icons/icons.svg#gg-chevron-left")}}'>
                    </use>
                </svg>            
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span
                    class="border-none !bg-transparent"
                    aria-disabled="true">
                    {{ $element }}
                </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span 
                            aria-current="page">
                            {{ $page }}
                        </span>
                    @else
                        <a 
                            class="button !bg-transparent"
                            href="{{ $url }}" 
                            aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a 
                class="button !bg-transparent"
                href="{{ $paginator->nextPageUrl() }}" 
                rel="next" 
                aria-label="{{ __('pagination.next') }}">
                <svg class="w-8 h-8 mr-1 text-placeholder dark:text-white">
                    <use 
                        width='100%' 
                        height='100%' 
                        href='{{ asset("icons/icons.svg#gg-chevron-right")}}'>
                    </use>
                </svg>            
            </a>
        @else
            <span 
                class="border-none !bg-transparent"
                aria-disabled="true" 
                aria-label="{{ __('pagination.next') }}">
                <svg class="w-8 h-8 mr-1 text-placeholder dark:text-white">
                    <use 
                        width='100%' 
                        height='100%' 
                        href='{{ asset("icons/icons.svg#gg-chevron-right")}}'>
                    </use>
                </svg>
            </span>
        @endif
    </nav>
@endif
