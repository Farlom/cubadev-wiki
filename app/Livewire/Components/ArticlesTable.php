<?php

namespace App\Livewire\Components;

use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class ArticlesTable extends Component
{
    /**
     * Список существующих статей
     * @var Collection|null
     */
    public ?Collection $articles;

    /**
     * Обработка события добавления новой статьи в базу
     * @return void
     */
    #[On('article-created')]
    public function updateArticlesList(): void
    {
        $this->articles = Article::orderBy('created_at')->get();
    }

    public function mount()
    {
        $this->articles = Article::orderBy('created_at')->get();
    }

    public function render()
    {
        return view('livewire.components.articles-table');
    }
}
