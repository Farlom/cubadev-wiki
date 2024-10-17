<?php

namespace App\Livewire\Components;

use App\Models\Word;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Results extends Component
{
    /**
     * @var Word|null Найденное слово
     */
    #[Validate('required', message: 'Статьи, содержащие данное слово, не найдены')]
    public ?Word $word = null;

    /**
     * Вывод списка статей, содержащих слово
     * @param int|null $id Идентификатор найденного слова
     * @return void
     */
    #[On('read-word')]
    public function setWord(?int $id): void
    {
        $this->dispatch('reset-component', $id)->to(Content::class);
        $this->resetValidation();
        $this->word = null;
        if ($id)
        {
            $this->word = Word::find($id);
            return;
        }
        $this->validate();
    }

    /**
     * Сброс данных компонента
     * @return void
     */
    #[On('reset-component')]
    public function resetComponent(): void
    {
        $this->word = null;
        $this->dispatch('reset-component')->to(Content::class);
    }

    /**
     * Триггер события на чтение текста
     * @param int $id Идентификатор статьи, содержащей слово
     * @return void
     */
    public function showText(int $id): void
    {
        $this->dispatch('show-text', $id)->to(Content::class);
    }

    public function render()
    {
        return view('livewire.components.results');
    }
}
