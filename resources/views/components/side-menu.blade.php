<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="javascript:void(0);" class="app-brand-link text-decoration-none">
            <span class="app-brand-logo demo">
                <span class="text-primary">
                    <img src="{{ asset('admin/img/logo.png') }}" width="25" class="img-fluid" alt="">
                </span>
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">Dashboard</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
        </a>
    </div>

    <div class="menu-divider mt-0"></div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('backend') ? 'active open' : '' }}">
            <a href="{{ route('backend.home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate">Dashboard</div>
            </a>
        </li>

        <!-- Roles & Permissions -->
        @if (auth()->user()->can('view role') || auth()->user()->can('view permission') || auth()->user()->can('view user'))
            <li
                class="menu-item {{ request()->is('backend/roles*') || request()->is('backend/permissions*') || request()->is('backend/users*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-lock"></i>
                    <div class="text-truncate">Roles & Permissions</div>
                </a>
                <ul class="menu-sub">
                    @can('view role')
                        <li class="menu-item {{ request()->is('backend/roles*') ? 'active' : '' }}">
                            <a href="{{ route('backend.roles.index') }}" class="menu-link">
                                <div class="text-truncate">Roles</div>
                            </a>
                        </li>
                    @endcan

                    @can('view permission')
                        <li class="menu-item {{ request()->is('backend/permissions*') ? 'active' : '' }}">
                            <a href="{{ route('backend.permissions.index') }}" class="menu-link">
                                <div class="text-truncate">Permissions</div>
                            </a>
                        </li>
                    @endcan

                    @can('view user')
                        <li class="menu-item {{ request()->is('backend/users*') ? 'active' : '' }}">
                            <a href="{{ route('backend.users.index') }}" class="menu-link">
                                <div class="text-truncate">Users</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endif

        <!-- Branches & Departments -->
        @if (auth()->user()->can('view department') ||
                auth()->user()->can('view branch') ||
                auth()->user()->can('view position'))
            <li
                class="menu-item {{ request()->is('backend/departments*') || request()->is('backend/branches*') || request()->is('backend/positions*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-building"></i>
                    <div class="text-truncate">Branches & Departments</div>
                </a>
                <ul class="menu-sub">
                    @can('view department')
                        <li class="menu-item {{ request()->is('backend/departments*') ? 'active' : '' }}">
                            <a href="{{ route('backend.department.index') }}" class="menu-link">
                                <div class="text-truncate">Departments</div>
                            </a>
                        </li>
                    @endcan

                    @can('view branch')
                        <li class="menu-item {{ request()->is('backend/branches*') ? 'active' : '' }}">
                            <a href="{{ route('backend.branches.index') }}" class="menu-link">
                                <div class="text-truncate">Branches</div>
                            </a>
                        </li>
                    @endcan

                    @can('view position')
                        <li class="menu-item {{ request()->is('backend/positions*') ? 'active' : '' }}">
                            <a href="{{ route('backend.position.index') }}" class="menu-link">
                                <div class="text-truncate">Positions</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endif

        <!-- Employee Management -->
        
        @if (auth()->user()->can('view employee') || auth()->user()->can('view bank_detail') || auth()->user()->can('view leave_type'))
            <li
                class="menu-item {{ request()->is('backend/employee*') || request()->is('backend/bank-details*') || request()->is('backend/leave-types*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-building"></i>
                    <div class="text-truncate">Employee Management</div>
                </a>
                <ul class="menu-sub">
                    @can('view employee')
                        <li class="menu-item {{ request()->is('backend/employee*') ? 'active' : '' }}">
                            <a href="{{ route('backend.employee.index') }}" class="menu-link">
                                <div class="text-truncate">Employees</div>
                            </a>
                        </li>
                    @endcan
                    @can('view bank_detail')
                        <li class="menu-item {{ request()->is('backend/bank-details*') ? 'active' : '' }}">
                            <a href="{{ route('backend.bank_detail.index') }}" class="menu-link">
                                <div class="text-truncate">Bank Details</div>
                            </a>
                        </li>
                    @endcan
                    @can('view leave_type')
                        <li class="menu-item {{ request()->is('backend/leave-types*') ? 'active' : '' }}">
                            <a href="{{ route('backend.leave_type.index') }}" class="menu-link">
                                <div class="text-truncate">{{ __('Leave Types') }}</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endif

        <!-- Salary Management -->
        
        @if (auth()->user()->can('view employee_salary'))
            <li
                class="menu-item {{ request()->is('backend/employee-salaries*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-building"></i>
                    <div class="text-truncate">{{ __('Payroll') }}</div>
                </a>
                <ul class="menu-sub">
                    @can('view employee_salary')
                        <li class="menu-item {{ request()->is('backend/employee-salaries*') ? 'active' : '' }}">
                            <a href="{{ route('backend.employee_salary.index') }}" class="menu-link">
                                <div class="text-truncate">{{ __('Salaries') }}</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endif
        @can('view leave')
            <li class="menu-item {{ request()->is('backend/leaves*') ? 'active open' : '' }}">
                <a href="{{ route('backend.leave.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-smile"></i>
                    <div class="text-truncate">Apply Leave</div>
                </a>
            </li>
        @endcan

        <!-- Logout -->
        <li class="menu-item">
            <a href="{{ route('logout') }}" class="menu-link"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="menu-icon tf-icons bx bx-log-out"></i>
                <div class="text-truncate">Logout</div>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>

</aside>

