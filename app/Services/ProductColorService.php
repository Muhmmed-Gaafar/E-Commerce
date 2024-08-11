<?php

namespace App\Services;

use App\Models\ProductColor;

class ProductColorService
{
    public function getAllProductColors()
    {
        return ProductColor::all();
    }

    public function createProductColor( $data)
    {

        $product_color = ProductColor::create($data);
        return $product_color;
    }

    public function getProductColorById($id)
    {
        return ProductColor::where('id', $id)->first();
    }

    public function updateProductColor($id,  $data)
    {
        $productColor = ProductColor::where('id', $id)->first();
        $productColor->update($data);
        return $productColor;
    }

    public function deleteProductColor($id)
    {
        $productColor = ProductColor::where('id', $id)->first();
        $productColor->delete();
    }
}

