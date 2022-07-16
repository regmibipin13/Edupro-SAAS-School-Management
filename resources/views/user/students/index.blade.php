@extends('layouts.app')
@section('content')
    @include('admin.partials.__content_header', [
        'header' => '',
    ])

    <div class="content">
        <div class="container-fluid">
           {{--  <div class="row mb-2">
                <div class="col-md-12 import-export-buttons">
                    <a href="{{ route('admin.schools.create') }}" class="btn btn-success">Add New School</a>
                </div>
            </div> --}}
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Search Students</h5>
                            <form action="{{ route('user.students.index') }}" method="get"
                                class="row">
                                <div class="col-md-2">
                                    <label for="classroom_id">Class</label>
                                    <select class="form-control select2" name="classroom_id" id="classroom_id">
                                        @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="section_id">Section</label>
                                    <select class="form-control select2" name="section_id" id="section_id">
                                        
                                        <option value="">Select A Section</option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="gender">Gender</label>
                                    <select class="form-control select2" name="gender" id="gender" multiple>
                                      
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                     
                                    </select>
                                </div>
                                
                               <div class="form-group col-md-2">
                                   <label for="name">Student Name</label>
                                   <input type="text" name="name" class="form-control" placeholder="Student Name">
                               </div>


                                <div class="form-group col-md-2" style="position:relative;">
                                    
                                    <button type="submit" class="btn btn-primary " style="position:absolute;bottom:2px;">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Student Name</th>
                                        <th>Student Contact</th>
                                        <th>Class</th>
                                        <th>School</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>
                                                {{ $student->id }}
                                            </td>
                                            <td>{{ $student->user->name }}</td>
                                            <td>{{ $student->user->phone }}</td>
                                            <td>{{ $student->classroom->name }} - {{ $student->section->name }}</span></td>
                                            <td>{{ $student->school->name }}</td>
                                            <td class="d-flex align-items-center">
                                                <a href="{{ route('user.students.edit', $student->id) }}"
                                                    class="btn btn-sm btn-primary mr-2">Edit</a>
                                                <form action="{{ route('user.students.destroy', $student->id) }}"
                                                    onsubmit="confirm('Are you sure you want to delete ?')"
                                                    id="delete-form-{{ $student->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure ?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($students) <= 0)
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
                            {{ $students->appends(request()->all())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
