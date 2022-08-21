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

    protected $guarded = ['id'];

    public static $filters = [
        'classroom_id',
        'section_id',
    ];

    public static $relationFilters = [];

    public function days()
    {
        return $this->belongsToMany(Day::class, 'timetable_days', 'timetable_id', 'day_id')->withTimestamps();
    }
    public function time()
    {
        return $this->belongsTo(Time::class, 'time_id');
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

    public function scopeByRole($query)
    {
        if (auth()->user()->hasRole(['School Admin', 'Teachers'])) {
            return $query;
        } elseif (auth()->user()->hasRole('Students')) {
            return $query->where('classroom_id', auth()->user()->student->classroom_id);
        } elseif (auth()->user()->hasRole('Parents')) {
            return $query->where('classroom_id', auth()->user()->child->classroom_id);
        } else {
            return $query;
        }
    }
}
