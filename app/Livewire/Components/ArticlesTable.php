<?php

namespace App\Livewire\Components;

use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class ArticlesTable extends Component
{
    public Collection $articles;

    #[On('article-created')]
    public function updateArticlesList()
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
