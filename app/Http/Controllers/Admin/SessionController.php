<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\Student_list;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function startSessionPage()
    {
        return view('admin.session.start-session');

    }

    public function createSession(Request $request)
    {
        $request->validate([
            'barcode' => 'required|string',
            'action' => 'required|in:time_in,time_out',
        ]);
        $student = Student_list::where('barcode', $request->input('barcode'))->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Invalid barcode. Student record not found.');
        }

        $lastSession = Session::where('student_id', $student->student_id)
            ->orderBy('created_at', 'desc')
            ->first();

        // Check if the last session exists
        if ($request->input('action') == 'time_out') {
            // Check if the last time_in session was at least 1 minute ago
            if ($lastSession && $lastSession->action == 'time_in') {
                $lastTimeIn = Carbon::parse($lastSession->created_at);
                $currentTime = Carbon::now();
                $timeDifference = $currentTime->diffInSeconds($lastTimeIn);

                if ($timeDifference < 60) {
                    return redirect()->back()->with('error', 'Cannot time out. Student has not been timed in for at least 1 minute.');
                }
            }
        }

        if ($lastSession) {

            if ($lastSession->action == 'time_in' && $request->input('action') == 'time_in') {
                // Timeout the student
                $session = new Session();
                $session->student_id = $student->student_id;
                $session->name = $student->name;
                $session->course = $student->course;
                $session->barcode = $request->input('barcode');
                $session->action = 'time_out';
                $session->time = Carbon::now()->format('H:i:s');
                $session->save();
                return redirect()->back()->with(['succes' => 'Student timed out successfully.', 'student' => $student]);
            }

            // if ($lastSession->action == 'time_out' && $request->input('action') == 'time_out') {
            //     $session = new Session();
            //     $session->student_id = $student->student_id;
            //     $session->name = $student->name;
            //     $session->course = $student->course;
            //     $session->barcode = $request->input('barcode');
            //     $session->action = 'time_in';
            //     $session->time = Carbon::now()->format('H:i:s');
            //     $session->save();
            //     return redirect()->back()->with(['success' => 'Student timed in successfully.', 'student' => $student]);
            // }

            else {

                $session = new Session();
                $session->student_id = $student->student_id;
                $session->name = $student->name;
                $session->course = $student->course;
                $session->barcode = $request->input('barcode');
                $session->action = 'time_in';
                $session->time = Carbon::now()->format('H:i:s');
                $session->save();
                return redirect()->back()->with(['success' => 'Student timed in successfully.', 'student' => $student]);
            }
        }

        $session = new Session();
        $session->student_id = $student->student_id;
        $session->name = $student->name;
        $session->course = $student->course;
        $session->barcode = $request->input('barcode');
        $session->action = 'time_in';
        $session->time = Carbon::now()->format('H:i:s');
        $session->save();
        return redirect()->back()->with(['success' => 'Student timed in successfully.', 'student' => $student]);

    }



    public function ShowAllSession()
    {
        $todayDate = now()->timezone('Asia/Manila')->toDateString();

        $activeSessions = Session::whereIn('action', ['time_in', 'time_out'])->get();

        $studentsTimedInToday = Session::where('action', ['time_in', 'time_out'])
            ->whereDate('created_at', $todayDate)
            ->get();

        foreach ($studentsTimedInToday as $student) {
            $timeOut = Session::where('student_id', $student->student_id)
                ->where('action', 'time_out')
                ->orderBy('created_at', 'desc')
                ->first();

            if ($timeOut) {
                $timeIn = Carbon::parse($student->created_at);
                $timeOut = Carbon::parse($timeOut->created_at);
                $duration = $timeIn->diff($timeOut)->format('%H:%I:%S');
                $student->duration = $duration;
            } else {
                $student->duration = null;
            }
        }

        $activeSession = Session::all();
        $sessionsByDay = $activeSession->groupBy(function ($session) {
            return $session->created_at->format('Y-m-d');
        });

        return view('admin.session.all-session', [
            'activeSessions' => $activeSessions,
            'studentsTimedInToday' => $studentsTimedInToday,
            'sessionsByDay' => $sessionsByDay,
        ]);
    }


    public function showActiveSession()
    {
        $todayDate = now()->timezone('Asia/Manila')->toDateString();

        $activeSessions = Session::whereIn('action', ['time_in', 'time_out'])->get();

        $studentsTimedInToday = Session::where('action', ['time_in', 'time_out'])
            ->whereDate('created_at', $todayDate)
            ->get();

        foreach ($studentsTimedInToday as $student) {
            $timeOut = Session::where('student_id', $student->student_id)
                ->where('action', 'time_out')
                ->orderBy('created_at', 'desc')
                ->first();

            if ($timeOut) {
                $timeIn = Carbon::parse($student->created_at);
                $timeOut = Carbon::parse($timeOut->created_at);
                $duration = $timeIn->diff($timeOut)->format('%H:%I:%S');
                $student->duration = $duration;
            } else {
                $student->duration = null;
            }
        }

        $activeSession = Session::all();
        $sessionsByDay = $activeSession->groupBy(function ($session) {
            return $session->created_at->format('Y-m-d');
        });

        return view('admin.session.active-session', [
            'activeSessions' => $activeSessions,
            'studentsTimedInToday' => $studentsTimedInToday,
            'sessionsByDay' => $sessionsByDay,
        ]);
    }
}
