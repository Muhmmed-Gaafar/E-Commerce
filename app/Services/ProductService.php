<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductReview;
use App\Models\ProductSize;
use App\Models\ProductType;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function getAllProducts($perPage = 10 ,$search = null)
    {
        $query = Product::query()->with('category');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        return $query->orderBy('id','desc')->get();
    }

    public function createProduct( $request)
    {

        $data = $request->validated();
        if (isset($data['price']) && isset($data['tax'])) {
            $data['price_after_tax'] = $data['price'] + $data['tax'];
        }
        $data['image'] = upload_image('public/ProductImages' ,$data['image']);
        $product = Product::create($data);


        if (isset($data['colors'])) {
            foreach ($data['colors'] as $color) {
                ProductColor::create([
                    'color' => $color,
                    'product_id' => $product->id
                ]);
            }
        }
        if (isset($data['sizes'])) {
            foreach ($data['sizes'] as $size) {
                ProductSize::create([
                    'size' => $size,
                    'product_id' => $product->id
                ]);
            }
        }
        if (isset($data['types'])) {
            foreach ($data['types'] as $type) {
                ProductType::create([
                    'type' => $type,
                    'product_id' => $product->id
                ]);
            }
        }
        if (isset($data['images'])) {
            foreach ($data['images'] as $image) {

                    ProductImage::create([
                        'image' => $image,
                        'product_id' => $product->id
                    ]);

            }
        }
        if (isset($data['reviews'])) {
            foreach ($data['reviews'] as $review) {
                ProductReview::create([
                    'name' => $review['name'],
                    'rate' => $review['rate'],
                    'comment' => $review['comment'],
                    'product_id' => $product->id
                ]);
            }
        }
        return $product;
    }


    public function getProductById($id): Product
    {
        return Product::where('id', $id)->first();
    }

    public function updateProduct($id, Request $request): Product
    {
        $data = $request->validated();
        $product = Product::findOrFail($id);

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            if ($product->image) {
                Storage::delete(str_replace('/storage', 'public', $product->image));
            }
            $data['image'] = upload_image($data['image'], 'public/ProductImages');
        }

        if (isset($data['colors'])) {
            $product->colors()->delete();
            foreach ($data['colors'] as $color) {
                ProductColor::create([
                    'color' => $color,
                    'product_id' => $product->id,
                ]);
            }
        }

        if (isset($data['sizes'])) {
            $product->sizes()->delete();
            foreach ($data['sizes'] as $size) {
                ProductSize::create([
                    'size' => $size,
                    'product_id' => $product->id,
                ]);
            }
        }

        if (isset($data['types'])) {
            $product->types()->delete();
            foreach ($data['types'] as $type) {
                ProductType::create([
                    'type' => $type,
                    'product_id' => $product->id,
                ]);
            }
        }

        if (isset($data['images'])) {
            $product->images()->delete();
            foreach ($data['images'] as $image) {
                ProductImage::create([
                    'image' => $image,
                    'product_id' => $product->id,
                ]);
            }
        }

        if (isset($data['reviews'])) {
            $product->reviews()->delete();
            foreach ($data['reviews'] as $review) {
                ProductReview::create([
                    'name' => $review['name'],
                    'rate' => $review['rate'],
                    'comment' => $review['comment'],
                    'product_id' => $product->id,
                ]);
            }
        }

        $product->update($data);

        return $product;
    }
    public function deleteProduct($id)
    {
        $product = Product::where('id', $id)->first();
        if(isset($product->image)){
            Storage::delete($product->image);
        }
        $product->delete();
    }

    public function getProductsByCategoryId($request)
    {
        return Product::where('category_id', $request->category_id)->get();
    }

}

