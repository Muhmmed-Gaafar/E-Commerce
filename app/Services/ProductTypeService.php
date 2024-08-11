<?php

namespace App\Services;

use App\Models\ProductType;
use Illuminate\Database\Eloquent\Collection;

class ProductTypeService
{
    /**
     * Get all product types.
     *
     * @return Collection
     */
    public function getAllProductTypes(): Collection
    {
        return ProductType::all();
    }

    /**
     * Create a new product type.
     *
     * @param array $data
     * @return ProductType
     */
    public function createProductType( $request)
    {
        $data = $request->validated();
        return ProductType::create($data);
    }

    /**
     * Get a specific product type by ID.
     *
     * @param int $id
     * @return ProductType
     */
    public function getProductTypeById( $id)
    {
        return ProductType::where('id', $id)->first();
    }

    /**
     * Update a specific product type.
     *
     * @param int $id
     * @param array $data
     * @return ProductType
     */
    public function updateProductType( $id , $request)
    {
        $data = $request->validated();
        $productType = ProductType::where('id', $id)->first();
        $productType->update($data);
        return $productType;
    }

    /**
     * Delete a specific product type.
     *
     * @param int $id
     * @return void
     */
    public function deleteProductType( $id)
    {
        $productType = ProductType::where('id', $id)->first();
        $productType->delete();
    }
}

