@extends('layouts.admin')
@section('content')
    @include('admin.partials.__content_header', [
        'header' => 'Roles',
    ])

    <div class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12 import-export-buttons">
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-success">Add New Role</a>
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
                                        <th>Role Name</th>
                                        <th>Permissions</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>
                                                {{ $role->id }}
                                            </td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @foreach ($role->permissions as $permission)
                                                    <span
                                                        class="badge badge-pill badge-info">{{ $permission->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                {{-- <a href="" class="btn btn-sm btn-info">View</a> --}}
                                                <a href="#" class="btn btn-sm btn-danger"
                                                    onclick="document.getElementById('delete-form-{{ $role->id }}').submit();">Delete</a>
                                                <form action="{{ route('admin.roles.destroy', $role->id) }}"
                                                    id="delete-form-{{ $role->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($roles) <= 0)
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
                            {{ $roles->appends(request()->all())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
