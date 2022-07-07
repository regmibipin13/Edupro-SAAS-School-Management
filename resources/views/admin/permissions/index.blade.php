@extends('layouts.admin')
@section('content')
    @include('admin.partials.__content_header', [
        'header' => 'Permissions',
    ])

    <div class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12 import-export-buttons">
                    <a href="{{ route('admin.permissions.create') }}" class="btn btn-success">Add New Permission</a>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Permission Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>
                                                {{ $permission->id }}
                                            </td>
                                            <td>{{ $permission->name }}</td>

                                            <td>
                                                <a href="{{ route('admin.permissions.edit', $permission->id) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                {{-- <a href="" class="btn btn-sm btn-info">View</a> --}}
                                                <a href="#" class="btn btn-sm btn-danger"
                                                    onclick="document.getElementById('delete-form-{{ $permission->id }}').submit();">Delete</a>
                                                <form action="{{ route('admin.permissions.destroy', $permission->id) }}"
                                                    id="delete-form-{{ $permission->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($permissions) <= 0)
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
                            {{ $permissions->appends(request()->all())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
