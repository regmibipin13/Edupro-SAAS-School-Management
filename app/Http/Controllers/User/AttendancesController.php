<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Student;

class AttendancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!hasRole(['School Admin', 'Teachers'])) {
            return abort(403);
        }
        $attendances = Attendance::with(['student'])->filters($request)->paginate(50);
        $classrooms = Classroom::all();
        return view('user.attendances.index', compact('attendances', 'classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!hasRole(['School Admin', 'Teachers'])) {
            return abort(403);
        }
        $classrooms = Classroom::all();
        $students = [];
        if ($request->has('classroom_id') && $request->has('section_id')) {
            $students = Student::with(['attendances', 'user'])->where(function ($query) use ($request) {
                $query->where('classroom_id', $request->classroom_id)
                    ->where('section_id', $request->section_id);
            })->get();
        }
        return view('user.attendances.create', compact('classrooms', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = $request->date;

        $students = $request->students;

        $students = array_filter($students, function ($student) {
            return $student['attendance'] !== '' && $student['attendance'] !== null;
        });


        foreach ($students as $student) {
            $attendances = [];
            $attendances['school_id'] = $student['school_id'];
            $attendances['student_id'] = $student['id'];
            $attendances['classroom_id'] = $student['classroom_id'];
            $attendances['section_id'] = $student['section_id'];
            $attendances['attendance'] = $student['attendance'];
            $attendances['absent_reason'] = $student['attendance'] == 'Present' ? '' : ($student['absent_reason'] ?? '');
            $attendances['date'] = $date;

            Attendance::updateOrCreate([
                'student_id' => $student['id'],
                'classroom_id' => $student['classroom_id'],
                'section_id' => $student['section_id'],
                'date' => $date,
            ], $attendances);
        }
        return response()->json(['status' => 'success', 'success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
