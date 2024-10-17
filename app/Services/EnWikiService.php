<?php

namespace App\Services;

use App\Interfaces\ExternalApiInterface;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class EnWikiService implements ExternalApiInterface
{
    private string $endpoint = 'https://en.wikipedia.org/w/api.php';

    private array $params = [
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
    public function getResponse(string $query): \Illuminate\Http\Client\Response
    {
        $this->params['titles'] = $query;

        $response = Http::get($this->endpoint, $this->params);

        if ($response->successful()) {
            return $response;
        }

        throw new BadRequestHttpException();
    }

    public function fetchResponse(string $query)
    {
        $response = $this->getResponse($query)->json();

        $pageID = array_key_first($response['query']['pages']);

        // TODO
        if ($pageID === -1) {
            throw new \Exception('Статья не найдена');
        }

        $page = $response['query']['pages'][$pageID];

        $title = $page['title'];
        $fullText = $page['extract'];

        if (!$fullText) {
            throw new \Exception('Статья не имеет содержания');
        }
        $pageURL = $page['fullurl'];

        return [
            'id' => $pageID,
            'title' => $title,
            'text' => $fullText,
            'url' => $pageURL,
        ];
        return $response;
    }


}
