@extends('layouts.app')
@section('content')
    @include('admin.partials.__content_header', [
        'header' => '',
    ])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('user.marksheets.index') }}" method="get" class="row">
                                <div class="form-group col-md-4">
                                    <label for="exam_id">Exam</label>
                                    <select name="exam_id" id="exam_id" class="form-control select2">
                                        <option value="" selected>Select Exam</option>
                                        @foreach ($exams as $exam)
                                            <option value="{{ $exam->id }}"
                                                {{ request()->exam_id == $exam->id ? 'selected' : '' }}>
                                                {{ $exam->name }} ({{ $exam->start_date }} -
                                                {{ $exam->end_date }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="classroom_id">Class</label>
                                    <select name="classroom_id" id="classroom_id" class="form-control select2">
                                        <option value="" selected>Select Class</option>
                                        @foreach ($classrooms as $class)
                                            <option value="{{ $class->id }}"
                                                {{ request()->classroom_id == $class->id ? 'selected' : '' }}>
                                                {{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Marksheets
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Student Email</th>
                                        <th>Student Phone</th>
                                        <th>Class</th>
                                        <th>Section</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (request()->has('exam_id') && request()->has('classroom_id'))
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>{{ $student->id }}</td>
                                                <td>{{ $student->student->user->name }}</td>
                                                <td>{{ $student->student->user->email }}</td>
                                                <td>{{ $student->student->user->phone }}</td>
                                                <td>{{ $student->student->classroom->name }}</td>
                                                <td>{{ $student->student->section->name }}</td>
                                                <td class="d-flex align-items-center">
                                                    <a href="{{ url('/marksheets/' . $student->student_id . '/' . $student->exam_id) }}"
                                                        class="btn btn-sm btn-info">View Marksheet</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
