<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    use ApiResponser;
    public function get(Category $category): JsonResponse
    {
        return $this->successResponse($category->toArray());
    }

    public function index(): JsonResponse
    {
        return $this->successResponse(Category::all()->toArray());
    }
}
