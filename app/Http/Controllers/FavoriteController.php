<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoriteRequest;
use App\Http\Resources\UserFavoriteProductResource;
use App\Services\FavoriteService;
use Illuminate\Support\Facades\Auth;
use App\Trait\Response;

class FavoriteController extends Controller
{
    use Response; // Use the Response trait

    protected $favoriteService;

    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    public function product_favorite(FavoriteRequest $request)
    {
        $result = $this->favoriteService->product_favorite($request->product_id);

        if ($result['status'] === 'added') {
            return $this->success(new UserFavoriteProductResource($result['favorite']), 'Product added to favorites');
        } else {
            return $this->success([], 'Product removed from favorite', 200);
        }
    }

    public function getAllFavoriteProducts()
    {
        $favorites = $this->favoriteService->getAllFavoriteProducts();
        return $this->success(UserFavoriteProductResource::collection($favorites), 'Favorite products retrieved successfully');
    }
}




