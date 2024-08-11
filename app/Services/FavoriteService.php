<?php
// app/Services/FavoriteService.php

// app/Services/FavoriteService.php

namespace App\Services;

use App\Models\Favorite;
use App\Models\Product;

use Illuminate\Support\Facades\Auth;

class FavoriteService
{
    public function product_favorite($productId)
    {
        $userId = Auth::id();
        $favorite = Favorite::where('user_id', $userId)
            ->where('favoritable_id', $productId)
            ->where('favoritable_type', Product::class)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return ['status' => 'removed', 'favorite' => null];
        } else {
            $newFavorite = Favorite::create([
                'user_id' => $userId,
                'favoritable_id' => $productId,
                'favoritable_type' => Product::class,
            ]);
            return ['status' => 'added', 'favorite' => $newFavorite];
        }
    }

    public function getAllFavoriteProducts()
    {

        return Favorite::where('favoritable_type', Product::class)->get();
    }
}

