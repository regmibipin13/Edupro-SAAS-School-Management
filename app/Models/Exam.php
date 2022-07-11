<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\SchoolMultitenancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    use SchoolMultitenancy;
    use Filterable;

    protected $guarded = ['id'];

    public static $filters = [
        'start_date',
        'term',
        'name',
    ];

    public static $relationFilters = [];
}
