<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\Blog\StoreCommentRequest;
use App\Models\Blog;
use App\Models\Category;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class BlogController extends BaseController
{
    // TODO BaseController control
    // TODO Blog: search, tags, share, created date cast for human, paginate. Comment: reply, date cast for human.

    public function index($slug = null) {
        [$categories, $popular_blogs] = $this->get_datas();

        $blogs = Blog::query()
            ->when($slug !== null, function($q) use($slug) {
                $q->whereHas('category', function($query) use ($slug){
                    $query->where('slug', $slug);
                });
            })
            ->withCount('comments')
            ->orderBy('id', 'desc')
            ->get();

        return view('frontend.blogs.index', compact('categories', 'popular_blogs', 'blogs'));
    }

    public function show($slug) {
        [$categories, $popular_blogs] = $this->get_datas();

        $blog = Blog::query()
            ->where('slug', $slug)
            ->with(['comments', 'category'])
            ->first();

        if (!$blog) {
            abort(404, 'Blog not found!');
        }

        $blog->increment('read_count');

        return view('frontend.blogs.show', compact('categories', 'popular_blogs', 'blog'));
    }

    public function store_comment(StoreCommentRequest $request, Blog $blog): RedirectResponse
    {
        try {
            $blog->comments()->create($request->validated());

            Session::flash('status', 'success');
            Session::flash('message', 'Your comment was added successfully.');

            return redirect()->back();
        } catch (Exception $expception) {
            Session::flash('status', 'danger');
            Session::flash('message', 'Sorry something went wrong!');

            return redirect()->back();
        }
    }

    private function get_datas(): array
    {
        $categories = Category::query()->withCount('blogs')->get();
        $popular_blogs = Blog::query()
            ->orderBy('read_count', 'desc')
            ->orderBy('id', 'desc')
            ->take(3)
            ->get();

        return [$categories, $popular_blogs];
    }
}
