@extends('layouts.admin')
@section('content')
    @include('admin.partials.__content_header', [
        'header' => '',
    ])

    <div class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12 import-export-buttons">
                    <a href="{{ route('admin.schools.create') }}" class="btn btn-success">Add New School</a>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Search Schools</h5>
                            <form action="{{ route('admin.schools.index') }}" method="get"
                                class=" d-flex align-items-center filters-list">
                                <input type="text" class="form-control" name="id" placeholder="School Id"
                                    value="{{ request()->id }}">
                                <input type="text" class="form-control" name="name" placeholder="School Name"
                                    value="{{ request()->name }}">
                                <input type="email" class="form-control" name="email" placeholder="School Email"
                                    value="{{ request()->email }}">
                                <input type="number" class="form-control" name="contact" placeholder="School Contact"
                                    value="{{ request()->contact }}">

                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>School Name</th>
                                        <th>School Contact</th>
                                        <th>Active</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schools as $school)
                                        <tr>
                                            <td>
                                                {{ $school->id }}
                                            </td>
                                            <td>{{ $school->name }}</td>
                                            <td>{{ $school->contact }}</td>
                                            <td><span
                                                    class="badge badge-pill {{ $school->is_active ? 'badge-success' : 'badge-danger' }}">{{ $school->is_active ? 'Active' : 'Inactive' }}</span>
                                            </td>
                                            <td class="d-flex align-items-center">
                                                <a href="{{ route('admin.schools.edit', $school->id) }}"
                                                    class="btn btn-sm btn-primary mr-2">Edit</a>
                                                <form action="{{ route('admin.schools.destroy', $school->id) }}"
                                                    onsubmit="confirm('Are you sure you want to delete ?')"
                                                    id="delete-form-{{ $school->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure ?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($schools) <= 0)
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
                            {{ $schools->appends(request()->all())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
