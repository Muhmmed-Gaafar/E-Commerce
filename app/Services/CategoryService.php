<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Nette\Utils\Image;

class CategoryService
{
        public function getAllCategories()
        {
                 return Category::all();
        }

        public function createCategory( $request)
        {
            $data=  $request->validated();
                $data['image'] = upload_image('public/CategoryImages', $data['image']);
            return Category::create($data);
        }

        public function getCategoryById($id)
        {
            return  Category::where('id', $id)->first();
        }

        public function updateCategory($id,  $data)
        {
            $category = Category::where('id', $id)->first();
            if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
                if ($category->image) {
                    Storage::delete(str_replace('/storage', 'public', $category->image));
                }
                $data['image'] = upload_image($data['image'], 'public/CategoryImages');
            }
            $category->update($data);
            return $category;
        }


        public function deleteCategory($id)
        {
            $category = Category::where('id', $id)->first();
            if(isset($category->image)){
                Storage::delete($category->image);
            }
            $category->delete();
        }

}


