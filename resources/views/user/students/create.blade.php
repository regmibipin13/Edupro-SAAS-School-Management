@extends('layouts.app')
@section('content')
    <admit-student :classes="{{ $classes->toJson() }}" :route="'{{ route('user.students.store') }}'" inline-template>
        <div class="content mt-2">
            <form @submit.prevent="submit" ref="formContainer">
                <div class="card">
                    <div class="card-header">
                        Admin Student
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                Student Personal Information
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="name">{{ __('Name *') }}</label>
                                        <input type="text"
                                            :class="{ 'form-control': true, 'is-invalid': errors.hasOwnProperty('name') }"
                                            placeholder="Name" v-model="form.name">

                                        <p class="text-danger" v-if="errors.hasOwnProperty('name')">@{{ errors.name[0] }}
                                        </p>

                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="email">{{ __('Email *') }}</label>
                                        <input type="email"
                                            :class="{ 'form-control': true, 'is-invalid': errors.hasOwnProperty('email') }"
                                            placeholder="email" v-model="form.email">
                                        <p class="text-danger" v-if="errors.hasOwnProperty('email')">@{{ errors.email[0] }}
                                        </p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="phone">{{ __('Phone *') }}</label>
                                        <input type="text"
                                            :class="{ 'form-control': true, 'is-invalid': errors.hasOwnProperty('phone') }"
                                            placeholder="Phone" v-model="form.phone">
                                        <p class="text-danger" v-if="errors.hasOwnProperty('phone')">@{{ errors.phone[0] }}
                                        </p>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="gender">{{ __('Gender *') }}</label>
                                        <select
                                            :class="{ 'form-control': true, 'is-invalid': errors.hasOwnProperty('gender') }"
                                            v-model="form.gender">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <p class="text-danger" v-if="errors.hasOwnProperty('phone')">@{{ errors.gender[0] }}
                                        </p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="city">{{ __('City *') }}</label>
                                        <input type="text"
                                            :class="{ 'form-control': true, 'is-invalid': errors.hasOwnProperty('city') }"
                                            placeholder="City" v-model="form.city">
                                        <p class="text-danger" v-if="errors.hasOwnProperty('phone')">@{{ errors.city[0] }}
                                        </p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="address">{{ __('Address *') }}</label>
                                        <input type="text"
                                            :class="{ 'form-control': true, 'is-invalid': errors.hasOwnProperty('address') }"
                                            placeholder="address" v-model="form.address">
                                        <p class="text-danger" v-if="errors.hasOwnProperty('address')">
                                            @{{ errors.address[0] }}
                                        </p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="dob">{{ __('Date of birth *') }}</label>
                                        <input type="date"
                                            :class="{ 'form-control': true, 'is-invalid': errors.hasOwnProperty('dob') }"
                                            placeholder="dob" v-model="form.dob">
                                        <p class="text-danger" v-if="errors.hasOwnProperty('dob')">@{{ errors.dob[0] }}
                                        </p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="admitted_date">{{ __('Admitted Date *') }}</label>
                                        <input type="date"v-model="form.admitted_date"
                                            :class="{
                                                'form-control': true,
                                                'is-invalid': errors.hasOwnProperty(
                                                    'admitted_date')
                                            }"
                                            placeholder="admitted date">
                                        <p class="text-danger" v-if="errors.hasOwnProperty('admitted_date')">
                                            @{{ errors.admitted_date[0] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                Student School Information
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="classroom_id">{{ __('Class *') }}</label>
                                        <multiselect v-model="classroom" :options="classes" :searchable="true"
                                            :close-on-select="true" :show-labels="true" track-by="id" label="name"
                                            placeholder="Pick a Class"
                                            :class="{
                                                'is-invalid': errors.hasOwnProperty(
                                                    'classroom_id')
                                            }">
                                        </multiselect>


                                        <p class="text-danger" v-if="errors.hasOwnProperty('classroom_id')">
                                            @{{ errors.classroom_id[0] }}
                                        </p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="section_id">{{ __('Sections *') }}</label>
                                        <multiselect v-model="section" :options="sections" :searchable="true"
                                            :close-on-select="true" :show-labels="true" track-by="id" label="name"
                                            placeholder="Pick a Class"
                                            :class="{
                                                'is-invalid': errors.hasOwnProperty(
                                                    'section_id')
                                            }">
                                        </multiselect>
                                        <p class="text-danger" v-if="errors.hasOwnProperty('section_id')">
                                            @{{ errors.section_id[0] }}
                                        </p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="parent_id">{{ __('Parent Account *') }}</label>
                                        <multiselect v-model="parent" :options="{{ $parents->toJson() }}"
                                            :searchable="true" :close-on-select="true" :show-labels="true"
                                            track-by="id" label="name" placeholder="Pick a Parent"
                                            :class="{
                                                'is-invalid': errors.hasOwnProperty(
                                                    'parent_id')
                                            }">
                                        </multiselect>

                                        <p class="text-danger" v-if="errors.hasOwnProperty('parent_id')">
                                            @{{ errors.parent_id[0] }}
                                        </p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="blood_group">{{ __('Blood Group *') }}</label>
                                        <select id="blood_group" v-model="form.blood_group"
                                            :class="{
                                                'form-control': true,
                                                'is-invalid': errors.hasOwnProperty(
                                                    'blood_group')
                                            }">
                                            <option value="">Select a Blood Group</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>

                                        </select>

                                        <p class="text-danger" v-if="errors.hasOwnProperty('blood_group')">
                                            @{{ errors.blood_group[0] }}
                                        </p>
                                    </div>

                                    {{-- <div class="form-group">
                                <label for="uniqueStudentId">Unique Student ID (Optional)</label>
                                <input type="text" class="form-control" name="uniqueStudentId"
                                    placeholder="Unique Student Id">
                                @if ($errors->has('uniqueStudentId'))
                                    <p class="text-danger">{{ $errors->first('uniqueStudentId') }}</p>
                                @endif
                            </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-block btn-success">Admit Student</button>
                    </div>
                </div>
            </form>
        </div>
    </admit-student>
@endsection
