@extends('layouts.app')
@section('content')
    @include('admin.partials.__content_header', [
        'header' => '',
    ])

    <div class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12 import-export-buttons">
                    <a href="{{ route('user.fees.create') }}" class="btn btn-success">Pay Fee</a>
                    <a href="{{ route('user.fees.export') }}" class="btn btn-success">Excel</a>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Search Students</h5>
                            <form action="{{ route('user.fees.index') }}" method="get" class="row">
                                <div class="col-md-2">
                                    <label for="classroom_id">Class</label>
                                    <select class="form-control" name="classroom_id" id="classroom_id"
                                        onchange="changeClass();">
                                        <option value="">Select Class</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}"
                                                {{ request()->classroom_id == $class->id ? 'selected' : '' }}>
                                                {{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="section_id">Section</label>
                                    <select class="form-control" name="section_id" id="section_id">
                                        <option value="">Select A Section</option>

                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="name">Student Name</label>
                                    <input type="text" name="student_name" class="form-control"
                                        placeholder="Student Name"value="{{ request()->student_name ?? '' }}">
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="name">Paid Date</label>
                                    <input type="date" name="paid_date" class="form-control"
                                        placeholder="Paid Name"value="{{ request()->paid_date ?? '' }}">
                                </div>


                                <div class="form-group col-md-2" style="position:relative;">
                                    <button type="submit" class="btn btn-primary "
                                        style="position:absolute;bottom:2px;">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-responsive" id="myTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Student Name</th>
                                        <th>Student Contact</th>
                                        <th>Class</th>
                                        <th>Total Fee Paid</th>
                                        <th>Paid Date</th>
                                        <th>Paid Till</th>
                                        <th>Payment Method</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fees as $fee)
                                        <tr>
                                            <td>
                                                {{ $fee->id }}
                                            </td>
                                            <td>
                                                {{ $fee->student->user->name }}
                                            </td>
                                            <td>{{ $fee->student->user->phone }}</td>
                                            <td>{{ $fee->student->classroom->name }} -
                                                {{ $fee->student->section->name }}</span>
                                            </td>
                                            <td>{{ $fee->totalFee() }}
                                            </td>
                                            <td>{{ $fee->paid_date }}</td>
                                            <td>{{ $fee->payment_untill }}</td>
                                            <td>{{ $fee->payment_method }}</td>
                                            <td class="d-flex align-items-center">
                                                @if (hasRole(['School Admin']))
                                                    <a href="{{ route('user.fees.pdf', $fee->id) }}"
                                                        class="btn btn-sm btn-primary mr-2">Invoice</a>
                                                    <form action="{{ route('user.fees.destroy', $fee->id) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete ?')"
                                                        id="delete-form-{{ $fee->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($fees) <= 0)
                                        <tr>
                                            <td id="colspan-automate" class="text-center">
                                                <span class="text-secondary text-center">No Data Available</span>
                                            </td>
                                        </tr>
                                    @endif


                                </tbody>
                            </table>
                        </div>

                        <div class="card-body">
                            {{ $fees->appends(request()->all())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        window.onload = function() {
            resetSection();
        }

        function resetSection() {
            $('#section_id').empty();
        }


        function changeClass() {
            resetSection();
            var classroom_id = $('#classroom_id').val();
            var sections;
            if (classroom_id !== '') {
                classroom_id = JSON.parse(classroom_id);
                $.ajax('/classrooms/' + classroom_id + '/sections', {
                    dataType: 'json',
                    success: function(data, status, xhr) {
                        data.forEach(section => {
                            var selected = '';
                            if (getUrlParameter('section_id') == section.id) {
                                selected = 'selected';
                            }
                            var option =
                                `<option value='${section.id}' ${selected}>${section.name}</option>`;
                            $('#section_id').append(option);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            }
        }
        $(document).ready(function() {
            changeClass();
        });

        function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
            return false;
        };
    </script>
@endsection
