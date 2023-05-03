<div class="d-flex flex-column flex-shrink-0 p-3 text-custom bg-2" style="width: 200px; height: 100vh;">
    <a href="{{ route('empresa_list') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-custom text-decoration-none">
        <span class="fs-3 logo">
            <img src=" {{ asset ('/img/logo-vallbona.png' )}}" alt="Vallbona" height="30px">
            CARLES VALLBONA</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('empresa_list') }}" class="nav-link text-custom" aria-current="page">
                Empreses
            </a>
        </li>
        <li>
            <a href="{{ route('contacte_list') }}" class="nav-link text-custom">
                Contactes
            </a>
        </li>
        <li>
            <a href="{{ route('estada_list') }}" class="nav-link text-custom">
                Estades
            </a>
        </li>
        @if (Auth::user()->rol_id == 5076)
        <li>
            <a href="{{ route('user_list') }}" class="nav-link text-custom">
                Usuaris
            </a>
        </li>
        <li>
            <a href="{{ route('rol_list') }}" class="nav-link text-custom">
                Rols
            </a>
        </li>
        <li>
            <a href="{{ route('curs_list') }}" class="nav-link text-custom">
                Cursos
            </a>
        </li>
        <li>
            <a href="{{ route('cicle_list') }}" class="nav-link text-custom">
                Cicles
            </a>
        </li>
        <li>
            <a href="{{ route('comarca_list') }}" class="nav-link text-custom">
                Comarques
            </a>
        </li>
        <li>
            <a href="{{ route('poblacio_list') }}" class="nav-link text-custom">
                Poblacions
            </a>
        </li>
        @endif
    </ul>
    <hr>
    <div id="userContainer" class="dropdown">
        <a href="#" class="d-flex align-items-center text-custom text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <strong id="profilename">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow login-dropdown" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="{{ route('user_profile') }}">Perfil</a></li>
            <input type="hidden" id="userid" value="{{ Auth::id() }}">
            <li>
                <div class="dropdown-item">
                    @if (Auth::user()->darkmode == 0)
                    <button id="darkmode" class="lightmode" value="0"><i class='bi bi-sun-fill'></i> Mode dia</button>
                    @else
                    <button id="darkmode" class="darkmode" value="1">Mode nit <i class="bi bi-moon-fill"></i></button>
                    @endif
                </div>
            </li>
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