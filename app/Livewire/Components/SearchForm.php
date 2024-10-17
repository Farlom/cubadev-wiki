<?php

namespace App\Livewire\Components;

use App\Models\Word;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SearchForm extends Component
{
    /**
     * @var string|null Переменная для поиска существующих слов
     */
    #[Validate('required', message: 'Введите слово для поиска')]
    public ?string $query = '';

    /**
     * Метод статей, содержащих слово
     * @return void
     */
    public function search(): void
    {
        $this->dispatch('reset-component')->to(Results::class);
        $this->validate();

        $this->query = mb_strtolower($this->query);
        $word = Word::where('word', $this->query)->first();

        if ($word) {
            $this->dispatch('read-word', $word->id)->to(Results::class);
            return;
        }
        $this->dispatch('read-word', null)->to(Results::class);
    }

    public function render()
    {
        return view('livewire.components.search-form');
    }
}
