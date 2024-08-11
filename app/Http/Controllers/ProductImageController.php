<?php



namespace App\Http\Controllers;

use App\Http\Requests\ProductImageRequest;
use App\Http\Resources\ProductImageResource;
use App\Services\ProductImageService;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    protected $productImageService;

    public function __construct(ProductImageService $productImageService)
    {
        $this->productImageService = $productImageService;
    }

    public function index()
    {
        $productImages = $this->productImageService->getAllProductImages();
        return response()->json(ProductImageResource::collection($productImages));
    }

    public function store(ProductImageRequest $request)
    {
        $data = $request->validated();
        $productImage = $this->productImageService->createProductImage($data);
        return response()->json(new ProductImageResource($productImage), 201);
    }

    public function show($id)
    {
        $productImage = $this->productImageService->getProductImageById($id);
        return response()->json(new ProductImageResource($productImage));
    }

    public function update(ProductImageRequest $request, $id)
    {
        $data = $request->validated();
        $productImage = $this->productImageService->updateProductImage($id, $data);
        return response()->json(new ProductImageResource($productImage));
    }

    public function destroy($id)
    {
        $this->productImageService->deleteProductImage($id);
        return response()->json(null, 204);
    }
}

