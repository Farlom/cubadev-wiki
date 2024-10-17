<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\On;
use Livewire\Component;

class Content extends Component
{
    public ?string $text = null;

    #[On('show-text')]
    public function showText($id)
    {
        $this->text = Article::find($id)->text;
    }


    #[On('reset-component')]
    public function resetComponent()
    {
        $this->text = null;
    }

    public function render()
    {
        return view('livewire.content');
    }
}
