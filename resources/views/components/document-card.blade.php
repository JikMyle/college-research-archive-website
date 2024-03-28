@props(['document' => ''])

@php
    $imgPath = "storage/thumbnails/" . $document->id . ".jpg";

    if(!file_exists(public_path($imgPath))) {
        $imgPath = "images/blank-document.jpg";
    }
@endphp

<a 
    class="flex flex-col relative max-w-64 h-72 md:h-96 xl:h-[28rem] bg-white shadow-md md:hover:drop-shadow md:hover:scale-105 transition"
    href="{{ route('viewDocument', $document->id )}}">

    <img 
        class="object-cover h-4/5 z-0"
        src="{{ asset($imgPath) }}" 
        alt="Document Cover Page">

    <div class="absolute bottom-0 left-0 flex flex-col justify-end w-full h-4/5 md:h-3/5 bg-gradient-to-t from-card-bg-light dark:from-gray-950 from-35% md:from-50% to-70% md:to-85% to-transparent">
        
        <div class="flex flex-col h-2/5 md:h-3/5 lg:h-1/2 justify-between p-2">
            <p class="text-base font-bold text-text-light dark:text-text-dark leading-4 max-md:truncate md:line-clamp-2">
                {{ $document->title }}
            </p>

            <div class="flex flex-col gap-1">
                <p class="text-sm text-text-light dark:text-sub-text max-md:truncate md:line-clamp-2">
                    {{ strtoupper($document->program) }}
                </p>

                <p class="text-sm text-text-light dark:text-sub-text leading-4 max-md:truncate md:line-clamp-2">
                    @php
                        
                    @endphp
                    @foreach ($document->authors as $author)
                        @php
                            $name = $author->first_name . " " . $author->last_name;
                        @endphp

                        @if ($loop->iteration == 1 && $loop->count > 2)
                            {{ $name . ' and ' . $loop->count - 1 . ' more...' }}
                            @break

                        @elseif ($loop->iteration == 2)
                            {{ $name}}
                            
                        @else 
                            {{ $name . ', '}}
                        @endif
                    @endforeach
                </p>
            </div>

            <p class="text-sm text-text-light dark:text-sub-text algin-self-end text-ellipsis">
                {{ $document->year_submitted }}
            </p>
        </div>
    </div>
</a>