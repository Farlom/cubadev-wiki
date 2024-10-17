<?php

namespace App\Interfaces;

/**
 * Интерфейс для работы с внешним API
 */
interface ExternalApiInterface
{
    /**
     * Метод для получения ответа от внешнего API
     *
     * @param string $query Тело запроса
     * @return \Illuminate\Http\Client\Response
     */
    public function getResponse(string $query): \Illuminate\Http\Client\Response;

    /**
     * @param string $query Тело запроса
     */
    public function fetchResponse(string $query);
}
