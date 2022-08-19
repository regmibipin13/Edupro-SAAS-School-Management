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
                                <h4 class="card-title">Create New Day</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.days.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name">{{ __('Day Name *') }}</label>
                                        <input type="text" id="name"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            name="name"
                                            value="{{ isset($day) ? old('name', $day->name) : old('name', '') }}">
                                    </div>

                                    <button class="btn btn-success">Save</button>
                                    <a class="btn btn-danger" href="{{ route('user.days.index') }}">Reset</a>
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
                            <h4 class="card-title">
                                Days
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Day Name</th>
                                        <th>School</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($days as $day)
                                        <tr>
                                            <td>{{ $day->name }}</td>
                                            <td>{{ $day->school->name }}</td>

                                            <td>
                                                @if (hasRole('School Admin'))
                                                    <a href="#" onclick="edit({{ $day }})"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    {{-- <a href="" class="btn btn-sm btn-info">View</a> --}}
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger"
                                                        onclick="document.getElementById('delete-form-{{ $day->id }}').submit();">Delete</a>
                                                    <form action="{{ route('user.days.destroy', $day->id) }}"
                                                        id="delete-form-{{ $day->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($days) <= 0)
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
                            {{ $days->appends(request()->all())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function edit(day) {
        $('.card-title').text("Edit Date")
        $('#name').val(day.name);
        // $('#location').val(classroom.location);
        $('form').append("<input type='hidden' name='_method' value='PATCH' id='patch-method'>")
        var route = '/days/' + day.id;
        $('form').attr("action", route);
    }
</script>
