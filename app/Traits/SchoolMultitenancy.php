<?php

namespace App\Traits;

use App\Models\School;
use Illuminate\Database\Eloquent\Builder;

trait SchoolMultitenancy
{
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public static function bootSchoolMultitenancy()
    {
        if (auth()->check() && !auth()->user()->is_admin) {
            // While creating the record it automatically add the school id
            static::creating(function ($model) {
                $model->school_id = auth()->user()->school_id;
            });

            static::addGlobalScope('school_id', function (Builder $builder) {
                $builder->where('school_id', auth()->user()->school_id);
            });
        }
    }
}
