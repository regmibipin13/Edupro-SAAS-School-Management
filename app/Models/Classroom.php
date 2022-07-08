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
}
