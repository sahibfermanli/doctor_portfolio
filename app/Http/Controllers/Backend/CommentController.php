<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Comments\CommentRequest;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Blog $blog
     * @return LengthAwarePaginator
     */
    public function index(Blog $blog): LengthAwarePaginator
    {
        return $blog->comments()->orderByDesc('id')->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     * @param Blog $blog
     * @return Response
     */
    public function store(CommentRequest $request, Blog $blog): Response
    {
        $data = $request->validated();

        $blog->comments()->create([
            'name' => auth()->user()->name ?? null,
            'email' => auth()->user()->email ?? null,
            'content' => $data['content']
        ]);

        return response(['message' => 'Comment was successfully added!']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CommentRequest $request
     * @param Comment $comment
     * @return Response
     */
    public function update(CommentRequest $request, Comment $comment): Response
    {
        $comment->update($request->validated());

        return response(['message' => 'Comment was successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return Response
     */
    public function destroy(Comment $comment): Response
    {
        $comment->delete();

        return response(['message' => 'Comment was successfully deleted!']);
    }
}
