<?php

namespace App\Http\Controllers;

use App\Services\ProductTypeService;
use App\Http\Requests\ProductTypeRequest;
use App\Http\Resources\ProductTypeResource;
use Illuminate\Http\Request;
use App\Trait\Response;

class ProductTypeController extends Controller
{
    use Response; // Use the Response trait

    protected $productTypeService;

    public function __construct(ProductTypeService $productTypeService)
    {
        $this->productTypeService = $productTypeService;
    }

    public function index()
    {
        $productTypes = $this->productTypeService->getAllProductTypes();
        return $this->success(ProductTypeResource::collection($productTypes), 'Product types retrieved successfully', 200);
    }

    public function store(ProductTypeRequest $request)
    {

        $productType = $this->productTypeService->createProductType($request);
        return $this->success(new ProductTypeResource($productType), 'Product type created successfully', 201);
    }

    public function show($id)
    {
        try {
            $productType = $this->productTypeService->getProductTypeById($id);
            return $this->success(new ProductTypeResource($productType), 'Product type retrieved successfully', 200);
        } catch (\Exception $e) {
            return $this->failed(null, 'Product type not found', 404);
        }
    }

    public function update(ProductTypeRequest $request, $id)
    {
            $productType = $this->productTypeService->updateProductType($id, $request);
            return $this->success(new ProductTypeResource($productType), 'Product type updated successfully', 200);

    }

    public function destroy($id)
    {
        try {
            $this->productTypeService->deleteProductType($id);
            return $this->msg('Product type deleted successfully', 204);
        } catch (\Exception $e) {
            return $this->failed(null, 'Failed to delete product type', 400);
        }
    }
}



