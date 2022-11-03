<?php

namespace App\Http\Controllers\User;

use App\Exports\FeePaymentExport;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\FeePayment;
use App\Models\Section;
use App\Models\Student;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class FeePaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fees = FeePayment::with(['student'])->filters($request)->orderBy('id', 'desc')->paginate(20);
        $classes = Classroom::with(['sections'])->get();
        if ($request->ajax()) {
            if ($request->has('classroom_id')) {
                return Section::where('classroom_id', $request->classroom_id)->get();
            }
        }
        return view('user.fees.index', compact('fees', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $classrooms = Classroom::with(['sections'])->get();
        if ($request->ajax()) {
            if ($request->has('classroom_id')) {
                return Section::where('classroom_id', $request->classroom_id)->get();
            }
        }
        return view('user.fees.payment', compact('classrooms'));
    }

    public function pending(Request $request)
    {
        $data = [];
        $monthlyFee = 0;
        $transportationFee = 0;
        $foodFee = 0;
        $student = Student::find($request->student_id);
        $student->load(['classroom', 'school']);
        if ($student) {
            $lastPayment = FeePayment::where('student_id', $student->id)->where('payment_untill', now()->subMonth())->latest()->first();
            if ($lastPayment) {
                $months = Carbon::parse($lastPayment->payment_untill)->diffInMonths(Carbon::parse(Carbon::now()));
                $monthlyFee = $student->classroom->monthly_fee * $months;
                if ($student->is_transportation_fee) {
                    $transportationFee = $student->school->transportation_fee * $months;
                }
                if ($student->is_food_fee) {
                    $foodFee = $student->school->food_fee * $months;
                }

                $data['monthly_fee'] = $monthlyFee;
                $data['transportationFee'] = $transportationFee;
                $data['foodFee'] = $foodFee;
                $data['last_paid'] = $lastPayment->paid_date;
                $data['last_paid_untill'] = $lastPayment->payment_untill;
                $data['student_name'] = $student->user->name;
                $data['total_duration'] = $months;
                return response()->json($data);
            } else {
                $lastPayment = FeePayment::where('student_id', $student->id)->count();
                if ($lastPayment <= 0) {
                    $months = Carbon::parse($student->school->academic_year_start_date)->diffInMonths(Carbon::parse(Carbon::now()));
                    $monthlyFee = $student->classroom->monthly_fee * $months;
                    if ($student->is_transportation_fee) {
                        $transportationFee = $student->school->transportation_fee * $months;
                    }
                    if ($student->is_food_fee) {
                        $foodFee = $student->school->food_fee * $months;
                    }

                    $data['monthly_fee'] = $monthlyFee;
                    $data['transportationFee'] = $transportationFee;
                    $data['foodFee'] = $foodFee;
                    $data['last_paid'] = '';
                    $data['last_paid_untill'] = '';
                    $data['student_name'] = $student->user->name;
                    $data['total_duration'] = $months;

                    return response()->json($data);
                } else {
                    return response()->json(false);
                }
            }
        }
        return response()->json(false);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    public function pay(Request $request)
    {
        $student = Student::find($request->student_id);
        $feePayment = FeePayment::create([
            'school_id' => $student->school->id,
            'student_id' => $student->id,
            'regular_fee' => $request->regular_fee,
            'transportation_fee' => $request->transportation_fee,
            'food_fee' => $request->food_fee,
            'other_payments' => $request->other_payments ?? 0,
            'payment_untill' => Carbon::parse($request->payment_untill)->toDateTime(),
            'paid_date' => Carbon::now()->toDateTime(),
            'payment_method' => $request->payment_method,
            'payment_description' => $request->description,
            'description' => $request->description,
        ]);

        $seller = new Party([
            'name'          => $student->school->name,
            'phone'         => $student->school->phone,
            'address' => $student->school->address
        ]);


        $customer = new Buyer([
            'name'          => $student->user->name,
            'custom_fields' => [
                'student_id' => $student->id,
                'student_name' => $student->user->name,
                'student_contact' => $student->user->phone,
            ],
        ]);

        $items = [
            (new InvoiceItem())->title('Monthly Fee')->pricePerUnit($request->regular_fee),
            (new InvoiceItem())->title('Transportation Fee')->pricePerUnit($request->transportation_fee),
            (new InvoiceItem())->title('Food Fee')->pricePerUnit($request->food_fee),
            (new InvoiceItem())->title('Other Payments')->pricePerUnit($request->other_payments ?? 0),

        ];
        $invoice = Invoice::make('receipt')
            // ->series('BIG')
            // ability to include translated invoice status
            // in case it was paid
            ->status(__('invoices::invoice.paid'))
            ->sequence($feePayment->id)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($seller)
            ->buyer($customer)
            ->date(now()->subWeeks(3))
            ->dateFormat('m/d/Y')
            ->currencySymbol('Rs.')
            ->currencyCode('NPR')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename(Carbon::now()->toDateString() . ' ' . $customer->name)
            ->addItems($items)
            // You can additionally save generated invoice to configured disk
            ->save('public');

        return $invoice->url();
    }

    public function generatePDF($feePaymentId)
    {
        $feePayment = FeePayment::find($feePaymentId);
        $student = $feePayment->student;
        $seller = new Party([
            'name'          => $student->school->name,
            'phone'         => $student->school->phone,
            'address' => $student->school->address
        ]);


        $customer = new Buyer([
            'name'          => $student->user->name,
            'custom_fields' => [
                'student_id' => $student->id,
                'student_name' => $student->user->name,
                'student_contact' => $student->user->phone,
            ],
        ]);

        $items = [
            (new InvoiceItem())->title('Monthly Fee')->pricePerUnit($feePayment->regular_fee),
            (new InvoiceItem())->title('Transportation Fee')->pricePerUnit($feePayment->transportation_fee),
            (new InvoiceItem())->title('Food Fee')->pricePerUnit($feePayment->food_fee),
            (new InvoiceItem())->title('Other Payments')->pricePerUnit($feePayment->other_payments ?? 0),

        ];
        $invoice = Invoice::make('receipt')
            // ->series('BIG')
            // ability to include translated invoice status
            // in case it was paid
            ->status(__('invoices::invoice.paid'))
            ->sequence($feePayment->id)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($seller)
            ->buyer($customer)
            ->date(now()->subWeeks(3))
            ->dateFormat('m/d/Y')
            ->currencySymbol('Rs.')
            ->currencyCode('NPR')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename(Carbon::now()->toDateString() . ' ' . $customer->name)
            ->addItems($items);
        // You can additionally save generated invoice to configured disk
        // ->save('public');

        return redirect()->to($invoice->url());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($feePayment)
    {
        $feePayment = FeePayment::find($feePayment);
        $feePayment->delete();
        return redirect()->back()->with('success', 'Fee Payment Bill Deleted Successfully');
    }

    public function export()
    {
        return Excel::download(new FeePaymentExport, 'fee_bills.xlsx');
    }
}
