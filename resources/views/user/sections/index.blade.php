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
                            <h4 class="card-title">Create New Section</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.sections.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">{{ __('Section Name *') }}</label>
                                    <input type="text" id="name"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
                                        value="{{ isset($section) ? old('name', $section->name) : old('name', '') }}">
                                </div>
                                <div class="form-group">
                                    <label for="total_capasity">{{ __('Capasity') }}</label>
                                    <input type="number" id="total_capasity"
                                        class="form-control {{ $errors->has('total_capasity') ? 'is-invalid' : '' }}"
                                        name="total_capasity"
                                        value="{{ isset($section) ? old('total_capasity', $section->total_capasity) : old('total_capasity', '') }}">
                                </div>
                                <div class="form-group">
                                    <label for="classroom_id">{{ __('Class') }}</label>
                                    <select name="classroom_id" id="classroom_id"
                                        class="form-control select2 {{ $errors->has('classroom_id') ? 'is-invalid' : '' }}">
                                        @foreach ($classrooms as $class)
                                            <option value="{{ $class->id }}"
                                                {{ isset($section) ? ($section->classroom_id == $class->id ? 'selected' : '') : '' }}>
                                                {{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="user_id">{{ __('Class Teacher') }}</label>
                                    <select name="user_id" id="class" id="user_id"
                                        class="form-control select2 {{ $errors->has('user_id') ? 'is-invalid' : '' }}">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ isset($section) ? ($section->user_id == $user->id ? 'selected' : '') : '' }}>
                                                {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button class="btn btn-success">Save</button>
                                <a class="btn btn-danger" href="{{ route('user.sections.index') }}">Reset</a>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Sections
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Section Name</th>
                                        <th>Total Capasity</th>
                                        <th>Class Name</th>
                                        <th>School</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sections as $sec)
                                        <tr>
                                            <td>{{ $sec->name }}</td>
                                            <td>{{ $sec->total_capasity }}</td>
                                            <td>{{ $sec->classroom->name }}</td>
                                            <td>{{ $sec->classroom->school->name }}</td>

                                            <td>
                                                <a href="#" onclick="edit({{ $sec }})"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                {{-- <a href="" class="btn btn-sm btn-info">View</a> --}}
                                                <a href="javascript:void(0)" class="btn btn-sm btn-danger"
                                                    onclick="document.getElementById('delete-form-{{ $sec->id }}').submit();">Delete</a>
                                                <form action="{{ route('user.sections.destroy', $sec->id) }}"
                                                    id="delete-form-{{ $sec->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($sections) <= 0)
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
                            {{ $sections->appends(request()->all())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function edit(section) {
        $('.card-title').text("Edit Section")
        $('#name').val(section.name);
        $('#total_capasity').val(section.total_capasity);
        $('#user_id').val(section.user_id);
        $('#classroom_id').val(section.classroom_id);
        $('form').append("<input type='hidden' name='_method' value='PATCH' id='patch-method'>")
        var route = '/sections/' + section.id;
        $('form').attr("action", route);
    }
</script>
