<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Word;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Ramsey\Collection\Collection;

class Results extends Component
{
    #[Validate('required', message: 'Статьи, содержащие данное слово, не найдены')]
    public ?Word $word = null;

    #[On('read-word')]
    public function setWord(?int $id)
    {
        $this->dispatch('hide-text', $id)->to(Content::class);
        $this->resetValidation();
        $this->word = null;
        if ($id)
        {
            $this->word = Word::find($id);
            return;
        }
        $this->validate();
    }

    public function showText(int $id)
    {
        $this->dispatch('show-text', $id)->to(Content::class);
    }

    public function render()
    {
        return view('livewire.results');
    }
}
