<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    public function __construct()
    {
        $doctor = Doctor::query()
            ->where('id', 1)
            //->with(['socials', 'education']) # because has one doctor
            ->first();

        View::share('doctor', $doctor);
    }
}
