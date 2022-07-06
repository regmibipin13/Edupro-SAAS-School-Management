@extends('layouts.admin')
@section('content')
    <div class="content py-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{ route('admin.schools.update', $school->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="card-header">
                                Edit School
                            </div>

                            @include('admin.schools.includes.form-elements')
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
