<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student_list;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchStudent(Request $request)
    {
        $query = $request->input('query');

        // Perform your search logic here using Eloquent ORM or other methods
        $results = Student_list::where(function($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', '%'.$query.'%')
                        ->orWhere('student_id', 'like', '%'.$query.'%')
                        ->orWhere('course', 'like', '%'.$query.'%')
                        ->orWhere('barcode', 'like', '%'.$query.'%');
        })->get();

        return view('admin.student.student-list', compact('results'));
    }
}
