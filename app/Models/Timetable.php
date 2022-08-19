<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\SchoolMultitenancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;
    use SchoolMultitenancy;
    use Filterable;

    public static $filters = [
        'classroom_id',
        'section_id',
    ];

    public static $relationFilters = [];

    public function days()
    {
        return $this->belongsToMany(Day::class, 'timetable_days', 'day_id', 'timetable_id');
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
