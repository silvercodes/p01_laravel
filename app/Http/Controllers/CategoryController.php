<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\PatchCategoryRequest;
use App\Models\Category;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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
        $category = Category::create($request->validated());

        return $this->successResponse(
            // ['id' => $category->id],
            $category->toArray(),
            null,
            Response::HTTP_CREATED
        );
    }

    public function patch(Category $category, PatchCategoryRequest $request)
    {
        $category->update($request->validated());

        return $this->successResponse(
            [],
            null,
            Response::HTTP_NO_CONTENT
        );
    }

    public function delete(Category $category)
    {
        $category->delete();

        return $this->successResponse(
            [],
            null,
            Response::HTTP_NO_CONTENT
        );
    }
}
