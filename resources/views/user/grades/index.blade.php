@extends('layouts.app')
@section('content')
    @include('admin.partials.__content_header', [
        'header' => '',
    ])

    <div class="content">
        <div class="container-fluid">
            @if (hasRole('School Admin'))
                <div class="row mb-2">
                    <div class="col-md-12 import-export-buttons">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Create New Grade</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.grades.store') }}" method="POST" class="row">
                                    @csrf
                                    <div class="form-group col-md-3">
                                        <label for="name">{{ __('Grade Name *') }}</label>
                                        <input type="text" id="name"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            name="name"
                                            value="{{ isset($grade) ? old('name', $grade->name) : old('name', '') }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="marks_from">{{ __('Marks From *') }}</label>
                                        <input type="number" id="marks_from"
                                            class="form-control {{ $errors->has('marks_from') ? 'is-invalid' : '' }}"
                                            name="marks_from"
                                            value="{{ isset($grade) ? old('marks_from', $grade->marks_from) : old('marks_from', '') }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="marks_to">{{ __('Marks To *') }}</label>
                                        <input type="number" id="marks_to"
                                            class="form-control {{ $errors->has('marks_to') ? 'is-invalid' : '' }}"
                                            name="marks_to"
                                            value="{{ isset($grade) ? old('marks_to', $grade->marks_to) : old('marks_to', '') }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="remarks">{{ __('Remarks *') }}</label>
                                        <select name="remarks" id="remarks"
                                            class="form-control select2 {{ $errors->has('remarks') ? 'is-invalid' : '' }}">

                                            <option value="Excellent">
                                                Excellent</option>
                                            <option value="Very Good">
                                                Very Good</option>
                                            <option value="Good">
                                                Good</option>
                                            <option value="Try Better">
                                                Try Better</option>
                                            <option value="Poor">
                                                Poor</option>
                                            <option value="Very Poor">
                                                Very Poor</option>
                                        </select>
                                    </div>

                                    <button class="btn btn-success mr-2">Save</button>
                                    <a class="btn btn-danger" href="{{ route('user.grades.index') }}">Reset</a>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Grades Lists
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Grade Name</th>
                                        <th>Range</th>
                                        <th>Remarks</th>
                                        <th>School</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grades as $grade)
                                        <tr>
                                            <td>{{ $grade->name }}</td>
                                            <td>{{ $grade->marks_from }} - {{ $grade->marks_to }}</td>
                                            <td>{{ $grade->remarks }}</td>
                                            <td>{{ $grade->school->name }}</td>

                                            <td>
                                                @if (hasRole('School Admin'))
                                                    <a href="#" onclick="edit({{ $grade }})"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    {{-- <a href="" class="btn btn-sm btn-info">View</a> --}}
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger"
                                                        onclick="document.getElementById('delete-form-{{ $grade->id }}').submit();">Delete</a>
                                                    <form action="{{ route('user.grades.destroy', $grade->id) }}"
                                                        id="delete-form-{{ $grade->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($grades) <= 0)
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
                            {{ $grades->appends(request()->all())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function edit(grade) {
            console.log(grade);
            $('.card-title').text("Edit Grade")
            $('#marks_from').val(grade.marks_from);
            $('#name').val(grade.name);
            $('#marks_to').val(grade.marks_to);
            $('#remarks').val(grade.remarks).change();
            $('form').append("<input type='hidden' name='_method' value='PATCH' id='patch-method'>")
            var route = '/grades/' + grade.id;
            $('form').attr("action", route);
        }
    </script>
@endsection
