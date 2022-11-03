@extends('layouts.app')
@section('content')
    <timetable :time-lists="{{ $times->toJson() }}" :classrooms="{{ $classrooms->toJson() }}"
        :request="{{ json_encode(request()->all()) }}" inline-template>
        <div class="content" refs="formContainer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <div class="card">
                            <div class="card-header"@if (request()->has('classroom_id') && request()->has('section_id')) style="pointer-events: none;" @endif>
                                <form @submit.prevent="next">
                                    <div class="form-group">
                                        <label for="classroom_id">Classroom</label>
                                        <select v-model="classroom_id" id="classroom_id" class="form-control" required>
                                            <option :value="classroom.id" v-for="(classroom, index) in classrooms">
                                                @{{ classroom.name }}</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="section_id">Section</label>
                                        <select v-model="section_id" id="section_id" class="form-control" required>
                                            <option :value="section.id" v-for="(section, index) in sections">
                                                @{{ section.name }}</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-success">Next</button>
                                </form>
                            </div>
                            <div class="card-footer">
                                @if (request()->has('classroom_id') && request()->has('section_id'))
                                    <a href="{{ route('user.timetables.create') }}" class="btn btn-danger">Reset</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if (request()->has('classroom_id') && request()->has('section_id'))
                        <div class="col-md-12 mt-3">
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" class="btn btn-success" @click="addTimetable">Add Timetable
                                        +</button>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Time Range</th>
                                                <th>Subject</th>
                                                <th>Days</th>
                                                <th>Teacher</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(time, index) in times">
                                                <td>
                                                    {{-- @{{ time.time_from }} - @{{ time.time_to }} --}}
                                                    <select class="form-control" v-model="times[index]">
                                                        <option :value="time" v-for="(time, index) in timeOptions">
                                                            @{{ time.time_from }} - @{{ time.time_to }}
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select v-model="times[index].subject_id" class="form-control">
                                                        <option :value="subject.id" v-for="subject in subjects">
                                                            @{{ subject.name }}</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <multiselect v-model="times[index].days"
                                                        :options="{{ $days->toJson() }}" :searchable="true"
                                                        :close-on-select="false" :show-labels="true" track-by="id"
                                                        label="name" placeholder="Pick Days" :multiple="true">
                                                    </multiselect>
                                                </td>
                                                <td>
                                                    <multiselect v-model="times[index].teacher_id"
                                                        :options="{{ $teachers->toJson() }}" :searchable="true"
                                                        :close-on-select="false" :show-labels="true" track-by="id"
                                                        label="name" placeholder="Pick Teacher">
                                                    </multiselect>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger" type="button"
                                                        @click.prevent="removeTimetable(index)">Delete</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-success" @click.prevent="onSubmit">Update
                                        Timetable</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </timetable>
@endsection
