<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    public function __construct(Request $request)
    {
        switch ($request->route()->getName()) {
            case 'about':
                $doctor_relations = ['socials', 'education'];
                break;
            case 'skills':
                $doctor_relations = ['skills'];
                break;
            default:
                $doctor_relations = [];
        }

        $doctor = Doctor::query()
            ->where('id', 1)
            ->with($doctor_relations)
            ->first();

        View::share('doctor', $doctor);
    }
}
