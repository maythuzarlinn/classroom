<!-- Categories -->
<div class="list-group text-center text-lg-start py-3 mt-4">
    <a href="{{ url('/dashboard') }}" class="list-group-item list-group-item-action mt-4">
        <i class="fa-solid fa-chart-line"></i>
        <span class="d-none d-lg-inline">Dashboard</span>
        <span class="d-none d-lg-inline badge bg-primary rounded-pill float-end">8</span>
    </a>
    <a href="{{ route('students.index') }}" class="list-group-item list-group-item-action">
        <i class="fa-solid fa-users"></i>
        <span class="d-none d-lg-inline">Students</span>
    </a>

    <a href="{{ route('teachers.index') }}" class="list-group-item list-group-item-action">
        <i class="fa-solid fa-user"></i>
        <span class="d-none d-lg-inline">Teachers</span>
    </a>
    <a href="#" class="list-group-item list-group-item-action">
        <i class="fa-solid fa-flag"></i>
        <span class="d-none d-lg-inline">Classes</span>
    </a>
</div>
<!-- Admin Panel -->
<div class="list-group mt-4 text-center text-lg-start">
    <span class="list-group-item disabled d-none d-lg-block">
        <h5>School Admin Panel</h5>
    </span>
    <a href="{{ route('classrooms.index') }}" class="list-group-item list-group-item-action">
        <i class="fa-regular fa-building"></i>
        <span class="d-none d-lg-inline">Classrooms</span>
    </a>    
    <a href="{{ route('grades.index') }}" class="list-group-item list-group-item-action">
        <i class="fa-regular fa-calendar-minus"></i>
        <span class="d-none d-lg-inline">Grade</span>
    </a>
    <a href="#" class="list-group-item list-group-item-action">
        <i class="fa-regular fa-pen-to-square"></i>
        <span class="d-none d-lg-inline">Update Data</span>
    </a>
    <a href="#" class="list-group-item list-group-item-action">
        <i class="fa-regular fa-calendar-days"></i>
        <span class="d-none d-lg-inline">Add Events</span>
    </a>
</div>
