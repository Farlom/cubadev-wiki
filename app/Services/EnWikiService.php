<?php

namespace App\Services;

use App\Interfaces\ExternalApiInterface;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 *  Cервис для работы с API en.wiki
 */
class EnWikiService implements ExternalApiInterface
{
    /**
     * @var string URL API сервиса
     */
    private string $endpoint = 'https://en.wikipedia.org/w/api.php';

    /**
     * @var array Параметры запроса
     */
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

    /**
     * @param string $query
     * @return array
     * @throws \Exception
     */
    public function fetchResponse(string $query): array
    {
        $response = $this->getResponse($query)->json();

        $pageID = array_key_first($response['query']['pages']);

        if ($pageID === -1) {
            throw new \Exception('Не удалось найти статью на en.wikipedia.org');
        }

        $page = $response['query']['pages'][$pageID];

        $title = $page['title'];
        $fullText = $page['extract'];

        if (!$fullText) {
            throw new \Exception('На en.wikipedia.org статья не имеет содержания');
        }
        $pageURL = $page['fullurl'];

        return [
            'id' => $pageID,
            'title' => $title,
            'text' => $fullText,
            'url' => $pageURL,
        ];
    }


}
