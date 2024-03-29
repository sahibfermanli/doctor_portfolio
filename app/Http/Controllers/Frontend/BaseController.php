<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    public function __construct($doctor_relations = [])
    {
        $doctor = Doctor::query()
            ->where('id', 1)
            ->with($doctor_relations)
            ->with('socials')
            ->first();

        View::share('doctor', $doctor);
    }
}
