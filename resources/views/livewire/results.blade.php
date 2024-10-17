<div>
    <div class="flex flex-row gap-5">
        @error('word')
        <p class="text-red-500">
            {{ $message }}
        </p>
        @enderror

        <div class="flex flex-1 flex-col">
            @if($word)
                @foreach($word->articles as $article)
                    <div wire:ingore.self>
                        <a href="#" wire:click="showText({{ $article->id }})">
                            {{ $article->title }}
                        </a>

                        (число вхождений: {{ $article->pivot->count }})
                    </div>
                @endforeach
            @endif
        </div>
        <div class="flex-1">
        @livewire('content')
        </div>
    </div>
</div>
