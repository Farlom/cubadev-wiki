<div>
    <div id="search" class="bg-blue-100 mx-10 h-auto p-10 rounded-2xl flex flex-col gap-5"
         x-show="show === true"
         x-transition>
        @livewire('search-form')
{{--        <div class="flex flex-row gap-5">--}}
{{--            <div class="flex flex-1 flex-col">--}}
{{--                @if($list)--}}
{{--                    @foreach($list as $item)--}}
{{--                        <div wire:ingore.self>--}}
{{--                            <a href="#" wire:click="showText({{ $item->id }})">--}}
{{--                                {{ $item->title }}--}}
{{--                            </a>--}}

{{--                            (число вхождений: {{ $item->pivot->count }})--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                @endif--}}
{{--            </div>--}}

{{--            @livewire('content')--}}

{{--        </div>--}}
        {{--        @livewire('search')--}}
    </div>
</div>
