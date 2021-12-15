<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\Blog\StoreCommentRequest;
use App\Models\Blog;
use App\Models\Category;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class BlogController extends BaseController
{
    public function __construct($doctor_relations = [])
    {
        parent::__construct($doctor_relations);

        [$categories, $popular_blogs] = $this->get_datas();

        \Illuminate\Support\Facades\View::share(['categories' => $categories, 'popular_blogs' => $popular_blogs]);
    }

    public function index(Request $request, $slug = null): View
    {
        $search = $request->input('search');

        $blogs = Blog::query()
            ->when($slug !== null, function ($q) use ($slug) {
                $q->whereHas('category', function ($query) use ($slug) {
                    $query->where('slug', $slug);
                });
            })
            ->when(isset($search) && !empty($search), function($query) use ($search) {
                $query->where('title', 'LIKE', '%' . $search . '%');
                $query->orWhere('short_content', 'LIKE', '%' . $search . '%');
                $query->orWhere('content', 'LIKE', '%' . $search . '%');
            })
            ->withCount('comments')
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('frontend.blogs.index', compact('blogs', 'search'));
    }

    public function show($slug): View
    {
        $blog = Blog::query()
            ->where('slug', $slug)
            ->with(['comments', 'category'])
            ->first();

        if (!$blog) {
            abort(404, 'Blog not found!');
        }

        $blog->increment('read_count');

        return view('frontend.blogs.show', compact('blog'));
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
        $categories = Category::query()
            ->withCount('blogs')
            ->orderBy('blogs_count', 'desc')
            ->take(15)
            ->get();

        $popular_blogs = Blog::query()
            ->orderBy('read_count', 'desc')
            ->orderBy('id', 'desc')
            ->take(3)
            ->get();

        return [$categories, $popular_blogs];
    }
}
