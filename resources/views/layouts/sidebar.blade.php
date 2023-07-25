<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Beranda</span>
            </a>
        </li>

        <li class="nav-heading">Sepak Bola</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('clubs.index') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Klub</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('scores.index') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Skor</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('classements.index') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Klasemen</span>
            </a>
        </li>
    </ul>
</aside>