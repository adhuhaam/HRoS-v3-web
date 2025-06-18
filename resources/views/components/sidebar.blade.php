<aside class="sidebar">
    <button type="button" class="sidebar-close-btn !mt-4">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>

    <div class="sidebar-logo">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="site logo" class="light-logo">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="site logo" class="dark-logo">
            <img src="{{ asset('assets/images/logo-icon.svg') }}" alt="site logo" class="logo-icon">
        </a>
    </div>

    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">

            <li class="dropdown">
                <a href="javascript:void(0)" class="sidebar-dropdown-toggle">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
                <ul class="sidebar-submenu hidden">
                    <li><a href="#"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> AI</a></li>
                    <li><a href="#"><i class="ri-circle-fill circle-icon text-warning-600 w-auto"></i> CRM</a></li>
                </ul>
            </li>

            <li class="sidebar-menu-group-title">Application</li>

            @can('view employees')
            <li>
                <a href="{{ route('employees.index') }}">
                    <iconify-icon icon="mdi:account-group-outline" class="menu-icon"></iconify-icon>
                    <span>Employees</span>
                </a>
            </li>
            @endcan

            {{-- Example: Only show HR Manager module to users with that permission --}}
            @can('view hr dashboard')
            <li>
                <a href="{{ route('hr.dashboard') }}">
                    <iconify-icon icon="mdi:briefcase-account-outline" class="menu-icon"></iconify-icon>
                    <span>HR Dashboard</span>
                </a>
            </li>
            @endcan

            {{-- Additional modules with permission checks --}}
            @can('access email')
            <li>
                <a href="#">
                    <iconify-icon icon="mage:email" class="menu-icon"></iconify-icon>
                    <span>Email</span>
                </a>
            </li>
            @endcan

            @can('access chat')
            <li>
                <a href="#">
                    <iconify-icon icon="bi:chat-dots" class="menu-icon"></iconify-icon>
                    <span>Chat</span>
                </a>
            </li>
            @endcan

            @can('access calendar')
            <li>
                <a href="#">
                    <iconify-icon icon="solar:calendar-outline" class="menu-icon"></iconify-icon>
                    <span>Calendar</span>
                </a>
            </li>
            @endcan

            {{-- Add more module entries below using @can(...) --}}
        </ul>
    </div>
</aside>
