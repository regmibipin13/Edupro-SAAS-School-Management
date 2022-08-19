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
}
