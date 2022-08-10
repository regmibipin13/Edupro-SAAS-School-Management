<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\Mark;
use App\Models\Student;
use Illuminate\Http\Request;

class MarksheetController extends Controller
{
    public function index(Request $request)
    {

        $exams = Exam::all();
        $classrooms = Classroom::all();
        if ($request->has('exam_id') && $request->has('classroom_id')) {
            if (!hasRole(['School Admin', 'Teachers'])) {
                $st = Student::where('user_id', auth()->id())->first();
                $students = Mark::with(['student', 'student.user'])->where(function ($query) use ($request, $st) {
                    $query->where('exam_id', $request->exam_id)
                        ->where('student_id', $st->id)
                        ->where('classroom_id', $request->classroom_id);
                })->groupBy('student_id')->get();
                return view('user.marksheet.index', compact('exams', 'classrooms', 'students'));
            }

            $students = Mark::with(['student', 'student.user'])->where(function ($query) use ($request) {
                $query->where('exam_id', $request->exam_id)
                    ->where('classroom_id', $request->classroom_id);
            })->groupBy('student_id')->get();
            return view('user.marksheet.index', compact('exams', 'classrooms', 'students'));
        }
        return view('user.marksheet.index', compact('exams', 'classrooms'));
    }

    public function marksheet($studentId, $examId)
    {
        $marks = Mark::with(['subject', 'student', 'classroom', 'school', 'exam'])->where('exam_id', $examId)->where('student_id', $studentId)->get();
        $school = $marks->first()->school;
        $exam = $marks->first()->exam;
        $student = $marks->first()->student;
        return view('templates.marksheet', compact('marks', 'school', 'exam', 'student'));
    }
}
