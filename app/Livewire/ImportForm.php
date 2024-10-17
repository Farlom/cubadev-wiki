<?php

namespace App\Livewire;

use App\Services\WikiImportService;
use Livewire\Component;

class ImportForm extends Component
{
    public ?string $title;

    public $time;

    public function import()
    {
        $service = new WikiImportService();

        $startTime = microtime(true);

        $service->import($this->title);
        $this->time = round(microtime(true) - $startTime, 2);

        $this->dispatch('article-created')->to(\App\Livewire\Components\ArticlesTable::class);
    }


    public function render()
    {
        return view('livewire.import-form');
    }
}
