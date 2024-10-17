<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Word;

class WikiImportService
{
    /**
     * @var RuWikiService
     */
    private RuWikiService $ruWikiService;

    /**
     * @var EnWikiService
     */
    private EnWikiService $enWikiService;

    public function __construct()
    {
        $this->ruWikiService = new RuWikiService();
        $this->enWikiService = new EnWikiService();
    }

    /**
     * Импорт полученных данных в базу
     * @param string $query
     * @return array
     */
    public function import(string $query): array
    {
        $errors = [];
        try {
            $data = $this->ruWikiService->fetchResponse($query);
        } catch (\Exception $ex) {
            $errors[] = $ex->getMessage();
            try {
                $data = $this->enWikiService->fetchResponse($query);
            } catch (\Exception $ex2) {
                $errors[] = $ex2->getMessage();
                return [
                    'errors' => $errors,
                    'article' => null,
                ];
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

        $result = [];
        foreach ($split['words'] as $word => $count) {
            $id = Word::firstOrCreate(['word' => $word])->id;
            $result[] = [
                'count' => $count,
                'word_id' => $id,
            ];
        }

        $article->words()->attach($result);

        return [
            'errors' => $errors,
            'article' => $article
        ];
    }

    /**
     * Разбиение текста на уникальные слова
     * @param string $text
     * @return array
     */
    private function split(string $text): array
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
