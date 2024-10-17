<?php

namespace App\Livewire\Components;

use App\Models\Article;
use App\Services\WikiImportService;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ImportForm extends Component
{
    /**
     * Переменная для поиска статей
     * @var string|null
     */
    #[Validate('required', message: 'Введите название статьи для поиска')]
    public ?string $title;

    /**
     * Время выполнения запроса
     * @var float|null
     */
    public ?float $time;

    /**
     * Найденная статья
     * @var Article|null
     */
    public ?Article $article;

    /**
     * Метод для импорта статей в базу
     * @return void
     */
    public function import(): void
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
        return view('livewire.components.import-form');
    }
}
