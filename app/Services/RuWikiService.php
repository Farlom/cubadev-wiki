<?php

namespace App\Services;

use App\Interfaces\ExternalApiInterface;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class RuWikiService implements ExternalApiInterface
{
    private string $endpoint = 'https://ru.wikipedia.org/w/api.php';

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

    public function fetchResponse(\Illuminate\Http\Client\Response $response)
    {

    }
}
