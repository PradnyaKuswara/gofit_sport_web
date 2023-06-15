<a href="{{ route('dashboard-main') }}" class="list-group-item list-group-item-action py-2 ripple text-white"
    style="background-color:{{ request()->is('dashboard/main') ? '#041C32' : '#1E5F74' }}" aria-current="true">
    <i class=" fa-solid fa-table-columns fa-fw me-3"></i><span>Main dashboard</span>
</a>

@if ($user->ROLE_PEGAWAI == 'Manajer Operasional')
    <a href="{{ url('dashboard/general-schedule') }}"
        class="list-group-item list-group-item-action py-2 ripple text-white"
        style="background-color:{{ request()->is('dashboard/general-schedule') || request()->is('dashboard/create-general-schedule') || request()->is('dashboard/edit-general-schedule/*') ? '#04293A' : '#1E5F74' }} ">
        <i class="fas fa-solid fa-calendar fa-fw me-3"></i><span>General Schedule</span>
    </a>
    <a href="{{ url('dashboard/daily-schedule') }}" class="list-group-item list-group-item-action py-2 ripple text-white"
        style="background-color: {{ request()->is('dashboard/daily-schedule') || request()->is('dashboard/abolished-daily-schedule') || request()->is('dashboard/edit-daily-schedule/*') || request()->is('dashboard/search-daily-schedule') ? '#04293A' : '#1E5F74' }}">
        <i class="fa-solid fa-calendar-day fa-fw me-3"></i><span>Generate Daily Schedule</span>
    </a>
    <a href="{{ url('dashboard/instructor-permission') }}"
        class="list-group-item list-group-item-action py-2 ripple text-white"
        style="background-color: {{ request()->is('dashboard/instructor-permission') ? '#04293A' : '#1E5F74' }}">
        <i class="fas fa-solid fa-check fa-fw me-3"></i><span>Permission Confirm</span>
    </a>
    <a href="{{ url('dashboard/income-report') }}" class="list-group-item list-group-item-action py-2 ripple text-white"
        style="background-color: {{ request()->is('dashboard/income-report') ? '#04293A' : '#1E5F74' }}">
        <i class="fas fa-solid fa-money-check-dollar fa-fw me-3"></i><span>Income Report</span>
    </a>
    <a href="{{ url('dashboard/class-activity-report') }}"
        class="list-group-item list-group-item-action py-2 ripple text-white"
        style="background-color: {{ request()->is('dashboard/class-activity-report') ? '#04293A' : '#1E5F74' }}">
        <i class="fas fa-solid fa-people-group fa-fw me-3"></i><span>Class Activity Report</span>
    </a>
    <a href="{{ url('dashboard/gym-activity-report') }}"
        class="list-group-item list-group-item-action py-2 ripple text-white"
        style="background-color: {{ request()->is('dashboard/gym-activity-report') ? '#04293A' : '#1E5F74' }}">
        <i class="fas fa-solid fa-people-group fa-fw me-3"></i><span>Gym Activity Report</span>
    </a>
    <a href="{{ url('dashboard/instructor-report') }}"
        class="list-group-item list-group-item-action py-2 ripple text-white"
        style="background-color: {{ request()->is('dashboard/instructor-report') ? '#04293A' : '#1E5F74' }}">
        <i class="fas fa-solid fa-person-chalkboard fa-fw me-3"></i><span>Instructor Report</span>
    </a>
@endif

@if ($user->ROLE_PEGAWAI == 'Kasir')
    <a href="{{ url('dashboard/member') }}" class="list-group-item list-group-item-action py-2 ripple text-white"
        style="background-color: {{ request()->is('dashboard/member') || request()->is('dashboard/create-member') || request()->is('dashboard/search-member') || request()->is('dashboard/edit-member/*') ? '#04293A' : '#1E5F74' }}">
        <i class="fas fa-solid fa-users fa-fw me-3"></i><span>Member</span>
    </a>
    <a href="{{ url('dashboard/activation-transaction') }}"
        class="list-group-item list-group-item-action py-2 ripple text-white"
        style="background-color: {{ request()->is('dashboard/activation-transaction') ? '#04293A' : '#1E5F74' }}">
        <i class="fas fa-solid fa-user-tag fa-fw me-3"></i><span>Transaction Activation</span>
    </a>
    <a href="{{ url('dashboard/money-deposit') }}"
        class="list-group-item list-group-item-action py-2 ripple text-white"
        style="background-color: {{ request()->is('dashboard/money-deposit') ? '#04293A' : '#1E5F74' }}">
        <i class="fas fa-solid fa-money-bill fa-fw me-3"></i><span>Transaction Money Deposit</span>
    </a>
    <a href="{{ url('dashboard/class-deposit') }}"
        class="list-group-item list-group-item-action py-2 ripple text-white"
        style="background-color: {{ request()->is('dashboard/class-deposit') ? '#04293A' : '#1E5F74' }}">
        <i class="fas fa-solid fa-school fa-fw me-3"></i><span>Transaction Class Deposit</span>
    </a>

    <a href="{{ url('dashboard/presensi-booking-class') }}"
        class="list-group-item list-group-item-action py-2 ripple text-white"
        style="background-color: {{ request()->is('dashboard/presensi-booking-class') ? '#04293A' : '#1E5F74' }} ">
        <i class="fas fa-solid fa-list-check fa-fw me-3"></i><span>Presensi Booking Class</span>
    </a>
    <a href="{{ url('dashboard/presensi-booking-gym') }}"
        class="list-group-item list-group-item-action py-2 ripple text-white"
        style="background-color: {{ request()->is('dashboard/presensi-booking-gym') ? '#04293A' : '#1E5F74' }} ">
        <i class="fas fa-solid fa-list-check fa-fw me-3"></i><span>Presensi Booking Gym</span>
    </a>
    <a href="{{ url('dashboard/deactive-member') }}"
        class="list-group-item list-group-item-action py-2 ripple text-white"
        style="background-color: {{ request()->is('dashboard/deactive-member') ? '#04293A' : '#1E5F74' }}">
        <i class="fas fa-solid fa-user-minus fa-fw me-3"></i><span>Deactive Member</span>
    </a>
    <a href="{{ url('dashboard/reset-class-member') }}"
        class="list-group-item list-group-item-action py-2 ripple text-white"
        style="background-color: {{ request()->is('dashboard/reset-class-member') ? '#04293A' : '#1E5F74' }} ">
        <i class="fas fa-solid fa-undo fa-fw me-3"></i><span>Reset Class Member</span>
    </a>
    <a href="{{ url('dashboard/reset-late-instructor') }}"
        class="list-group-item list-group-item-action py-2 ripple text-white"
        style="background-color: {{ request()->is('dashboard/reset-late-instructor') ? '#04293A' : '#1E5F74' }} ">
        <i class="fas fa-solid fa-undo fa-fw me-3"></i><span>Reset Late Instructor</span>
    </a>
@endif

@if ($user->ROLE_PEGAWAI == 'Admin')
    <a href="{{ url('dashboard/instructor') }}" class="list-group-item list-group-item-action py-2 ripple text-white"
        style="background-color: {{ request()->is('dashboard/instructor') || request()->is('dashboard/create-instructor') || request()->is('dashboard/search-instructor') || request()->is('dashboard/edit-instructor/*') ? '#04293A' : '#1E5F74' }}">
        <i class="fas fa-solid fa-person-walking fa-fw me-3"></i><span>Instructor</span>
    </a>
@endif
