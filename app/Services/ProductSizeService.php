<?php

namespace App\Services;

use App\Models\ProductSize;

class ProductSizeService
{
    public function getAllProductSizes()
    {
        return ProductSize::all();
    }

    public function createProductSize( $request)
    {
        $data = $request->validated();
        return ProductSize::create($data);
    }

    public function getProductSizeById($id)
    {
        return ProductSize::where('id', $id)->first();
    }

    public function updateProductSize($id,  $request)
    {

        $data = $request->validated();
        $productSize = ProductSize::where('id', $id)->first();
        $productSize->update($data);
        return $productSize;
    }

    public function deleteProductSize($id)
    {
        $productSize = ProductSize::where('id', $id)->first();
        $productSize->delete();
    }
}

