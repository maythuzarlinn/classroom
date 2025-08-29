<!-- Categories -->
<div class="list-group text-center text-lg-start py-3 mt-4">
    <span class="list-group-item disabled d-none d-lg-block mt-4">
        <h5>Classroom management</h5>
    </span>
    <a href="{{ url('/dashboard') }}" class="list-group-item list-group-item-action">
        <i class="fa-solid fa-chart-line"></i>
        <span class="d-none d-lg-inline">Dashboard</span>
        <span class="d-none d-lg-inline badge bg-primary rounded-pill float-end">8</span>
    </a>
    <a href="{{ route('schoolclasses.index') }}" class="list-group-item list-group-item-action">
        <i class="fa-solid fa-calendar"></i>
        <span class="d-none d-lg-inline">Classes Schedule</span>
    </a>
    <a href="{{ route('attendances.index') }}" class="list-group-item list-group-item-action">
        <i class="fa-regular fa-pen-to-square"></i>
        <span class="d-none d-lg-inline">Attendance</span>
    </a>
    <a href="#" class="list-group-item list-group-item-action">
        <i class="fa-solid fa-folder-open"></i>
        <span class="d-none d-lg-inline">Assignments</span>
    </a>
    <a href="#" class="list-group-item list-group-item-action">
        <i class="fa-regular fa-calendar-days"></i>
        <span class="d-none d-lg-inline">Exam / Test</span>
    </a>    
</div>
<!-- Admin Panel -->
<div class="list-group mt-4 text-center text-lg-start">
    <span class="list-group-item disabled d-none d-lg-block">
        <i class="fa-solid fa-gear"></i>
        <h5 class="d-none d-lg-inline">Setting</h5>
    </span>
    <a href="{{ route('classrooms.index') }}" class="list-group-item list-group-item-action">
        <i class="fa-solid fa-landmark"></i>
        <span class="d-none d-lg-inline">Classrooms</span>
    </a>
    <a href="{{ route('grades.index') }}" class="list-group-item list-group-item-action">
        <i class="fa-solid fa-user-graduate"></i>
        <span class="d-none d-lg-inline">Grade</span>
    </a>
    <a href="{{ route('subjects.index') }}" class="list-group-item list-group-item-action">
        <i class="fa-solid fa-book-bookmark"></i>
        <span class="d-none d-lg-inline">Subjects</span>
    </a>
    <a href="{{ route('students.index') }}" class="list-group-item list-group-item-action">
        <i class="fa-solid fa-users"></i>
        <span class="d-none d-lg-inline">Students</span>
    </a>
    <a href="{{ route('teachers.index') }}" class="list-group-item list-group-item-action">
        <i class="fa-solid fa-user"></i>
        <span class="d-none d-lg-inline">Teachers</span>
    </a>
</div>
