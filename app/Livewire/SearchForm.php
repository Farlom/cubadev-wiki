<?php

namespace App\Livewire;

use App\Models\Word;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SearchForm extends Component
{
    #[Validate('required', message: 'Введите слово для поиска')]
    public ?string $query = '';

    public function search()
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
        return view('livewire.search-form');
    }
}
