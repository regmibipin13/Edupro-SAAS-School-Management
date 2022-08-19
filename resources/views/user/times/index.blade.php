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
                                <h4 class="card-title">Create New Time Range</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.times.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="time_from">{{ __('Time From *') }}</label>
                                        <input type="text" id="time_from"
                                            class="form-control {{ $errors->has('time_from') ? 'is-invalid' : '' }}"
                                            name="time_from" placeholder="10 AM"
                                            value="{{ isset($time) ? old('time_from', $time->time_from) : old('time_from', '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="time_to">{{ __('Time To *') }}</label>
                                        <input type="text" id="time_to"
                                            class="form-control {{ $errors->has('time_to') ? 'is-invalid' : '' }}"
                                            name="time_to" placeholder="10 AM"
                                            value="{{ isset($time) ? old('time_to', $time->time_to) : old('time_to', '') }}">
                                    </div>

                                    <button class="btn btn-success">Save</button>
                                    <a class="btn btn-danger" href="{{ route('user.times.index') }}">Reset</a>
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
                                Time Ranges
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Time From</th>
                                        <th>Time To</th>
                                        <th>School</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($times as $time)
                                        <tr>
                                            <td>{{ $time->time_from }}</td>
                                            <td>{{ $time->time_to }}</td>
                                            <td>{{ $time->school->name }}</td>

                                            <td>
                                                @if (hasRole('School Admin'))
                                                    <a href="#" onclick="edit({{ $time }})"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    {{-- <a href="" class="btn btn-sm btn-info">View</a> --}}
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger"
                                                        onclick="document.getElementById('delete-form-{{ $time->id }}').submit();">Delete</a>
                                                    <form action="{{ route('user.times.destroy', $time->id) }}"
                                                        id="delete-form-{{ $time->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($times) <= 0)
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
                            {{ $times->appends(request()->all())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function edit(time) {
        $('.card-title').text("Edit Time Range")
        $('#time_from').val(time.time_from);
        $('#time_to').val(time.time_to);
        // $('#location').val(classroom.location);
        $('form').append("<input type='hidden' name='_method' value='PATCH' id='patch-method'>")
        var route = '/times/' + time.id;
        $('form').attr("action", route);
    }
</script>
