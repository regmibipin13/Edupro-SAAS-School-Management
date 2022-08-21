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

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
