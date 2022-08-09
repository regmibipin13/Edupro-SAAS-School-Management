@extends('layouts.app')
@section('content')
    @include('admin.partials.__content_header', [
        'header' => 'Attendance List',
    ])

    <div class="content">
        <div class="container-fluid">
            <attendance-create
                :student-lists="{{ request()->has('classroom_id') && request()->has('section_id') ? $students->toJson() : json_encode($students) }}"
                :request="{{ json_encode(request()->all()) }}" inline-template>
                <div class="row" refs="formContainer">
                    <div class="col-md-12">
                        <form class="row" action="{{ route('user.attendances.create') }}" method="get">
                            <div class="form-group col-md-4">
                                <label>Classroom</label>
                                <select class="form-control" name="classroom_id" v-model="classroom_id" required>
                                    @foreach ($classrooms as $class)
                                        <option value="{{ $class->id }}"
                                            {{ request()->classroom_id == $class->id ? 'selected' : '' }}>
                                            {{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Section</label>
                                <select class="form-control" name="section_id" v-model="section_id" required>

                                    <option v-for="section in sections" :value="section.id">@{{ section.name }}
                                    </option>

                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Date</label>
                                <input type="date" name="date" class="form-control" v-model="date" name="date"
                                    value="{{ request()->date ?? '' }}" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-success">Next</button>
                            </div>
                        </form>
                    </div>
                    @if (request()->has('classroom_id') && request()->has('section_id') && request()->has('date'))
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(student,index) in students">
                                                <td>@{{ student.id }}</td>
                                                <td>@{{ student.user.name }}</td>
                                                <td>
                                                    <select v-model="students[index].attendance" class="form-control">
                                                        <option value="Present">Present</option>
                                                        <option value="Absent">Absent</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" v-if="students[index].attendance == 'Absent'"
                                                        class="form-control" v-model="students[index].absent_reason"
                                                        placeholder="Ex. Sick">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-success" @click.prevent="onSubmit">Update
                                        Attendance</button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-md-12">
                            <span>Please Enter all the details properly</span>
                        </div>
                    @endif

                </div>
            </attendance-create>
        </div>
    </div>
@endsection
