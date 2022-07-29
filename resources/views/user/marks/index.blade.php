@extends('layouts.app')
@section('content')
    @include('admin.partials.__content_header', [
        'header' => '',
    ])

    <div class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Search Classroom</h4> <br />
                            <br />
                            <form action="{{ route('user.marks.index') }}" method="get" class="row d-flex align-items-center"
                                style="align-items:flex-end">
                                <div class="col-md-3">
                                    <label for="exam_id">Exam</label>
                                    <select name="exam_id" id="exam_id" class="form-control mr-2">
                                        <option value="">Select Exam</option>
                                        @foreach ($exams as $exam)
                                            <option value="{{ $exam->id }}"
                                                {{ request()->exam_id == $exam->id ? 'selected' : '' }}>
                                                {{ $exam->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="classroom_id">Select Classroom</label>
                                    <select name="classroom_id" id="classroom_id" class="form-control mr-2" onchange="changeClass();">
                                        <option value="">Select Class</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}"
                                                {{ request()->classroom_id == $class->id ? 'selected' : '' }}>
                                                {{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="section_id">Select Section</label>
                                    <select class="form-control" name="section_id" id="section_id">
                                        <option value="">Select A Section</option>

                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="section_id">Select Subject</label>
                                    <select class="form-control" name="subject_id" id="subject_id">
                                        <option value="">Select A Subject</option>

                                    </select>
                                </div>
                                <div class="col-md-2 mt-2">
                                  <button type="submit" class="btn btn-success">Search</button>
                                </div>
                            </form>
                        </div>
                        @if(eligibleForMarks())
                        <marks-entry inline-template>
                            <div>
                                <div class="card-body">
                                    <table class="table table-bordered" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>Student Name</th>
                                                <th>Student Admission Number</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($students as $student)
                                                <tr>
                                                  {{ $student->user->name }}
                                                </tr>

                                                  {{ $student->admission_number }}
                                                <tr>
                                                    <td id="colspan-automate" class="text-center">
                                                        <span class="text-secondary text-center">No Data Available</span>
                                                    </td>
                                                </tr>

                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                                <div class="card-body">
                                    <button class="btn btn-success">Update Marks</button>
                                </div>
                            </div>
                        </marks-entry>
                        @endif
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
            $('#subject_id').empty();
        }

        function changeClass() {
            resetSection();
            var classroom_id = $('#classroom_id').val();
            if (classroom_id !== '') {
                classroom_id = JSON.parse(classroom_id);
                // Get Sections of the class
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
                // Get Subjects of the class
                $.ajax('/classrooms/' + classroom_id + '/subjects', {
                    dataType: 'json',
                    success: function(data, status, xhr) {
                        data.forEach(subject => {
                            var selected = '';
                            if (getUrlParameter('subject_id') == subject.id) {
                                selected = 'selected';
                            }
                            var option =
                                `<option value='${subject.id}' ${selected}>${subject.name}</option>`;
                            $('#subject_id').append(option);
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
