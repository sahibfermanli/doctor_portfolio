<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Contracts\View\View;

class SkillController extends BaseController
{
    public function __construct($doctor_relations = ['skills'])
    {
        parent::__construct($doctor_relations);
    }

    public function index(): View
    {
        return view('frontend.skills');
    }
}
