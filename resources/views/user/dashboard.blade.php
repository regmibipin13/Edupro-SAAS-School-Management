@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card mt-2">
                        <div class="card-body">
                            <span>Welcome {{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </div><!-- /.col -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Happy Dashain</strong> Some Notices Here
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Happy Eid</strong> Some Notices Here
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ App\Models\Student::count() }}</h3>
                            <p>Total Students</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('user.students.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ App\Models\User::role('Teachers')->count() }}</h3>
                            <p>Total Teachers</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('user.users.index') }}?roles[]=3" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ App\Models\Exam::count() }}</h3>
                            <p>Total Exams</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('user.exams.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ App\Models\Classroom::count() }}</h3>
                            <p>Total Classes</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('user.classrooms.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Todays Attendance Report
                            </h3>

                        </div>
                        <div class="card-body">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            Classroom
                                        </th>
                                        <th>
                                            Total Students
                                        </th>
                                        <th>
                                            Presents
                                        </th>
                                        <th>
                                            Absents
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendances as $classId => $attendance)
                                        <tr>
                                            <td>
                                                {{ App\Models\Classroom::find($classId)->name }}
                                            </td>
                                            <td>
                                                {{ App\Models\Classroom::find($classId)->students->count() }}
                                            </td>
                                            <td>
                                                {{ $attendance->where('attendance', 'Present')->count() }}
                                            </td>
                                            <td>
                                                {{ $attendance->where('attendance', 'Absent')->count() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
