<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
        Sistem<span> ESP</span>
        </a>
        <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{route('dashboard')}}" class="nav-link">
                <i class="link-icon" data-feather="box"></i>
                <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('laporan.view')}}" class="nav-link">
                <i class="link-icon" data-feather="box"></i>
                <span class="link-title">Laporan</span>
                </a>
            </li>
            @if (auth()->user()->role == '5')
                <li class="nav-item">
                    <a href="{{route('device.view')}}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Device</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('cabang.view')}}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Cabang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('user.view')}}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">User</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('unknown')}}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Unknown Device</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('setting.view')}}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Settings</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>
