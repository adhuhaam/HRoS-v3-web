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

            @php($modules = config('sidebar'))
            @foreach($modules as $module)
                @php
                    $show = true;
                    if(isset($module['permission'])) {
                        $show = $show && auth()->user()->can($module['permission']);
                    }
                    if(isset($module['roles'])) {
                        $show = $show && auth()->user()->hasAnyRole($module['roles']);
                    }
                @endphp
                @if($show)
                    <li>
                        <a href="{{ $module['route'] !== '#' ? route($module['route']) : '#' }}">
                            <iconify-icon icon="{{ $module['icon'] }}" class="menu-icon"></iconify-icon>
                            <span>{{ $module['label'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach

        </ul>
    </div>
</aside>
