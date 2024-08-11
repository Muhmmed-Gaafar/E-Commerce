<?php

namespace App\Http\Controllers;

use App\Services\ProductColorService;
use App\Http\Requests\ProductColorRequest;
use App\Http\Resources\ProductColorResource;
use Illuminate\Http\Request;
use App\Trait\Response;

class ProductColorController extends Controller
{
    use Response;
    protected $productColorService;


    public function __construct(ProductColorService $productColorService)
    {
        $this->productColorService = $productColorService;
    }

    public function index()
    {
        $productColors = $this->productColorService->getAllProductColors();
        $response = new ProductColorResource($productColors);
        $msg= 'Product colors retrieved successfully';
        return $this->success($response, $msg, 200);
    }

    public function store(ProductColorRequest $request)
    {
        $data = $request->validated();
        $productColor = $this->productColorService->createProductColor($data);
        return $this->success(new ProductColorResource($productColor), 'Product color created successfully', 201);
    }

    public function show($id)
    {
        try {
            $productColor = $this->productColorService->getProductColorById($id);
            return $this->success(new ProductColorResource($productColor), 'Product color retrieved successfully', 200);
        } catch (\Exception $e) {
            return $this->failed(null, 'Product color not found', 404);
        }
    }

    public function update(ProductColorRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $productColor = $this->productColorService->updateProductColor($id, $data);
            return $this->success(new ProductColorResource($productColor), 'Product color updated successfully', 200);
        } catch (\Exception $e) {
            return $this->failed(null, 'Failed to update product color', 400);
        }
    }

    public function destroy($id)
    {
        try {
            $this->productColorService->deleteProductColor($id);
            return $this->msg('Product color deleted successfully', 204);
        } catch (\Exception $e) {
            return $this->failed(null, 'Failed to delete product color', 400);
        }
    }
}

