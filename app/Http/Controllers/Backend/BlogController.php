<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Blogs\BlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Response;
use JetBrains\PhpStorm\ArrayShape;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    #[ArrayShape(['blogs' => LengthAwarePaginator::class, 'categories' => "\App\Models\Category[]|\Illuminate\Database\Eloquent\Collection"])] public function index(): array
    {
        $blogs = Blog::query()
            ->with('category')
            ->withCount('comments')
            ->orderByDesc('id')
            ->paginate(10);

        $categories = Category::all();

        return ['blogs' => $blogs, 'categories' => $categories];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogRequest $request
     * @return Response
     */
    public function store(BlogRequest $request): Response
    {
        $blog = Blog::query()->create($request->validated());

        if($request->hasFile('image') && $request->file('image')?->isValid()){
            try {
                $blog->clearMediaCollection();
                $blog->addMediaFromRequest('image')->toMediaCollection('blogs');
            } catch (FileDoesNotExist|FileIsTooBig) {
                //
            }
        }

        return response(['message' => 'Blog was successfully added!']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlogRequest $request
     * @param Blog $blog
     * @return Response
     */
    public function update(BlogRequest $request, Blog $blog): Response
    {
        $blog->update($request->validated());

        if($request->hasFile('image') && $request->file('image')?->isValid()){
            try {
                $blog->clearMediaCollection();
                $blog->addMediaFromRequest('image')->toMediaCollection('blogs');
            } catch (FileDoesNotExist|FileIsTooBig) {
                //
            }
        }

        return response(['message' => 'Blog was successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Blog $blog
     * @return Response
     */
    public function destroy(Blog $blog): Response
    {
        $blog->delete();

        return response(['message' => 'Blog was successfully deleted!']);
    }
}
