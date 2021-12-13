<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\View\View;

class MyInformationController extends BaseController
{
    public function __construct($doctor_relations = ['socials', 'education'])
    {
        parent::__construct($doctor_relations);
    }

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
