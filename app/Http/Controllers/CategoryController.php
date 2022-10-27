<?php

namespace App\Http\Controllers;

use App\Dtos\CategoryDto;
use App\Http\Requests\CategoryRequest;
use App\Services\TopCategoryService;
use Exception;

class CategoryController extends Controller
{
    public function index(CategoryRequest $request)
    {
        $dto = new CategoryDto();
        $dto->date = $request->get('date');

        try {
            $categories = new TopCategoryService;
            $result = $categories->evaluateAll($dto->date);
        } catch (Exception $e) {
            return response([
                'error'  => $e->getMessage(),
            ], 500);
        }
        return response([
            'status_code'   => 200,
            'message'  => 'ok',
            'data'          => $result
        ], 200);
    }
}
