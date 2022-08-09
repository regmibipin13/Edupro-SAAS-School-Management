@extends('layouts.app')
@section('content')
    @include('admin.partials.__content_header', [
        'header' => '',
    ])

    <div class="content" refs="">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Search Classroom</h4> <br />
                            <br />
                            <form action="{{ route('user.marks.index') }}" method="get"
                                class="row d-flex align-items-center" style="align-items:flex-end">
                                <div class="col-md-3">
                                    <label for="exam_id">Exam</label>
                                    <select name="exam_id" id="exam_id" class="form-control select2 mr-2">
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
                                    <select name="classroom_id" id="classroom_id" class="form-control select2 mr-2"
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
                                    <label for="section_id">Select Section</label>
                                    <select class="form-control select2" name="section_id" id="section_id">
                                        <option value="">Select A Section</option>

                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="section_id">Select Subject</label>
                                    <select class="form-control select2" name="subject_id" id="subject_id">
                                        <option value="">Select A Subject</option>

                                    </select>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <button type="submit" class="btn btn-success">Search</button>
                                </div>
                            </form>
                        </div>
                        @if (eligibleForMarks())
                            <marks-entry :students-lists="{{ $data['students']->toJson() }}"
                                :subject="{{ $data['subject'] }}" :exam="{{ $data['exam'] }}" inline-template>
                                <div>
                                    <form action="{{ route('user.marks.store') }}" method="post" ref="formContainer"
                                        @submit.prevent="onSubmit">
                                        @csrf
                                        <div class="card-body">
                                            <div class="details pb-2">
                                                <b> Exam: {{ $data['exam']->name }}</b>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <b> Subject: {{ $data['subject']->name }}
                                                    ({{ $data['subject']->code }})</b>

                                            </div>
                                            <table class="table table-bordered" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>Student Name (ID)</th>
                                                        <th>Student Admission Number</th>
                                                        <th>Class</th>
                                                        <th>Section</th>
                                                        <th>Marks Attained</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @foreach ($data['students'] as $student)
                                                        <tr>
                                                            <td>{{ $student->user->name }}({{ $student->id }})</td>
                                                            <td>{{ $student->admission_number }}</td>
                                                            <td>{{ $student->classroom->name }}</td>
                                                            <td>{{ $student->section->name }}</td>
                                                            <td>
                                                                <input type="number" name="student_mark[]"
                                                                    placeholder="ex. 10" class="form-control" min="0"
                                                                    max="100"
                                                                    value="{{ $student->getMarks($data['exam']->id, $data['subject']->id) }}">
                                                                <input type="hidden" name="student_id[]"
                                                                    value="{{ $student->id }}">
                                                            </td>
                                                        </tr>
                                                    @endforeach --}}
                                                    <tr v-for="(student,index) in students">
                                                        <td>@{{ student.user.name }}(@{{ student.id }})</td>
                                                        <td>@{{ student.admission_number }}</td>
                                                        <td>@{{ student.classroom.name }}</td>
                                                        <td>@{{ student.section.name }}</td>
                                                        <td>
                                                            <input type="number" name="" placeholder="ex. 10"
                                                                class="form-control" min="0" max="100"
                                                                v-model="students[index].total_marks">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="card-footer">
                                            <button class="btn btn-success"type="submit">Update Marks</button>
                                        </div>
                                    </form>
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
        $(document).ready(function() {
            changeClass();
        });

        function resetSection() {
            console.log('fired')
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
