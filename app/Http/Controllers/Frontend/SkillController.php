<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SkillController extends BaseController
{
    public function index() {
        return view('frontend.skills');
    }
}
