<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Word;

class WikiImportService
{
    private RuWikiService $ruWikiService;
    private EnWikiService $enWikiService;

    public function __construct()
    {
        $this->ruWikiService = new RuWikiService();
        $this->enWikiService = new EnWikiService();
    }

    public function import(string $query)
    {
        $data = null;
        try {
            $data = $this->ruWikiService->fetchResponse($query);
        } catch (\Exception $exception) {
            try {
                $this->enWikiService->fetchResponse($query);
            } catch (\Exception $ex2) {
                return 111;
            }
        }

        $split = $this->split($data['text']);

        $article = Article::updateOrCreate(
            [
                'id' => $data['id'],
            ],
            [
                'title' => $data['title'],
                'text' => $data['text'],
                'url' => $data['url'],
                'count' => $split['count'],
            ]);
//        dd($split);

        $result = [];
        foreach ($split['words'] as $word => $count) {
            $id = Word::firstOrCreate(['word' => $word])->id;
            $result[] = [
                'count' => $count,
                'word_id' => $id,
            ];
        }

        $article->words()->attach($result);

//        return $data;
    }

    private function split(string $text)
    {
        // убираем символы ударения в словах
        $text = preg_replace('/\x{0301}/u', '', $text);

        // убираем emdash, double quotes
        $text = preg_replace('/[\x{2014}\x{00AB}\x{00BB}]/u', '', $text);

        //разбиение текста на слова с учетом регулярного выражения
        $words = preg_split('/[\s=.,()\/\[\]\"\':;_\-]/', mb_strtolower($text), 0, PREG_SPLIT_NO_EMPTY);

        $count = count($words);

        return [
            'count' => $count,
            'words' => array_count_values($words)
        ];
    }
}
