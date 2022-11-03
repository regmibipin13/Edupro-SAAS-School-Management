@extends('layouts.app')
@section('content')
    @include('admin.partials.__content_header', [
        'header' => '',
    ])

    <fee :classrooms="{{ $classrooms->toJson() }}" inline-template>
        <div class="content" refs="formContainer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Search Student Fee
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row align-items-center">
                                        {{-- <div class="form-group col-md-2">
                                            <label for="classroom_id">Classroom</label>
                                            <select v-model="classroom_id" class="form-control">
                                                <option :value="c.id" v-for="(c, index) in classrooms">
                                                    @{{ c.name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="section_id">Section</label>
                                            <select v-model="section_id" class="form-control">
                                                <option :value="c.id" v-for="(c, index) in sections">
                                                    @{{ c.name }}
                                                </option>
                                            </select>
                                        </div> --}}
                                        <div class="form-group col-md-2">
                                            <label for="student_id">Student Id</label>
                                            <input type="text" class="form-control" v-model="student_id">
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-primary" @click.prevent="search">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3" v-if="this.pending_fee">
                        <div class="card">
                            <div class="card-header">
                                Fee Payment Bill
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Student Name</th>
                                        <td>@{{ this.pending_fee.student_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Monthly Fee Pending</th>
                                        <td>@{{ this.pending_fee.monthly_fee }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Transportation Fee Pending</th>
                                        <td>@{{ this.pending_fee.transportationFee }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Food Fee Pending</th>
                                        <td>@{{ this.pending_fee.foodFee }}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Paid</th>
                                        <td>@{{ this.pending_fee.last_paid }}</td>
                                    </tr>
                                    <tr>
                                        <th>Paid Untill</th>
                                        <td>@{{ this.pending_fee.last_paid_untill }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Duration (Months)</th>
                                        <td>@{{ this.pending_fee.total_duration }} </td>
                                    </tr>
                                    <tr>
                                        <th>Total Amount Payeable</th>
                                        <td>@{{ total }} </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Payment Action
                                </h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Other Payments To Be Added</th>
                                        <td>
                                            <input type="text" v-model="other_payments" class="form-control"
                                                >
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Payment Until</th>
                                        <td>
                                            <input type="date" v-model="payment_untill" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Payment Method</th>
                                        <td>
                                            <input type="text" v-model="payment_method" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Payment Description</th>
                                        <td>
                                            <textarea rows="3" class="form-control" v-model="description"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Grand Total</th>
                                        <td>
                                            @{{ grandTotal }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Action</th>
                                        <td>
                                            <button class="btn btn-danger" @click.prevent="pay">Pay Bill</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3" v-else>
                        <p class="text-secondary">No Pending Fees for this student</p>
                    </div>
                </div>
            </div>
        </div>
    </fee>
@endsection

@section('scripts')
@endsection
