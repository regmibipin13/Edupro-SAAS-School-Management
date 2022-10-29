@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <timetable-show :request="{{ json_encode(request()->all()) }}"inline-template>
                        <div class="card mt-3">
                            <div class="card-header">
                                <form action="{{ route('user.timetables.index') }}" method="GET">
                                    <div class="form-group">
                                        <label for="classroom_id">Classroom</label>
                                        <select name="classroom_id" id="classroom_id" class="form-control"
                                            v-model="classroom_id" required>
                                            @foreach ($classrooms as $classroom)
                                                <option value="{{ $classroom->id }}"
                                                    {{ request()->classroom_id == $classroom->id ? 'selected' : '' }}>
                                                    {{ $classroom->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="classroom_id">Section</label>
                                        <select name="section_id" id="classroom_id" class="form-control"
                                            v-model="section_id" required>
                                            <option v-for="section in sections" :value="section.id">
                                                @{{ section.name }}</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-success">Next</button>
                                </form>
                            </div>
                        </div>
                    </timetable-show>
                </div>

                <div class="col-md-12 mt-3">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>
                                Time
                            </th>
                            <th>
                                Subject
                            </th>
                            <th>
                                Teacher
                            </th>
                        </tr>
                        @if (request()->has('classroom_id') && request()->has('section_id'))
                            @foreach ($timetables as $t)
                                <tr>
                                    <td>
                                        {{ $t->time->time_from }} - {{ $t->time->time_to }}
                                    </td>
                                    <td>
                                        {{ $t->subject->name }}
                                    </td>
                                    <td>
                                        {{ $t->teacher->name }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">Please select class and section first</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
