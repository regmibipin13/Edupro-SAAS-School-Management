@extends('layouts.app')
@section('content')
    @include('admin.partials.__content_header', [
        'header' => '',
    ])

    <div class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12 import-export-buttons">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Create New Exam</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.exams.store') }}" method="POST" class="row">
                                @csrf
                                <div class="form-group col-md-6">
                                    <label for="name">{{ __('Exam Name *') }}</label>
                                    <input type="text" id="name"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
                                        value="{{ isset($subject) ? old('name', $subject->name) : old('name', '') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="term">{{ __('Exam Term *') }}</label>
                                    <select name="term" id="term" class="form-control">
                                        <option value="First Term">First Term</option>
                                        <option value="Second Term">Second Term</option>
                                        <option value="Third Term">Third Term</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="start_date">{{ __('Start Date *') }}</label>
                                    <input type="date"
                                        class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}"
                                        name="start_date" id="start_date">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="end_date">{{ __('End Date *') }}</label>
                                    <input type="date"
                                        class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}"
                                        name="end_date" id="end_date">
                                </div>
                                <button class="btn btn-success mr-2">Save</button>
                                <a class="btn btn-danger" href="{{ route('user.exams.index') }}">Reset</a>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Search Exams</h4> <br />
                            <br />
                            <form action="{{ route('user.exams.index') }}" method="get"
                                class="d-flex align-items-centern filters-list">

                                <input type="text" class="form-control mr-2 ml-2" name="name"
                                    value="{{ request()->name }}" placeholder="{{ __('Exam Name') }}">

                                <input type="date" class="form-control mr-2 ml-2" name="start_date"
                                    value="{{ request()->start_date }}" placeholder="{{ __('Start Date') }}">

                                <select name="term" id="term" class="form-control">
                                    <option value="">All</option>
                                    <option value="First Term" {{ request()->term == 'First Term' ? 'selected' : '' }}>
                                        First Term</option>
                                    <option value="Second Term"{{ request()->term == 'Second Term' ? 'selected' : '' }}>
                                        Second Term</option>
                                    <option value="Third Term"{{ request()->term == 'Third Term' ? 'selected' : '' }}>
                                        Third Term</option>
                                </select>

                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Exam Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Term</th>
                                        <th>School</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exams as $exam)
                                        <tr>
                                            <td>{{ $exam->name }}</td>
                                            <td>{{ $exam->start_date }}</td>
                                            <td>{{ $exam->end_date }}</td>
                                            <td>{{ $exam->term }}</td>
                                            <td>{{ $exam->school->name }}</td>

                                            <td>
                                                <a href="#" onclick="edit({{ $exam }})"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                {{-- <a href="" class="btn btn-sm btn-info">View</a> --}}
                                                <a href="javascript:void(0)" class="btn btn-sm btn-danger"
                                                    onclick="document.getElementById('delete-form-{{ $exam->id }}').submit();">Delete</a>
                                                <form action="{{ route('user.exams.destroy', $exam->id) }}"
                                                    id="delete-form-{{ $exam->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($exams) <= 0)
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
                            {{ $exams->appends(request()->all())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function edit(exam) {
            console.log(exam);
            $('.card-title').text("Edit Exam")
            $('#name').val(exam.name);
            $('#start_date').val(exam.start_date);
            $('#end_date').val(exam.end_date);

            $('#term').val(exam.term).change();
            $('form').append("<input type='hidden' name='_method' value='PATCH' id='patch-method'>")
            var route = '/exams/' + exam.id;
            $('form').attr("action", route);
        }
    </script>
@endsection
