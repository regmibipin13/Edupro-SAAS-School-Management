<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\SchoolMultitenancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    use SchoolMultitenancy;
    use Filterable;

    public static $filters = [
        'name',
    ];
    public static $relationFilters = [
        'school' => 'id',
    ];

    protected $guarded = ['id'];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    public function timetables()
    {
        return $this->hasMany(Timetable::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
