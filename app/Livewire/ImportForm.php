<?php

namespace App\Livewire;

use App\Livewire\Components\ArticlesTable;
use App\Models\Article;
use App\Services\WikiImportService;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ImportForm extends Component
{
    #[Validate('required', message: 'Введите название статьи для поиска')]
    public ?string $title;

    public ?float $time;
    public ?Article $article;

    public function import()
    {
        $this->article = null;
        $this->validate();
        $service = new WikiImportService();

        $startTime = microtime(true);

        $data = $service->import($this->title);

        $this->article = $data['article'];
        if ($data['errors'])
        {
            foreach ($data['errors'] as $error)
            {
                $this->addError('title', $error);
            }
        }

        $this->time = round(microtime(true) - $startTime, 2);
        $this->dispatch('article-created')->to(ArticlesTable::class);
    }

    public function render()
    {
        return view('livewire.import-form');
    }
}
