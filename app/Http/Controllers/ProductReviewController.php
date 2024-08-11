<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductReviewRequest;
use App\Http\Requests\ProductReviewsByProductIdRequest;
use App\Http\Resources\ProductReviewResource;
use App\Models\ProductReview;
use App\Services\ProductReviewService;
use App\Trait\Response;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    use Response;

    protected $productReviewService;

    public function __construct(ProductReviewService $productReviewService)
    {
        $this->productReviewService = $productReviewService;
    }

    public function index()
    {
        $reviews = $this->productReviewService->getAllReviews();
        return $this->success(ProductReviewResource::collection($reviews), 'Reviews retrieved successfully');
    }

    public function store(ProductReviewRequest $request)
    {
        $review = $this->productReviewService->createReview($request->validated());
        return $this->success(new ProductReviewResource($review), 'Review created successfully', 201);
    }

    public function show($id)
    {
        $review = $this->productReviewService->getReviewById($id);
        if (!$review) {
            return $this->failed(null, 'Review not found', 404);
        }
        return $this->success(new ProductReviewResource($review), 'Review retrieved successfully');
    }

    public function update(ProductReviewRequest $request, $id)
    {
        $review = $this->productReviewService->getReviewById($id);
        if (!$review) {
            return $this->failed(null, 'Review not found', 404);
        }
        $updatedReview = $this->productReviewService->updateReview($request->validated(), $id);
        return $this->success(new ProductReviewResource($updatedReview), 'Review updated successfully');
    }

    public function destroy($id)
    {
        $review = $this->productReviewService->getReviewById($id);
        if (!$review) {
            return $this->failed(null, 'Review not found', 404);
        }
        $this->productReviewService->deleteReview($id);
        return $this->msg('Review deleted successfully', 204);
    }

    public function getReviewsByProductId(ProductReviewsByProductIdRequest $request)
    {
        $reviews = $this->productReviewService->getReviewsByProductId($request);
        return response()->json($reviews);
    }
}


