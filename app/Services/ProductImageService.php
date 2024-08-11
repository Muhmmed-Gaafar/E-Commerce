<?php



namespace App\Services;

use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductImageService
{
    public function getAllProductImages()
    {
        return ProductImage::all();
    }

    public function createProductImage( $data)
    {
        $product_image = ProductImage::create($data);
        $data['image'] = upload_image('public/ProductBranchImages' ,$data['image']);
        return ProductImage::create($data);
    }

    public function getProductImageById($id)
    {
        return ProductImage::where('id', $id)->first();
    }

    public function updateProductImage($id,  $data)
    {
        $productImage = ProductImage::where('id', $id)->first();
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            if ($productImage->image) {
                Storage::delete(str_replace('/storage', 'public', $productImage->image));
            }
            $data['image'] = upload_image($data['image'], 'public/ProductBranchImages');
        }
        $productImage->update($data);
        return $productImage;
    }

    public function deleteProductImage($id)
    {
        $productImage = ProductImage::where('id', $id)->first();
        if(isset($productImage->image)){
            Storage::delete($productImage->image);
        }
        $productImage->delete();
    }
}
