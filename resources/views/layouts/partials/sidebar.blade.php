<ul class="sidebar-nav">
    <li class="sidebar-header">
        Pages
    </li>

    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer"></i>
            <span class="align-middle">Dashboard</span>
        </a>
    </li>

    @if (auth()->user()->role == 'Administrator')
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('companies.index') }}">
                <i class="bi bi-bank"></i>
                <span class="align-middle">Companies</span>
            </a>
        </li>
    @endif


    @if (auth()->user()->role == 'Administrator')
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('employees.index') }}">
                <i class="bi bi-people-fill"></i>
                <span class="align-middle">Employees</span>
            </a>
        </li>
    @endif


</ul>


{{-- <div class="sidebar-cta">
    <div class="sidebar-cta-content">
        <strong class="d-inline-block mb-2">Upgrade to Pro</strong>
        <div class="mb-3 text-sm">
            Are you looking for more components? Check out our premium version.
        </div>
        <div class="d-grid">
            <a href="upgrade-to-pro.html" class="btn btn-primary">Upgrade to Pro</a>
        </div>
    </div>
</div> --}}

