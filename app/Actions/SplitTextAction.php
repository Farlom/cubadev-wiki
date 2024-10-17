<?php

namespace App\Actions;

final class SplitTextAction
{
    public function handle(string $text)
    {
        // убираем символы ударения в словах
        $text = preg_replace('/\x{0301}/u', '', $text);

        // убираем emdash, double quotes
        $text = preg_replace('/[\x{2014}\x{00AB}\x{00BB}]/u', '', $text);

        //разбиение текста на слова с учетом регулярного выражения
        $words = preg_split('/[\s=.,()\/\[\]\"\':;_\-]/', mb_strtolower($text), 0, PREG_SPLIT_NO_EMPTY);

        $count = count($words);
        return [$count, array_count_values($words)];
        // список уникальных слов
//        $words = array_unique($text);
//        dd(array_count_values($words));
        $tmp = 0;
        foreach (array_count_values($words) as $word => $count) {
            $tmp += $count;
        }

        return
        dd($tmp);
    }
}
