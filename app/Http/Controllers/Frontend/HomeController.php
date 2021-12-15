<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Contracts\View\View;

class HomeController extends BaseController
{
    public function index(): View
    {
        return view('frontend.home');
    }
}
