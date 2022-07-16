<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
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
            <li class="nav-item">
                <a href="{{ route('user.users.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        {{ __('Users') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('user.schools.edit', Auth::user()->school_id) }}" class="nav-link">
                    <i class="nav-icon fas fa-school"></i>
                    <p>
                        {{ __('School Details') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('user.classrooms.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        {{ __('Classrooms') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('user.sections.index') }}" class="nav-link">
                    <i class="nav-icon far fa-circle nav-icon"></i>
                    <p>
                        {{ __('Sections') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('user.subjects.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        {{ __('Subjects') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Exams and Results
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('user.exams.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Exams</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Student Information
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('user.students.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Admin Student</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.students.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Students List</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
