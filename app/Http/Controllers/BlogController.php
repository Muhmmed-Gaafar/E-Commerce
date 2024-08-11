<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Services\BlogService;
use App\Trait\Response;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use Response; // Include the Response trait

    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index()
    {
        $blogs = Blog::all();
        return $this->success(BlogResource::collection($blogs), 'Blogs retrieved successfully');
    }

    public function store(BlogRequest $request)
    {
        $blog = $this->blogService->createBlog($request);
        return $this->success(new BlogResource($blog), 'Blog created successfully');
    }

    public function show(Blog $blog)
    {
        return $this->success(new BlogResource($blog), 'Blog retrieved successfully');
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        $blog = $this->blogService->updateBlog($blog, $request);
        return $this->success(new BlogResource($blog), 'Blog updated successfully');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return $this->msg('Blog deleted successfully', 204);
    }
}


