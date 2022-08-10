<?php

use App\Models\Grade;
use App\Models\Subject;

function eligibleForMarks()
{
    return request()->has('classroom_id') && request()->has('section_id') && request()->has('exam_id') && request()->has('subject_id');
}

function toGPA($mark)
{
    return round($mark / 25, 2);
}

function toPercentage($gpa)
{
    return round($gpa * 25, 2);
}

function findGrade($mark)
{
    // 84

    // 90 - 100
    // 80 - 90
    $grade = Grade::where(function ($query) use ($mark) {
        $query->where('marks_from', '<=', $mark)
            ->where('marks_to', '>', $mark);
    })->first();

    if ($grade !== null) {
        return $grade->name;
    } else {
        return 'Not Specified';
    }
}

function calculatePercentage($marks)
{
    // dd($marks);
    $subjects = collect($marks)->map->subject_id->toArray();
    array_unique($subjects);

    $subjects = Subject::whereIn('id', $subjects)->get();

    $totalMarks = $subjects->sum('full_marks');
    // $passMarks = $subjects->sum('pass_marks');

    return round(($marks->sum('total_marks') / $totalMarks) * 100, 2);
}

function findRemark($mark)
{
    $grade = Grade::where(function ($query) use ($mark) {
        $query->where('marks_from', '<=', $mark)
            ->where('marks_to', '>', $mark);
    })->first();

    if ($grade !== null) {
        return $grade->remarks;
    } else {
        return 'Not Specified';
    }
}

function hasRole($roleName)
{
    if (auth()->check()) {
        if (auth()->user()->hasRole($roleName)) {
            return true;
        }
        return false;
    }
    return false;
}
