<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Models\Category;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use \Illuminate\Http\Request;

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

    public function create(CreateCategoryRequest $request)
    {
        dd($request);
    }
}
