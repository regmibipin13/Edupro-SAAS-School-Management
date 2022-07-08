@extends('layouts.app')
@section('content')
    @include('admin.partials.__content_header', [
        'header' => '',
    ])

    <div class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12 import-export-buttons">
                    <a href="{{ route('user.users.create') }}" class="btn btn-success">Add New User</a>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Search Users</h5>
                            <form action="{{ route('user.users.index') }}" method="get"
                                class=" d-flex align-items-center filters-list">
                                <input type="text" class="form-control" name="id" placeholder="User Id"
                                    value="{{ request()->id }}" style="width: 20%;">
                                <input type="text" class="form-control" name="name" placeholder="User Name"
                                    value="{{ request()->name }}"style="width: 30%;">
                                <input type="email" class="form-control" name="email" placeholder="User Email"
                                    value="{{ request()->email }}"style="width: 20%;">
                                <select name="roles[]" id="roles" class="form-control select2" multiple
                                    style="width: 20%;">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ in_array($role->id, request()->roles ?? []) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;
                                <button type="submit" class="btn btn-primary"style="width: 10%;">Search</button>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                {{ $user->id }}
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @foreach ($user->roles as $role)
                                                    <span class="badge badge-pill badge-info">{{ $role->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('user.users.edit', $user->id) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                <a href="{{ route('user.users.show', $user->id) }}"
                                                    class="btn btn-sm btn-info">View</a>
                                                <a href="#" class="btn btn-sm btn-danger"
                                                    onclick="document.getElementById('delete-form-{{ $user->id }}').submit();">Delete</a>
                                                <form action="{{ route('user.users.destroy', $user->id) }}"
                                                    id="delete-form-{{ $user->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($users) <= 0)
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
                            {{ $users->appends(request()->all())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
