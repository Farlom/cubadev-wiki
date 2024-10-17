<div>

    {{--        <h1>Поиск</h1>--}}
    <div class="flex">


        <input type="text" wire:model="search">
        <button wire:click="foo"
                class="bg-blue-400 text-white rounded-2xl p-2 hover:bg-blue-300 active:bg-blue-200"
        >Найти
        </button>


    </div>
    <div class="flex flex-row gap-5">
        <div class="flex flex-1 flex-col">
            @if($list)
                @foreach($list as $item)
                    <div wire:ingore.self>
                        <a href="#" wire:click="showText({{ $item->id }})">
                            {{ $item->title }}
                        </a>

                        (число вхождений: {{ $item->pivot->count }})
                    </div>
                @endforeach
            @endif
        </div>

        @livewire('content')

    </div>

</div>
