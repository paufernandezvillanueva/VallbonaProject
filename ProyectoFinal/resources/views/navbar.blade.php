

<div id="navbar" class="flex-column flex-shrink-0 text-custom bg-2 navbar-origin-open" style="width: 200px; height: 100vh; display:flex">
    <a id="navbar-header" href="{{ route('empresa_list') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-custom text-decoration-none">
        <span class="fs-3 logo">
            <img src=" {{ asset ('/img/logo-vallbona.png' )}}" alt="Vallbona" height="85px">
        </span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            @if (Str::contains(url()->full(), url("empresa")))
            <a href="{{ route('empresa_list') }}" class="nav-link text-custom actual-page" aria-current="page">
                {{ trans('translation.companies') }}
            </a>
            @else
            <a href="{{ route('empresa_list') }}" class="nav-link text-custom" aria-current="page">
                {{ trans('translation.companies') }}
            </a>
            @endif
        </li>
        <li>
            @if (Str::contains(url()->full(), url("contacte")))
            <a href="{{ route('contacte_list') }}" class="nav-link text-custom actual-page">
                {{ trans('translation.contacts') }}
            </a>
            @else
            <a href="{{ route('contacte_list') }}" class="nav-link text-custom">
                {{ trans('translation.contacts') }}
            </a>
            @endif
        </li>
        <li>
            @if (Str::contains(url()->full(), url("estada")))
            <a href="{{ route('estada_list') }}" class="nav-link text-custom actual-page">
                {{ trans('translation.stays') }}
            </a>
            @else
            <a href="{{ route('estada_list') }}" class="nav-link text-custom">
                {{ trans('translation.stays') }}
            </a>
            @endif
        </li>
        @if (Auth::user()->rol_id == 5076)
        <li>
            @if (Str::contains(url()->full(), url("user")) && route('user_profile') != url()->full())
            <a href="{{ route('user_list') }}" class="nav-link text-custom actual-page">
                {{ trans('translation.users') }}
            </a>
            @else
            <a href="{{ route('user_list') }}" class="nav-link text-custom">
                {{ trans('translation.users') }}
            </a>
            @endif
        </li>
        <li>
            @if (Str::contains(url()->full(), url("rol")))
            <a href="{{ route('rol_list') }}" class="nav-link text-custom actual-page">
                {{ trans('translation.roles') }}
            </a>
            @else
            <a href="{{ route('rol_list') }}" class="nav-link text-custom">
                {{ trans('translation.roles') }}
            </a>
            @endif
        </li>
        <li>
            @if (Str::contains(url()->full(), url("curs")))
            <a href="{{ route('curs_list') }}" class="nav-link text-custom actual-page">
                {{ trans('translation.courses') }}
            </a>
            @else
            <a href="{{ route('curs_list') }}" class="nav-link text-custom">
                {{ trans('translation.courses') }}
            </a>
            @endif
        </li>
        <li>
            @if (Str::contains(url()->full(), url("cicle")))
            <a href="{{ route('cicle_list') }}" class="nav-link text-custom actual-page">
                {{ trans('translation.cicles') }}
            </a>
            @else
            <a href="{{ route('cicle_list') }}" class="nav-link text-custom">
                {{ trans('translation.cicles') }}
            </a>
            @endif
        </li>
        <li>
            @if (Str::contains(url()->full(), url("comarca")))
            <a href="{{ route('comarca_list') }}" class="nav-link text-custom actual-page">
                {{ trans('translation.regions') }}
            </a>
            @else
            <a href="{{ route('comarca_list') }}" class="nav-link text-custom">
                {{ trans('translation.regions') }}
            </a>
            @endif
        </li>
        <li>
            @if (Str::contains(url()->full(), url("poblacio")))
            <a href="{{ route('poblacio_list') }}" class="nav-link text-custom actual-page">
                {{ trans('translation.populations') }}
            </a>
            @else
            <a href="{{ route('poblacio_list') }}" class="nav-link text-custom">
                {{ trans('translation.populations') }}
            </a>
            @endif
        </li>
        @endif
    </ul>
    <hr>
    <div id="userContainer" class="dropdown">
        <a href="#" class="d-flex align-items-center text-custom text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <strong id="profilename">{{ Auth::user()->name }}</strong>
            <i class="bi bi-caret-down-fill"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow login-dropdown" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="{{ route('user_profile') }}">{{ trans('translation.profile') }}</a></li>
            <input type="hidden" id="userid" value="{{ Auth::id() }}">
            <li>
                <div class="dropdown-item">
                    @if (Auth::user()->darkmode == 0)
                    <button id="darkmode" class="lightmode" value="0"><i class='bi bi-sun-fill'></i> {{ trans('translation.lightmode') }}</button>
                    @else
                    <button id="darkmode" class="darkmode" value="1">{{ trans('translation.darkmode') }} <i class="bi bi-moon-fill"></i></button>
                    @endif
                </div>
            </li>
            <li>
                <div class="dropdown-item">
                    <button id="languageButton" class="btn text-white" data-bs-toggle="modal" data-bs-target="#languageModal">{{ trans('translation.language') }}</button>
                </div>
            </li>

            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <form method="POST" id="logout" action="{{ route('logout') }}">
                    @csrf
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">{{ trans('translation.logout') }}</a>
                </form>
            </li>
        </ul>
    </div>
</div>

<div class="modal fade" id="languageModal" tabindex="-1" aria-labelledby="languageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="languageModalLabel">{{ trans('translation.select_language') }}</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body">
                <select class="form-control changeLang">


                    <option value="ca" {{ session()->get('locale') == 'ca' ? 'selected' : '' }}>{{ trans('translation.catalan') }}</option>
                    <option value="es" {{ session()->get('locale') == 'es' ? 'selected' : '' }}>{{ trans('translation.spanish') }}</option>
                    <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>{{ trans('translation.english') }}</option>

                </select>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<button id="toggleButton" class="btn" onclick="toggleDiv()"><i class="bi bi-arrow-bar-left"></i></button>

<script type="text/javascript">



    var url = "{{ route('changeLang') }}";



    $(".changeLang").change(function(){

        window.location.href = url + "?lang="+ $(this).val();

    });



</script>
