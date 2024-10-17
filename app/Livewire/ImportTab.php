<?php

namespace App\Livewire;

use App\Actions\SplitTextAction;
use App\Models\Article;
use App\Models\Word;
use App\Services\RuWikiService;
use App\Services\WikipediaImportService;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ImportTab extends Component
{
    public RuWikiService $service;
    public ?string $title;

    public $time;

    /*
     * exchars - how many characters to return
     * exsentences - how many sentences to return
     * exlimit - how many extracts to return
     */
    public function import()
    {

        // https://www.mediawiki.org/wiki/API:Get_the_contents_of_a_page/ru
        $endpoint = 'https://ru.wikipedia.org/w/api.php';
        // https://en.wikipedia.org/wiki/Special:ApiSandbox#action=query&format=json&prop=extracts&titles=Pet_door&formatversion=2&exchars=&exsentences=10&exlimit=1&explaintext=1&exsectionformat=plain
        $params = [
            'action' => 'query',
            'prop' => 'extracts|info',
            'inprop' => 'url',
            'explaintext' => true,
            'exsectionformat' => 'plain',
            'format' => 'json',
            'titles' => $this->title,
        ];
        $startTime = microtime(true);
        $response = Http::get($endpoint, $params)->json();
        $pageID = array_key_first($response['query']['pages']);

        // TODO
        if ($pageID === -1) {
            dd(123);
        }
        $page = $response['query']['pages'][$pageID];

        $title = $page['title'];
        $fullText = $page['extract'];

        if (!$fullText) {
            dd(123);
        }
        $pageURL = $page['fullurl'];
        $action = (new SplitTextAction())->handle($fullText);
        $count = $action[0];
        $article = Article::updateOrCreate(
            [
                'id' => $pageID
            ],
            [
                'title' => $title,
                'text' => $fullText,
                'url' => $pageURL,
                'count' => $count,
            ]);

        $words = $action[1];

        $arr = [];
        foreach ($words as $word => $count) {
            $id = Word::firstOrCreate(['word' => $word])->id;
            $arr[] = [
                'count' => $count,
                'word_id' => $id,
            ];
        }

        $article->words()->attach($arr);
        $this->time = round(microtime(true) - $startTime, 2);

        $this->dispatch('article-created')->to(ArticlesTable::class);
    }

    public function mount(RuWikiService $service)
    {
        $this->service = $service;
    }
    public function render()
    {
        return view('livewire.import-tab');
    }
}
