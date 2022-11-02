<?php

namespace App\Http\Controllers;

use App\Dtos\CategoryDto;
use App\Http\Requests\CategoryRequest;
use App\Services\TopCategoryService;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index(CategoryRequest $request): Response
    {
        $dto = new CategoryDto();
        $dto->date = $request->get('date');

        $categories = new TopCategoryService;
        $result = $categories->getTopCategories($dto->date);

        return response([
            'status_code'   => 200,
            'message'       => 'ok',
            'data'          => $result
        ], 200);
    }
}
