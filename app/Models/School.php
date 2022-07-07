<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    use Filterable;

    protected $guarded = ['id'];

    public static $filters = [
        'name',
        'email',
        'contact',
        'id'
    ];

    public static $relationFilters = [
        'relation_name' => 'relation_column_name'
    ];
}
