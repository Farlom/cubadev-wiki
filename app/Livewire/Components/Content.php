<?php

namespace App\Livewire\Components;

use App\Models\Article;
use Livewire\Attributes\On;
use Livewire\Component;

class Content extends Component
{
    /**
     * Текст выбранной статьи
     * @var string|null
     */
    public ?string $text = null;

    /**
     * Метод для получения текста выбранной статьи
     * @param $id
     * @return void
     */
    #[On('show-text')]
    public function showText($id): void
    {
        $this->text = Article::find($id)->text;
    }


    /**
     * Сброс данных компонента
     * @return void
     */
    #[On('reset-component')]
    public function resetComponent(): void
    {
        $this->text = null;
    }

    public function render()
    {
        return view('livewire.components.content');
    }
}
