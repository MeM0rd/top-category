<?php

namespace App\Services;

use App\Models\Category;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

class RequestCategoriesService
{
    private const DATE_FROM = '2022-10-24';
    private const DATE_TO = '2022-10-25';
    private const UNDEFINED = 'fVN5Q9KVOlOHDx9mOsKPAQsFBlEhBOwguLkNEDTZvKzJzT3l';

    private const APPLICATION_ID = '1421444';
    private const COUNTRY_ID = '1';

    private Client $client;

    public function __construct()
    {
        $this->client = $this->getHttpClient();
    }

    /**
     * @throws JsonException | GuzzleException
     */
    public function getCategories()
    {
        $response = $this->client->request(
            'GET',
            self::APPLICATION_ID . '/' . self::COUNTRY_ID,
            [
                'query' => [
                    'date_from' => self::DATE_FROM,
                    'date_to' => self::DATE_TO,
                    'B4NKGg' => self::UNDEFINED,
                ],
            ]);

        $result = json_decode($response->getBody(), true, 5, JSON_THROW_ON_ERROR);

        return $result['data'];
    }

    private function getHttpClient(): Client
    {
        return new Client([
            'base_uri' => config('app.base_uri'),
            'timeout' => 10.0,
        ]);
    }
}
