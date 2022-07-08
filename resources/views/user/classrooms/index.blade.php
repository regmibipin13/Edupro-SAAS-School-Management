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
                            <h4 class="card-title">Create New Class</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.classrooms.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="name">{{ __('Class Name *') }}</label>
                                    <input type="text" id="name"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
                                        value="{{ isset($class) ? old('name', $class->name) : old('name', '') }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">{{ __('Class Location') }}</label>
                                    <input type="text" id="location"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        name="location"
                                        value="{{ isset($class) ? old('name', $class->name) : old('name', '') }}">
                                </div>

                                <button class="btn btn-success">Save</button>
                                <a class="btn btn-danger" href="{{ route('user.classrooms.index') }}">Reset</a>

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
                                Classrooms
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Class Name</th>
                                        <th>Class Location</th>
                                        <th>School</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classrooms as $class)
                                        <tr>
                                            <td>{{ $class->name }}</td>
                                            <td>{{ $class->location }}</td>
                                            <td>{{ $class->school->name }}</td>

                                            <td>
                                                <a href="#" onclick="edit({{ $class }})"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                {{-- <a href="" class="btn btn-sm btn-info">View</a> --}}
                                                <a href="javascript:void(0)" class="btn btn-sm btn-danger"
                                                    onclick="document.getElementById('delete-form-{{ $class->id }}').submit();">Delete</a>
                                                <form action="{{ route('user.classrooms.destroy', $class->id) }}"
                                                    id="delete-form-{{ $class->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($classrooms) <= 0)
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
                            {{ $classrooms->appends(request()->all())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function edit(classroom) {
        $('.card-title').text("Edit Class")
        $('#name').val(classroom.name);
        $('#location').val(classroom.location);
        $('form').append("<input type='hidden' name='_method' value='PATCH' id='patch-method'>")
        var route = '/classrooms/' + classroom.id;
        $('form').attr("action", route);
    }
</script>
