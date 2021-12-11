<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\View\View;

class MyInformationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('frontend.my_information');
    }
}
