<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="notification"></div>
        <div class="info">
            <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('user.dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>
            @can('users_access')
                <li class="nav-item">
                    <a href="{{ route('user.users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            {{ __('Users') }}
                        </p>
                    </a>
                </li>
            @endcan

            @can('school_details_access')
                <li class="nav-item">
                    <a href="{{ route('user.schools.edit', Auth::user()->school_id) }}" class="nav-link">
                        <i class="nav-icon fas fa-school"></i>
                        <p>
                            {{ __('My School Details') }}
                        </p>
                    </a>
                </li>
            @endcan

            @can('classrooms_access')
                <li class="nav-item">
                    <a href="{{ route('user.classrooms.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle nav-icon"></i>
                        <p>
                            {{ __('Classrooms') }}
                        </p>
                    </a>
                </li>
            @endcan
            @can('sections_access')
                <li class="nav-item">
                    <a href="{{ route('user.sections.index') }}" class="nav-link">
                        <i class="nav-icon far fa-circle nav-icon"></i>
                        <p>
                            {{ __('Sections') }}
                        </p>
                    </a>
                </li>
            @endcan
            @can('subjects_access')
                <li class="nav-item">
                    <a href="{{ route('user.subjects.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            {{ __('Subjects') }}
                        </p>
                    </a>
                </li>
            @endcan
            @can('fee_management_access')
                <li class="nav-item">
                    <a href="{{ route('user.fees.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            {{ __('Fees Management') }}
                        </p>
                    </a>
                </li>
            @endcan
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        {{ __('Exams and Results') }}
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    @can('exams_access')
                        <li class="nav-item">
                            <a href="{{ route('user.exams.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Exams') }}</p>
                            </a>
                        </li>
                    @endcan
                    @can('grades_access')
                        <li class="nav-item">
                            <a href="{{ route('user.grades.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Grades') }}</p>
                            </a>
                        </li>
                    @endcan
                    @can('marks_access')
                        <li class="nav-item">
                            <a href="{{ route('user.marks.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Marks') }}</p>
                            </a>
                        </li>
                    @endcan
                    @can('marksheet_access')
                        <li class="nav-item">
                            <a href="{{ route('user.marksheets.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Marksheet') }}</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            @can('routine_access')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle nav-icon"></i>
                        <p>
                            {{ __('Daily Routine') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">

                        <li class="nav-item">
                            <a href="{{ route('user.timetables.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Show Timetable') }}</p>
                            </a>
                        </li>
                        @if (hasRole('School Admin'))
                            <li class="nav-item">
                                <a href="{{ route('user.timetables.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('Manage Timetable') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.days.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('Days') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.times.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('Time Ranges') }}</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endcan
            @if (hasRole(['School Admin', 'Teachers']))
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle nav-icon"></i>
                        <p>
                            {{ __('Student Information') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview" style="display: none;">
                        @can('students_admit_access')
                            <li class="nav-item">
                                <a href="{{ route('user.students.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('Admit Student') }}</p>
                                </a>
                            </li>
                        @endcan
                        @can('students_access')
                            <li class="nav-item">
                                <a href="{{ route('user.students.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('Students List') }}</p>
                                </a>
                            </li>
                        @endcan
                        @can('attendance_access')
                            <li class="nav-item">
                                <a href="{{ route('user.attendances.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('Attendance Lists') }}</p>
                                </a>
                            </li>
                        @endcan
                        @can('attendance_crud_access')
                            <li class="nav-item">
                                <a href="{{ route('user.attendances.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('Add/Edit Attendance') }}</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
