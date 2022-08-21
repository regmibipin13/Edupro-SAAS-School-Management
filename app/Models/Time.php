<?php

namespace App\Models;

use App\Traits\SchoolMultitenancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;
    use SchoolMultitenancy;

    protected $guarded = ['id'];

    protected $appends = ['subject_id', 'teacher_id', 'days'];

    public function timetables()
    {
        return $this->hasMany(Timetable::class);
    }

    public function getTimeTableDetails()
    {
        if (request()->has('section_id') && request()->has('classroom_id')) {
            $timetable = $this->timetables()->where('classroom_id', request()->classroom_id)->where('section_id', request()->section_id)->first();
            if ($timetable) {
                $timetable->load(['days', 'subject', 'teacher']);
            }
            return $timetable;
        } else {
            return null;
        }
    }

    public function getSubjectIdAttribute()
    {
        $timetable =  $this->getTimeTableDetails();
        if ($timetable) {
            return $timetable->subject_id;
        } else {
            return null;
        }
    }
    public function getTeacherIdAttribute()
    {
        $timetable =  $this->getTimeTableDetails();
        if ($timetable) {
            return $timetable->teacher;
        } else {
            return null;
        }
    }
    public function getDaysAttribute()
    {
        $timetable =  $this->getTimeTableDetails();
        if ($timetable) {
            return $timetable->days;
        } else {
            return null;
        }
    }
}
