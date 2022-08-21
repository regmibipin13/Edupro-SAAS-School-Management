@extends('layouts.app')
@section('content')
    <timetable :classrooms="{{ $classrooms->toJson() }}" inline-template>
        <div class="content" refs="formContainer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="form-group">
                                    <label for="classroom_id">Classroom</label>
                                    <select v-model="classroom_id" id="classroom_id" class="form-control">
                                        <option :value="classroom.id" v-for="(classroom, index) in classrooms">
                                            @{{ classroom.name }}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="section_id">Section</label>
                                    <select v-model="section_id" id="section_id" class="form-control">
                                        <option :value="section.id" v-for="(section, index) in sections">
                                            @{{ section.name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3" v-if="classroom_id !== '' && section_id !== ''">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Time Range</th>
                                            <th>Subject</th>
                                            <th>Days</th>
                                            <th>Teacher</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <tr v-for="(time, index) in times">
                                            <td>
                                                @{{ time.time_from }} - @{{ time.time_to }}
                                            </td>
                                            <td>
                                                <select v-model="times[index].subject_id" class="form-control">
                                                    <option :value="subject.id" v-for="subject in subjects">
                                                        @{{ subject.name }}</option>
                                                </select>
                                            </td>
                                            <td>
                                                <multiselect v-model="times[index].days" :options="{{ $days->toJson() }}"
                                                    :searchable="true" :close-on-select="false" :show-labels="true"
                                                    track-by="id" label="name" placeholder="Pick Days"
                                                    :multiple="true">
                                                </multiselect>
                                            </td>
                                            <td>
                                                <multiselect v-model="times[index].teacher_id"
                                                    :options="{{ $teachers->toJson() }}" :searchable="true"
                                                    :close-on-select="false" :show-labels="true" track-by="id"
                                                    label="name" placeholder="Pick Teacher">
                                                </multiselect>
                                            </td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-success" @click.prevent="onSubmit">Update
                                    Timetable</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </timetable>
@endsection
