<?php

namespace App\Http\Controllers;
use App\Http\Requests\ChangeFavoriteProductRequest;
use App\Http\Requests\GetProductByCategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductShowResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Trait\Response;

class ProductController extends Controller
{
    use Response;

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $products = $this->productService->getAllProducts($perPage, $search);

        return $this->success(
            ProductShowResource::collection($products),
            'Products retrieved successfully',
            200
        );
    }

    public function store(ProductRequest $request)
    {
        $product = $this->productService->createProduct($request);
        return $this->success(new ProductResource($product), 'Product created successfully', 201);
    }

    public function show($id)
    {
        $product = Product::with(['colors', 'types', 'sizes'])->where('id', $id)->first();
        return $this->success(new ProductShowResource($product), 'Product retrieved successfully', 200);
    }

    public function update(ProductRequest $request, $id)
    {
            $product = $this->productService->updateProduct($id, $request);
            return $this->success(new ProductShowResource($product), 'Product updated successfully', 200);
    }

    public function destroy($id)
    {
            $this->productService->deleteProduct($id);
            return $this->msg('Product deleted successfully', 204);
    }

    public function getProductsByCategory(GetProductByCategoryRequest $request)
    {
        $products = $this->productService->getProductsByCategoryId($request);
        return response()->json(['products' => $products]);
    }




}
