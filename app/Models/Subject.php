<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\SchoolMultitenancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    use SchoolMultitenancy;
    use Filterable;

    protected $guarded = ['id'];

    public static $filters = [
        'name',
        'code'
    ];

    public static $relationFilters = [
        'classroom' => 'id',
        'teachers' => 'id',
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'subject_users', 'subject_id', 'user_id');
    }
}
