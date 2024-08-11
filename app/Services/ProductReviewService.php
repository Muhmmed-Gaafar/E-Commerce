<?php

namespace App\Services;

use App\Models\ProductReview;

class ProductReviewService
{
    public function getAllReviews()
    {
        return ProductReview::all();
    }

    public function createReview($data)
    {
        return ProductReview::create($data);
    }

    public function getReviewById($id)
    {
        return ProductReview::where('id', $id)->first();
    }

    public function updateReview($data, $id)
    {
        $review = ProductReview::where('id', $id)->first();
        $review->update($data);
        return $review;
    }

    public function deleteReview($id)
    {
        $review = ProductReview::where('id', $id)->first();
        $review->delete();
        return $review;
    }

    public function getReviewsByProductId($request)
    {
        return ProductReview::where('product_id', $request->product_id)->get();
    }
}
