@props(['document' => ''])

@php
    $imgPath = "storage/thumbnails/" . $document->id . ".jpg";

    if(!file_exists(public_path($imgPath))) {
        $imgPath = "images/blank-document.jpg";
    }
@endphp

<a 
    class="flex flex-col relative max-w-64 h-96 xl:h-[28rem] bg-white shadow-md hover:drop-shadow hover:scale-105 transition"
    href="{{ route('viewDocument', $document->id )}}">

    <img 
        class="object-cover h-4/5 z-0"
        src="{{ asset($imgPath) }}" 
        alt="Document Cover Page">

    <div class="absolute bottom-0 left-0 flex flex-col justify-end w-full h-3/5 z-10 bg-gradient-to-t from-card-bg-light dark:from-gray-950 from-60% md:from-50% to-85% to-transparent">
        
        <div class="flex flex-col h-[60%] md:h-1/2 justify-between p-2">
            <p class="text-base font-bold text-text-light dark:text-text-dark leading-4 line-clamp-2">
                {{ $document->title }}
            </p>

            <div class="flex flex-col gap-1">
                <p class="text-sm text-text-light dark:text-sub-text text-ellipsis">
                    {{ strtoupper($document->program) }}
                </p>

                <p class="text-sm text-text-light dark:text-sub-text leading-4 line-clamp-2">
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
                {{ $document->date_submitted }}
            </p>
        </div>
    </div>
</a>