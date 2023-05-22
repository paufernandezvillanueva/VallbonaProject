@section('title', trans('translation.create_password'))

<link href="{{ asset('css/filtro.css') }}" rel="stylesheet">

<x-guest-layout>
    <x-validation-errors class="mb-4" />

    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif
    
    <div class="mb-4 text-sm text-gray-600">
        {{ trans('translation.first_login_description') }}
    </div>

    <form method="POST" name="firstLoginForm" action="{{ route('first_login', Auth::user()->id) }}">
        @csrf
        <div class="mt-4">
            <x-label for="password" value="{{ trans('translation.password') }}" />
            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <div id="password-add-error" class></div>
        </div>
        <div class="mt-4">
            <x-label for="confirm-password" value="{{ trans('translation.confirm_password') }}" />
            <x-input id="confirm-password" class="block mt-1 w-full" type="password" name="confirm-password" required autocomplete="new-password" />
            <div id="confirm-password-add-error" class></div>
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-button>
                {{ trans('translation.create_password') }}
            </x-button>
        </div>
    </form>
    <script type="text/javascript" src="{{ asset('js/validators.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/first_login_validator.js') }}"></script>
</x-guest-layout>