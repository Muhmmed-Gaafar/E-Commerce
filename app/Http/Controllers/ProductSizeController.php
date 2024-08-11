<?php

namespace App\Http\Controllers;

use App\Services\ProductSizeService;
use App\Http\Requests\ProductSizeRequest;
use App\Http\Resources\ProductSizeResource;
use App\Trait\Response;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    use Response;

    protected $productSizeService;

    public function __construct(ProductSizeService $productSizeService)
    {
        $this->productSizeService = $productSizeService;
    }

    public function index()
    {
        $productSizes = $this->productSizeService->getAllProductSizes();
        return $this->success(ProductSizeResource::collection($productSizes), 'Product sizes retrieved successfully', 200);
    }

    public function store(ProductSizeRequest $request)
    {

        $productSize = $this->productSizeService->createProductSize($request);
        return $this->success(new ProductSizeResource($productSize), 'Product size created successfully', 201);
    }

    public function show($id)
    {
        try {
            $productSize = $this->productSizeService->getProductSizeById($id);
            return $this->success(new ProductSizeResource($productSize), 'Product size retrieved successfully', 200);
        } catch (\Exception $e) {
            return $this->failed(null, 'Product size not found', 404);
        }
    }

    public function update(ProductSizeRequest $request, $id)
    {
            $productSize = $this->productSizeService->updateProductSize($id, $request);
            return $this->success(new ProductSizeResource($productSize), 'Product size updated successfully', 200);

    }

    public function destroy($id)
    {
        try {
            $this->productSizeService->deleteProductSize($id);
            return $this->msg('Product size deleted successfully', 204);
        } catch (\Exception $e) {
            return $this->failed(null, 'Failed to delete product size', 400);
        }
    }
}

