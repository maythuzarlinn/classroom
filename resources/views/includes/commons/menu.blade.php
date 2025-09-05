<!-- Categories -->
<div class="list-group text-center text-lg-start py-3 mt-4">
    <a href="{{ url('/dashboard') }}"
        class="mt-4 list-group-item list-group-item-action {{ request()->is('dashboard') ? 'custom-navbar' : '' }}">
        <i class="fa-solid fa-chart-line"></i>
        <span class="d-none d-lg-inline">Dashboard</span>
    </a>
    <a href="{{ route('schoolclasses.index') }}"
        class="list-group-item list-group-item-action {{ request()->is('schoolclasses*') ? 'custom-navbar' : '' }}">
        <i class="fa-solid fa-calendar"></i>
        <span class="d-none d-lg-inline">Classes Schedule</span>
    </a>
    <a href="{{ route('attendances.index') }}"
        class="list-group-item list-group-item-action {{ request()->is('attendances*') ? 'custom-navbar' : '' }}">
        <i class="fa-regular fa-pen-to-square"></i>
        <span class="d-none d-lg-inline">Attendance</span>
    </a>
    <a href="{{ route('assignments.index') }}"
        class="list-group-item list-group-item-action {{ request()->is('assignments*') ? 'custom-navbar' : '' }}">
        <i class="fa-solid fa-folder-open"></i>
        <span class="d-none d-lg-inline">Assignments</span>
    </a>
    <a href="{{ route('exams.index') }}"
        class="list-group-item list-group-item-action {{ request()->is('exams*') ? 'custom-navbar' : '' }}">
        <i class="fa-regular fa-calendar-days"></i>
        <span class="d-none d-lg-inline">Exam / Test Schedule</span>
    </a>
    <a href="{{ route('exam.result') }}"
        class="list-group-item list-group-item-action {{ request()->is('exam/result') ? 'custom-navbar' : '' }}">
        <i class="fa-regular fa-calendar-days"></i>
        <span class="d-none d-lg-inline">Exam Result</span>
    </a>
</div>
<!-- Admin Panel -->
<div class="list-group text-center text-lg-start">
    <span class="list-group-item disabled d-none d-lg-block">
        <i class="fa-solid fa-gear"></i>
        <h5 class="d-none d-lg-inline">Setting</h5>
    </span>
    <a href="{{ route('classrooms.index') }}"
        class="list-group-item list-group-item-action {{ request()->is('classrooms*') ? 'custom-navbar' : '' }}">
        <i class="fa-solid fa-landmark"></i>
        <span class="d-none d-lg-inline">Classrooms</span>
    </a>
    <a href="{{ route('grades.index') }}"
        class="list-group-item list-group-item-action {{ request()->is('grades*') ? 'custom-navbar' : '' }}">
        <i class="fa-solid fa-user-graduate"></i>
        <span class="d-none d-lg-inline">Grade</span>
    </a>
    <a href="{{ route('subjects.index') }}"
        class="list-group-item list-group-item-action {{ request()->is('subjects*') ? 'custom-navbar' : '' }}">
        <i class="fa-solid fa-book-bookmark"></i>
        <span class="d-none d-lg-inline">Subjects</span>
    </a>
    <a href="{{ route('students.index') }}"
        class="list-group-item list-group-item-action {{ request()->is('students*') ? 'custom-navbar' : '' }}">
        <i class="fa-solid fa-users"></i>
        <span class="d-none d-lg-inline">Students</span>
    </a>
    <a href="{{ route('teachers.index') }}"
        class="list-group-item list-group-item-action {{ request()->is('teachers*') ? 'custom-navbar' : '' }}">
        <i class="fa-solid fa-user"></i>
        <span class="d-none d-lg-inline">Teachers</span>
    </a>
</div>
