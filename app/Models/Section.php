<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\SchoolMultitenancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    use SchoolMultitenancy;
    use Filterable;

    public static $filters = [
        'total_capasity',
        'name'
    ];

    public static $relationFilters = [
        'classroom' => 'id',
    ];

    protected $guarded = ['id'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function class_teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
