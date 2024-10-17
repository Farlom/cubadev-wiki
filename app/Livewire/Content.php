<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Content extends Component
{
    public $text;
    #[On('show-text')]
    public function setText()
    {
        dd(123);
    }
    public function render()
    {
        return view('livewire.content');
    }
}
