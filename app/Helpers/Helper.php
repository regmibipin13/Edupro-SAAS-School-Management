<?php


function eligibleForMarks() {
  return request()->has('classroom_id') && request()->has('section_id') && request()->has('exam_id') && request()->has('subject_id');
}
