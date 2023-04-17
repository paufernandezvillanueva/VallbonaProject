<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 200px; height: 100vh;">
    <a href="{{ route('empresa_list') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
        <span class="fs-4">
                    <img src=" {{ asset ('/img/logo-vallbona.png' )}}" alt="Vallbona" height="30px" >
                    CARLES VALLBONA</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('empresa_list') }}" class="nav-link text-white" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                Empreses
            </a>
        </li>
        <li>
            <a href="{{ route('contacte_list') }}" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                Contactes
            </a>
        </li>
        <li>
            <a href="{{ route('estada_list') }}" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                Estada
            </a>
        </li>
        @if (Auth::user()->rol_id == 5076)
        <li>
            <a href="{{ route('user_list') }}" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                Usuaris
            </a>
        </li>
        <li>
            <a href="{{ route('rol_list') }}" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                Rol
            </a>
        </li>
        <li>
            <a href="{{ route('curs_list') }}" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                Cursos
            </a>
        </li>
        <li>
            <a href="{{ route('cicle_list') }}" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                Cicles
            </a>
        </li>
        <li>
            <a href="{{ route('comarca_list') }}" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                Comarcas
            </a>
        </li>
        <li>
            <a href="{{ route('poblacio_list') }}" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                Poblacions
            </a>
        </li>
        @endif
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{asset ('/img/logo-vallbona.png')}}" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong id="profilename">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">Configuracio</a></li>
            <li><a class="dropdown-item" href="#">Perfil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" id="logout" action="{{ route('logout') }}">
                    @csrf
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                </form>
            </li>
        </ul>
    </div>
</div>
