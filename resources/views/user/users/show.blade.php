@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-highlight">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">{{ $user->name }}</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        {{-- Basic Info --}}
                        <div class="tab-pane fade show active" id="basic-info">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Name</td>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Gender</td>
                                        <td>{{ $user->gender }}</td>
                                    </tr>
                                    @if ($user->email)
                                        <tr>
                                            <td class="font-weight-bold">Email</td>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                    @endif

                                    @if ($user->phone)
                                        <tr>
                                            <td class="font-weight-bold">Phone</td>
                                            <td>{{ $user->phone . ' ' . $user->phone2 }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="font-weight-bold">Birthday</td>
                                        <td>{{ $user->dob }}</td>
                                    </tr>


                                    {{-- @if ($user->user_type == 'parent')
                                        <tr>
                                            <td class="font-weight-bold">Children/Ward</td>
                                            <td>
                                                @foreach (Qs::findMyChildren($user->id) as $sr)
                                                    <span> - <a
                                                            href="{{ route('students.show', Qs::hash($sr->id)) }}">{{ $sr->user->name . ' - ' . $sr->my_class->name . ' ' . $sr->section->name }}</a></span><br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif

                                    @if ($user->user_type == 'teacher')
                                        <tr>
                                            <td class="font-weight-bold">My Subjects</td>
                                            <td>
                                                @foreach (Qs::findTeacherSubjects($user->id) as $sub)
                                                    <span> -
                                                        {{ $sub->name . ' (' . $sub->my_class->name . ')' }}</span><br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif --}}

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- User Profile Ends --}}
@endsection
