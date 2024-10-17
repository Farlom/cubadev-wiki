<div>
    <div class="flex flex-col">
        <div class="flex gap-5">
            <input class="p-2 rounded-2xl border-2 border-white w-48 @error('query') border-red-500/50 @enderror focus:outline-0 focus:placeholder:text-sm" type="text" wire:model="query" placeholder="Поиск по слову">
            <button wire:click="search"
                    class="w-32 bg-blue-400 text-white rounded-2xl p-2 hover:bg-blue-300 active:bg-blue-200"
            >Найти
            </button>
        </div>
        <div>
            @error('query') {{ $message }} @enderror
        </div>
    </div>
</div>
