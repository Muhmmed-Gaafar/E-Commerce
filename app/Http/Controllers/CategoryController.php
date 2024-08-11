<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Trait\Response;

class CategoryController extends Controller
{
    use Response;

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return $this->success(CategoryResource::collection($categories), 'Categories retrieved successfully', 200);
    }

    public function store(CategoryRequest $request)
    {
        try{
            $category = $this->categoryService->createCategory($request);
            return $this->success(new CategoryResource($category), 'Category created successfully', 201);
        }catch (\Exception $e){
            return $this->failed(null, 'Category not found', 404);

        }

    }

    public function show($id)
    {
        try {
            $category = $this->categoryService->getCategoryById($id);
            return $this->success(new CategoryResource($category), 'Category retrieved successfully', 200);
        } catch (\Exception $e) {
            return $this->failed(null, 'Category not found', 404);
        }
    }

    public function update(CategoryRequest $request, $id)
    {
            $category = $this->categoryService->updateCategory($id, $request->validated());
            return $this->success(new CategoryResource($category), 'Category updated successfully', 200);
    }

    public function destroy($id)
    {
        try {
            $this->categoryService->deleteCategory($id);
            return $this->success(null, 'Category deleted successfully', 200);
        } catch (\Exception $e) {
            return $this->failed(null, 'Category deletion failed', 400);
        }
    }


}




