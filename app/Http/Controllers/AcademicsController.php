<?php

namespace App\Http\Controllers;

use App\Models\Intake;
use App\Models\IntakeDetail;
use Illuminate\Http\Request;
use App\Models\Degree;
use App\Models\Major;
use App\Models\Department;

class AcademicsController extends Controller
{
    public function index()
    {
        $undergraduateDegrees = Degree::with('duration')->where('level', 'undergraduate')->get();
        $mastersDegrees = Degree::with('duration')->where('level', 'masters')->get();
        $doctoralDegrees = Degree::with('duration')->where('level', 'doctoral')->get();
        $postgraduateDegrees = Degree::with('duration')->where('level', 'postgraduate')->get();
        $majors = Major::with('department')->get();

        return view('academics', compact('undergraduateDegrees', 'mastersDegrees', 'doctoralDegrees', 'postgraduateDegrees', 'majors'));
    }
}
