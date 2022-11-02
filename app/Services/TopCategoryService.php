<?php

namespace App\Services;


use App\Models\RawCategory;

class TopCategoryService
{
    public function getTopCategories(string $date): array
    {
        return RawCategory::where('date', $date)
            ->orderBy('position', 'DESC')
            ->pluck('position', 'category')
            ->toArray();
    }
}
