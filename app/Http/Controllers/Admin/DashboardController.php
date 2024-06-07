<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function visits()
    {
        // Most visited course
        $mostVisitedCourse = Session::select('course')
            ->where('action', 'time_out')
            ->groupBy('course')
            ->orderByRaw('COUNT(*) DESC')
            ->first();

        if ($mostVisitedCourse) {
            $mostVisitedCourseName = $mostVisitedCourse->course;
            $mostVisitedCount = Session::where('course', $mostVisitedCourseName)
                ->where('action', 'time_out')
                ->count();
        } else {
            $mostVisitedCourseName = "No visits recorded";
            $mostVisitedCount = 0;
        }

        // Least visited course
        $leastVisitedCourse = Session::select('course')
            ->where('action', 'time_out')
            ->groupBy('course')
            ->orderByRaw('COUNT(*)')
            ->first();

        if ($leastVisitedCourse) {
            $leastVisitedCourseName = $leastVisitedCourse->course;
            $leastVisitedCount = Session::where('course', $leastVisitedCourseName)
                ->where('action', 'time_out')
                ->count();
        } else {
            $leastVisitedCourseName = "No visits recorded";
            $leastVisitedCount = 0;
        }

        return view('admin.admin-dashboard', compact('mostVisitedCourseName', 'mostVisitedCount', 'leastVisitedCourseName', 'leastVisitedCount'));

    }
}
