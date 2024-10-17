<div>
    <input class="p-2 rounded-2xl"
           type="text" wire:model="title">
    <button
        class="bg-blue-400 text-white rounded-2xl p-2 hover:bg-blue-300 active:bg-blue-200"
        wire:click="import">Скопировать
    </button>
    {{ $time }}

    @livewire('articles-table')
</div>
