<?php

namespace App\Exports;

use App\Models\FeePayment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FeePaymentExport implements FromQuery, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return FeePayment::query();
    }
    public function map($feePayment): array
    {
        return [
            $feePayment->student_id,
            $feePayment->student->user->name,
            $feePayment->monthly_fee,
            $feePayment->transportation_fee,
            $feePayment->food_fee,
            $feePayment->other_payments,
            $feePayment->payment_description,
            $feePayment->payment_untill,
            $feePayment->paid_date,
            $feePayment->payment_method,
            $feePayment->payment_description,
        ];
    }

    public function headings(): array
    {
        return [
            'Student Id',
            'Student Name',
            'Monthly Fee',
            'Transportation Fee',
            'Food Fee',
            'Other Payments',
            'Description',
            'Payment Untill',
            'Paid Date',
            'Payment Method',
            'Payment Description'
        ];
    }
}
