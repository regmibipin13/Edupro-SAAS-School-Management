@extends('layouts.app')
@section('content')
    @include('admin.partials.__content_header', [
        'header' => 'Attendance List',
    ])

    <div class="content">
        <div class="container-fluid">
            <attendance-lists :request="{{ json_encode(request()->all()) }}" inline-template>
                <div class="row">

                    <div class="col-md-12">
                        <form class="row" action="{{ route('user.attendances.index') }}" method="get">
                            <div class="form-group col-md-4">
                                <label>Classroom</label>
                                <select class="form-control" name="classroom_id" v-model="classroom_id">
                                    @foreach ($classrooms as $class)
                                        <option value="{{ $class->id }}"
                                            {{ request()->classroom_id == $class->id ? 'selected' : '' }}>
                                            {{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Section</label>
                                <select class="form-control" name="section_id" v-model="section_id">

                                    <option v-for="section in sections" :value="section.id">@{{ section.name }}
                                    </option>

                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Date</label>
                                <input type="date" name="date" class="form-control" v-model="date" name="date"
                                    value="{{ request()->date ?? '' }}">
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Attendance
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>
                                                Student ID
                                            </th>
                                            <th>
                                                Student Name
                                            </th>
                                            <th>
                                                Attendance
                                            </th>
                                            <th>
                                                Absent Reason
                                            </th>
                                            <th>
                                                Date
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendances as $att)
                                            <tr>
                                                <td>{{ $att->student->id }}</td>
                                                <td>{{ $att->student->user->name }}</td>
                                                <td>
                                                    @if ($att->attendance == 'Present')
                                                        <span
                                                            class="badge badge-pill badge-success">{{ $att->attendance }}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-pill badge-danger">{{ $att->attendance }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $att->absent_reason }}</td>
                                                <td>{{ $att->date }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </attendance-lists>
        </div>
    </div>
@endsection
