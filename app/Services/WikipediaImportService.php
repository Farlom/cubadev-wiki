<?php

namespace App\Services;

// https://www.mediawiki.org/wiki/API:Get_the_contents_of_a_page/ru
// https://en.wikipedia.org/wiki/Special:ApiSandbox#action=query&format=json&prop=extracts&titles=Pet_door&formatversion=2&exchars=&exsentences=10&exlimit=1&explaintext=1&exsectionformat=plain

use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 *
 */
class WikipediaImportService
{
    /**
     * @var string
     */
    private string $endpoint = 'https://ru.wikipedia.org/w/api.php';

    /**
     * @var array
     */
    public array $params = [
        'action' => 'query',
        'prop' => 'extracts|info',
        'inprop' => 'url',
        'explaintext' => true,
        'exsectionformat' => 'plain',
        'format' => 'json',
    ];


    /**
     * @param string $query
     * @return \Illuminate\Http\Client\Response
     * @throws BadRequestException
     */
    public function getResponse(?string $query)
    {
        $this->params['titles'] = $query;
        $response = Http::get($this->endpoint, $this->params);

        if ($response->successful()) {
            return $response;
        }

        throw new BadRequestHttpException();
    }




}
