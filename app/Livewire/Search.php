<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Word;
use Livewire\Component;

class Search extends Component
{
    public $search = '';
    public $list;
    public $text;

    public function foo()
    {
        $this->search = mb_strtolower($this->search);
        $this->list = Word::where('word', $this->search)->first()->articles;

        $this->text = $this->list[0]->text;
    }

    public function showText($id)
    {
//        $this->dispatch('show-text')->to(Content::class);
//        $this->text = Article::find($id)->text;
        $this->search = $id;
    }
    public function render()
    {
        return view('livewire.search');
    }
}
