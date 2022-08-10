<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Section;
use App\Models\Mark;
use Illuminate\Http\Request;

class MarksController extends Controller
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
        $classes = Classroom::all();
        $exams = Exam::all();
        $data = [];
        if (eligibleForMarks()) {
            $data['students'] = Student::with(['classroom', 'section', 'user', 'marks'])->where('classroom_id', $request->classroom_id)->where('section_id', $request->section_id)->get();
            $data['exam'] = Exam::find($request->exam_id);
            $data['subject'] = Subject::find($request->subject_id);
        }

        return view('user.marks.index', compact('classes', 'exams', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $studentMarks = [];
        foreach ($request->students ?? [] as $student) {
            $marks = [];
            $marks['school_id'] = $student['school_id'];
            $marks['classroom_id'] = $student['classroom_id'];
            $marks['section_id'] = $student['section_id'];
            $marks['student_id'] = $student['id'];
            $marks['exam_id'] = $request['exam']['id'];
            $marks['subject_id'] = $request['subject']['id'];
            $marks['total_marks'] = $student['total_marks'];
            $marks['gpa_gained'] = toGPA($student['total_marks']);
            $marks['full_marks'] = $request['subject']['full_marks'];
            $marks['full_gpa'] = toGPA($request['subject']['full_marks']);
            $marks['pass_marks'] = $request['subject']['pass_marks'];
            $marks['pass_gpa'] = toGPA($request['subject']['pass_marks']);
            Mark::updateOrCreate([
                'student_id' => $marks['student_id'],
                'exam_id' => $marks['exam_id'],
                'subject_id' => $marks['subject_id']
            ], $marks);
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

    public function getMarks($studentId, $data)
    {
        $mark = Mark::where(function ($query) use ($studentId, $data) {
            $query->where('student_id', $studentId)
                ->where('subject_id', $data['subject']->id)
                ->where('exam_id', $data['exam']->id);
        })->first();
        return $mark ? $mark->total_marks : '';
    }

    public function marksheet()
    {
        return  view('templates.marksheet');
    }
}
