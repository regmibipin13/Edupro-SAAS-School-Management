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
                            <h4 class="card-title">Create New Subject</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.subjects.store') }}" method="POST" class="row">
                                @csrf
                                <div class="form-group col-md-6">
                                    <label for="name">{{ __('Subject Name *') }}</label>
                                    <input type="text" id="name"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
                                        value="{{ isset($subject) ? old('name', $subject->name) : old('name', '') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="code">{{ __('Subject Code') }}</label>
                                    <input type="text" id="code"
                                        class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" name="code"
                                        value="{{ isset($subject) ? old('code', $subject->code) : old('code', '') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="classroom_id">{{ __('Class') }}</label>
                                    <select name="classroom_id" id="classroom_id"
                                        class="form-control select2 {{ $errors->has('classroom_id') ? 'is-invalid' : '' }}">
                                        @foreach ($classrooms as $class)
                                            <option value="{{ $class->id }}"
                                                {{ isset($subject) ? ($subject->classroom_id == $class->id ? 'selected' : '') : '' }}>
                                                {{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="users">{{ __('Teachers') }}</label>
                                    <select name="users[]" id="users" multiple
                                        class="form-control select2 {{ $errors->has('users') ? 'is-invalid' : '' }}">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ isset($subject) ? ($subject->users->contains($user->id) ? 'selected' : '') : '' }}>
                                                {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button class="btn btn-success mr-2">Save</button>
                                <a class="btn btn-danger" href="{{ route('user.subjects.index') }}">Reset</a>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Search subjects</h4> <br />
                            <br />
                            <form action="{{ route('user.subjects.index') }}" method="get"
                                class="d-flex align-items-centern filters-list">
                                <select name="classroom" id="classroom" class="form-control mr-2">
                                    <option value="">All</option>
                                    @foreach ($classrooms as $class)
                                        <option value="{{ $class->id }}"
                                            {{ request()->classroom == $class->id ? 'selected' : '' }}>
                                            {{ $class->name }}</option>
                                    @endforeach
                                </select>
                                <input type="text" class="form-control mr-2" name="name"
                                    value="{{ request()->name }}" placeholder="{{ __('subject Name') }}">

                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Subject Name</th>
                                        <th>Class Name</th>
                                        <th>Teachers</th>
                                        <th>School</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjects as $sec)
                                        <tr>
                                            <td>{{ $sec->name }}</td>
                                            <td>{{ $sec->classroom->name }}</td>
                                            <td>
                                                @foreach ($sec->teachers as $teacher)
                                                    <span
                                                        class="badge badge-pill badge-success">{{ $teacher->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $sec->classroom->school->name }}</td>

                                            <td>
                                                <a href="#" onclick="edit({{ $sec }})"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                {{-- <a href="" class="btn btn-sm btn-info">View</a> --}}
                                                <a href="javascript:void(0)" class="btn btn-sm btn-danger"
                                                    onclick="document.getElementById('delete-form-{{ $sec->id }}').submit();">Delete</a>
                                                <form action="{{ route('user.subjects.destroy', $sec->id) }}"
                                                    id="delete-form-{{ $sec->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($subjects) <= 0)
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
                            {{ $subjects->appends(request()->all())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function edit(subject) {
            console.log(subject);
            $('.card-title').text("Edit subject")
            $('#name').val(subject.name);
            $('#code').val(subject.code);
            var users = subject.teachers.map(value => value.id);
            $('#users').val(users).change();
            $('#classroom_id').val(subject.classroom_id).change();
            $('form').append("<input type='hidden' name='_method' value='PATCH' id='patch-method'>")
            var route = '/subjects/' + subject.id;
            $('form').attr("action", route);
        }
    </script>
@endsection
