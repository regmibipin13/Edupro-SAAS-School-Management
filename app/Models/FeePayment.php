<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\SchoolMultitenancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeePayment extends Model
{
    use HasFactory;
    use SchoolMultitenancy;

    protected $guarded = ['id'];

    protected $dates = ['paid_untill', 'paid_date'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function totalFee()
    {
        return $this->regular_fee + $this->tution_fee + $this->transportation_fee + $this->food_fee + $this->clothing_fee + $this->other_payments;
    }

    public function scopeFilters($query, $request)
    {
        if ($request->has('classroom_id') && $request->classroom_id !== null) {
            $query->whereHas('student', function ($student) use ($request) {
                $student->where('classroom_id', $request->classroom_id);
            });
        }
        if ($request->has('section_id') && $request->section_id !== null) {
            $query->whereHas('student', function ($student) use ($request) {
                $student->where('section_id', $request->section_id);
            });
        }
        if ($request->has('student_name') && $request->student_name !== null) {
            $query->whereHas('student', function ($student) use ($request) {
                $student->whereHas('user', function ($user) use ($request) {
                    $user->where('name', 'like', '%' . $request->student_name . '%');
                });
            });
        }
        if ($request->has('paid_date') && $request->paid_date !== null) {
            $query->where('paid_date', $request->paid_date);
        }

        return $query;
    }
}
