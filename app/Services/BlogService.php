<?php
namespace App\Services;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogService
{
    public function createBlog(Request $request)
    {
        $data = $request->validated();
        $data['image'] = upload_image('public/BlogImages' ,$data['image']);
        return Blog::create($data);
    }

    public function updateBlog(Blog $blog, Request $request)
    {
        $data = $request->validated();
        if ($request->file('image')) {
            if ($blog->image) {
                \Storage::delete($blog->image);
            }
            $data['image'] = upload_image('public/BlogImages' ,$data['image']);
        }
        $blog->update($data);
        return $blog;
    }
}
