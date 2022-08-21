@extends('layouts.app')
@section('content')
    @include('admin.partials.__content_header', [
        'header' => '',
    ])

    <div class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12 import-export-buttons">
                    <a href="{{ route('user.students.create') }}" class="btn btn-success">Add New Student</a>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Search Students</h5>
                            <form action="{{ route('user.students.index') }}" method="get" class="row">
                                <div class="col-md-3">
                                    <label for="classroom_id">Class</label>
                                    <select class="form-control select2" name="classroom_id" id="classroom_id"
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
                                    <select class="form-control select2" name="section_id" id="section_id">
                                        <option value="">Select A Section</option>

                                    </select>
                                </div>
                                {{-- <div class="col-md-2">
                                    <label for="gender">Gender</label>
                                    <select class="form-control select2" name="gender[]" id="gender" multiple>

                                        <option value="Male"
                                            {{ in_array('Male', request()->gender ?? []) ? 'selected' : '' }}>Male</option>
                                        <option
                                            value="Female"{{ in_array('Female', request()->gender ?? []) ? 'selected' : '' }}>
                                            Female</option>
                                        <option
                                            value="Others"{{ in_array('Others', request()->gender ?? []) ? 'selected' : '' }}>
                                            Others</option>

                                    </select>
                                </div> --}}

                                <div class="form-group col-md-3">
                                    <label for="name">Student Name</label>
                                    <input type="text" name="user" class="form-control"
                                        placeholder="Student Name"value="{{ request()->name ?? '' }}">
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
                                        <th>Gender</th>
                                        <th>DOB</th>
                                        <th>Admitted Date</th>
                                        <th>School</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>
                                                {{ $student->id }}
                                            </td>
                                            <td>{{ $student->user->name }}</td>
                                            <td>{{ $student->user->phone }}</td>
                                            <td>{{ $student->classroom->name }} - {{ $student->section->name }}</span>
                                            </td>
                                            <td>{{ $student->user->gender }}</td>
                                            <td>{{ $student->user->dob }}</td>
                                            <td>{{ $student->admitted_date }}</td>
                                            <td>{{ $student->school->name }}</td>
                                            <td class="d-flex align-items-center">
                                                @if (hasRole(['School Admin']))
                                                    <a href="{{ route('user.students.edit', $student->id) }}"
                                                        class="btn btn-sm btn-primary mr-2">Edit</a>
                                                    <form action="{{ route('user.students.destroy', $student->id) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete ?')"
                                                        id="delete-form-{{ $student->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($students) <= 0)
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
                            {{ $students->appends(request()->all())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
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
