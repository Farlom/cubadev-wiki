<div>
    <div id="import" class="bg-blue-100 mx-10 mb-3 h-auto p-10 rounded-2xl flex flex-col" x-show="show === false"
         x-transition>
        <div class="flex flex-row gap-5">
            @livewire('import-form')

            @livewire('components.articles-table')

        </div>
    </div>
</div>
