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
        <i class="fa-solid fa-chart-line"></i>
        <span class="d-none d-lg-inline">Classrooms</span>
    </a>
    <a href="#" class="list-group-item list-group-item-action">
        <i class="fa-solid fa-flag"></i>
        <span class="d-none d-lg-inline">Classes</span>
    </a>
</div>
