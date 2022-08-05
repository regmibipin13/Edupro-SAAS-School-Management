<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\SchoolMultitenancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    use SchoolMultitenancy;
    use Filterable;

    public static $filters = [
        'classroom_id',
        'section_id',
    ];

    public static $relationFilters = [
        'user' => 'name',
    ];

    protected $appends = [
        'total_marks'
    ];


    protected $guarded = ['id'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function getMarks($examID, $subjectID)
    {
        $mark = $this->marks()->where('exam_id', $examID)->where('subject_id', $subjectID)->first();
        return $mark ? $mark->total_marks : '';
    }

    public function getTotalMarksAttribute()
    {
        if (request()->has('exam_id') && request()->has('subject_id')) {
            return $this->getMarks(request()->exam_id, request()->subject_id);
        }
        return '';
    }
}
