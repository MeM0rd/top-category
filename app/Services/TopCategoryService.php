<?php

namespace App\Services;

use App\Models\Category;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

class TopCategoryService
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


    public function evaluateAll(string $date): array
    {
        try {
            $categories = $this->getCategories();
            return $this->parseCategories($categories, $date);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @throws JsonException | GuzzleException
     */
    private function getCategories()
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

    private function parseCategories(array $categories, string $date): array
    {
        $result = [];

        foreach ($categories as $category => $subCategory) {
            $minPositionsByDate = [];

            foreach ($subCategory as $item) {
                $posByDate = array_filter($item, function ($val, $key) use ($date) {
                    return $key === $date;
                }, ARRAY_FILTER_USE_BOTH);

                if (count($posByDate)) {
                    $minPositionsByDate[] = min($posByDate);
                }
            }
            if (count($minPositionsByDate)) {
                $result[$category] = min($minPositionsByDate);
            }
        }
        $this->saveTopCategories($result, $date);

        return $result;
    }

    private function saveTopCategories(array $topCategories, string $date): void
    {
        foreach ($topCategories as $categoryId => $position) {
            $model = new Category();

            $isExist = Category::where('category_id', $categoryId)
                ->where('date', $date)
                ->where('position', $position)
                ->exists();

            if (!$isExist) {
                $model->category_id = $categoryId;
                $model->date = $date;
                $model->position = $position;

                $model->save();
            }
        }
    }
}
