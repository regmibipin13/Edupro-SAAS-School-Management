@extends('layouts.admin')

@section('content')
    <div class="content py-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{ route('admin.permissions.store') }}" method="post">
                            @csrf
                            <div class="card-header">
                                Add New Permission
                            </div>

                            @include('admin.permissions.includes.form-elements')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('input:checkbox').change(function() {
                var cb = $(this);
                cb.val(cb.prop('checked') ? 1 : 0);
            });
        })
    </script>
@endsection
