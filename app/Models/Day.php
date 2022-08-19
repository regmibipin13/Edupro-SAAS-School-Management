<?php

namespace App\Models;

use App\Traits\SchoolMultitenancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;
    use SchoolMultitenancy;

    protected $guarded = ['id'];

    public function timetables()
    {
        return $this->belongsToMany(Timetable::class, 'timetable_days', 'timetable_id', 'day_id');
    }
}
