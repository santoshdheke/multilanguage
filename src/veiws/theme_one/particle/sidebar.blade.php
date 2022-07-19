
<li class="nav-item{{ Request::is('ssgroup-language/language*')?" menu-open":"" }}">
    <a href="{{ url('ssgroup-language/admin/language') }}" class="nav-link{{ Request::is('ssgroup-language/language*')?" active":"" }}">
        <i class="nav-icon fas fa-language"></i>
        <p>
            Language
        </p>
    </a>
</li>
