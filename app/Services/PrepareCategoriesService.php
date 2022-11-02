<?php

namespace App\Services;

use App\Models\RawCategory;

class PrepareCategoriesService
{
    public function prepareData(array $categories): void
    {
        foreach ($categories as $category => $subCategories ) {
            foreach ($subCategories as $subCategory => $items) {
                foreach ($items as $date => $position) {
                    $this->saveData($category, $subCategory, $date, $position);
                }
            }
        }
    }

    private function saveData(
        int $category,
        int $subCategory,
        string $date,
        int $position
    ) {
        RawCategory::updateOrCreate(
            ['category' => $category, 'sub_category' => $subCategory, 'date' => $date],
            ['position' => $position]
        );
    }
}
