<div>
    <div id="search" class="bg-blue-100 mx-10 h-auto p-10 rounded-2xl flex flex-col gap-5"
         x-show="show === true"
         x-transition>

        @livewire('components.search-form')

        @livewire('components.results')
    </div>
</div>
