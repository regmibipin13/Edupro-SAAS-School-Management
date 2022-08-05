<?php


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
